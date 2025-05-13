<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sprint\StoreSprintRequest;
use App\Models\Project;
use App\Models\Sprint;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::with('user')->get();
        $users = User::where('role', 'ProductOwner')->get();
        $projectId = $request->query('project_id');

        if (!$projectId) {
            abort(404, 'Project ID tidak ditemukan');
        }

        $project = Project::findOrFail($projectId);
        $sprints = Sprint::where('project_id', $projectId)
        ->latest()
        ->get();

        return view('sprints.index', compact('users','project', 'sprints'));
    }

    /**
    * Define datatable instance of sprints.
    */
    public function list(Request $request, Project $project)
    {
        try {
            $id = $project->id;

            return DataTables::of(Sprint::with('project')->where('project_id', $id))
                ->addIndexColumn()
                ->editColumn('name', fn(Sprint $sprint) => view('sprints.partials.datatable-name', [
                    'product' => $id,
                    'sprint' => $sprint,
                    'name' => $sprint->name ?? '-',
                ]))
                ->editColumn('description', fn(Sprint $sprint) => view('sprints.partials.datatable-description', [
                    'sprint' => $sprint,
                    'description' => $sprint->description ?? '-',
                ]))
                ->editColumn('start_date', fn(Sprint $sprint) => view('sprints.partials.datatable-date', [
                    'date' => $sprint->start_date ?? '-',
                ]))
                ->editColumn('end_date', fn(Sprint $sprint) => view('sprints.partials.datatable-date', [
                    'date' => $sprint->end_date ?? '-',
                ]))
                ->editColumn('result_review', fn(Sprint $sprint) => view('sprints.partials.datatable-result', [
                    'result' => $sprint->result_review ?? '-',
                ]))
                ->editColumn('result_retrospective', fn(Sprint $sprint) => view('sprints.partials.datatable-result', [
                    'result' => $sprint->result_retrospective ?? '-',
                ]))
                ->editColumn('status', fn(Sprint $sprint) => view('sprints.partials.datatable-status', [
                    'sprint' => $sprint,
                    'status' => $sprint->status ?? '-',
                ]))
                ->addColumn('actions', fn(Sprint $sprint) => view('sprints.partials.datatable-actions', ['url_delete' => route('sprints.destroy', $sprint->id)]))
                ->order(function ($query) use ($request) {
                    $orderRequest = $request->input('order');
                    if ($orderRequest) {
                        $order = $orderRequest[0];
                        $dir = $order['dir'] ?? 'asc';

                        switch ($order['column']) {
                            case 0: $query->latest('sprints.created_at'); break;
                            case 1: $query->orderBy('sprints.name', $dir); break;
                            case 2: $query->orderBy('sprints.description', $dir); break;
                            case 3: $query->orderBy('sprints.start_date', $dir); break;
                            case 4: $query->orderBy('sprints.end_date', $dir); break;
                            case 5: $query->orderBy('sprints.result_review', $dir); break;
                            case 6: $query->orderBy('sprints.result_retrospective', $dir); break;
                            case 7: $query->orderBy('sprints.status', $dir); break;
                            default: $query->latest('sprints.created_at');
                        }
                    } else {
                        $query->latest('sprints.created_at');
                    }
                })
                ->filter(function ($query) use ($request) {
                    $search     = $request->input('search.value');
                    $start_date = $request->input('startDate');
                    $end_date   = $request->input('endDate');
                    $status     = $request->input('status');

                    // Filter Start Date
                    if ($start_date) {
                        if (is_string($start_date) && strpos($start_date, ' - ') !== false) {
                            [$start, $end] = explode(' - ', $start_date);
                            $startDate = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
                            $endDate   = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
                            $query->whereBetween('sprints.start_date', [$startDate, $endDate]);
                        } else {
                            $date = Carbon::createFromFormat('d/m/Y', $start_date);
                            $query->whereDate('sprints.start_date', $date);
                        }
                    }

                    // Filter End Date
                    if ($end_date) {
                        if (is_string($end_date) && strpos($end_date, ' - ') !== false) {
                            [$start, $end] = explode(' - ', $end_date);
                            $startDate = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
                            $endDate   = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
                            $query->whereBetween('sprints.end_date', [$startDate, $endDate]);
                        } else {
                            $date = Carbon::createFromFormat('d/m/Y', $end_date);
                            $query->whereDate('sprints.end_date', $date);
                        }
                    }

                    // Filter Search
                    if ($search) {
                        $query->where(function ($q) use ($search) {
                            $q->where('sprints.name', 'like', '%' . $search . '%')
                            ->orWhere('sprints.description', 'like', '%' . $search . '%')
                            ->orWhere('sprints.result_review', 'like', '%' . $search . '%')
                            ->orWhere('sprints.result_retrospective', 'like', '%' . $search . '%');
                        });
                    }

                    // Filter Status
                    if (!empty($status) && $status !== 'all') {
                        if (is_array($status)) {
                            $query->whereIn('sprints.status', $status);
                        } else {
                            $query->where('sprints.status', $status);
                        }
                    }
                })
                ->make(true);

        } catch (\Throwable $th) {
            info($th);
            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSprintRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['status'] = $data['status'] ?? 'inactive';
            $sprint = Sprint::create($data);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            info('Update Error:', [$th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSprintRequest $request, Sprint $sprint)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $sprint->update($data);

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            info('Update Error:', [$th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sprint $sprint)
    {
        DB::beginTransaction();

        try {
            $sprint->delete();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => url()->previous(),
            ]);
        } catch (\Throwable $th) {
            info('Delete Error:', [$th]);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
