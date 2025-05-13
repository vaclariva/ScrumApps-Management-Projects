<?php

namespace App\Http\Controllers;

use App\Http\Requests\Partner\StorePartnerRequest;
use App\Http\Requests\Partner\UpdatePartnerRequest;
use App\Models\District;
use App\Models\Partner;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Builder;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('partners.index', [
                'regencies' => Regency::get()
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    public function list(Request $request)
    {
        try {
            $filterStatus = $request->status;
            $filterRegency = $request->regency;
            $filterGroup = $request->group;
            $data = Partner::select(
                'partners.id',
                'partners.name',
                'partners.email',
                'partners.group',
                'partners.credit_limit',
                'regencies.name as regency',
                'districts.name as district',
                'partners.phone_number',
                DB::raw('IF(tbr_partners.blocked = 1, "Nonaktif", "Aktif") as status'),
                'partners.updated_at',
            )
                ->leftJoin('regencies', 'partners.regency_id', '=', 'regencies.id')
                ->leftJoin('districts', 'partners.district_id', '=', 'districts.id')
                ->when(!empty($filterStatus), function (Builder $query) use ($filterStatus) {
                    $query->whereIn(DB::raw('IFNULL(tbr_partners.blocked, 0)'), $filterStatus);
                })
                ->when(!empty($filterRegency), function (Builder $query) use ($filterRegency) {
                    $query->whereIn('partners.regency_id', $filterRegency);
                })
                ->when(!empty($filterGroup), function (Builder $query) use ($filterGroup) {
                    $query->whereIn('partners.group', $filterGroup);
                });

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($history) {
                    return view('partners.partials.datatable-name', ['name' => $history['name'], 'url_edit' => route('partners.edit', $history['id'])]);
                })
                ->editColumn('group', function ($history) {
                    return view('partners.partials.datatable-group', ['group' => $history['group']]);
                })
                ->editColumn('status', function ($history) {
                    return view('partners.partials.datatable-status', ['status' => $history['status']]);
                })
                ->editColumn('phone_number', function ($history) {
                    return view('partners.partials.datatable-contact', ['phone_number' => $history['phone_number'] ? '+62' . $history['phone_number'] : '-']);
                })
                ->editColumn('credit_limit', function ($history) {
                    return view('partners.partials.datatable-plafon', ['credit_limit' => rupiah($history['credit_limit'], false) ?? '0']);
                })
                ->editColumn('updated_at', function ($history) {
                    return \Carbon\Carbon::parse($history['updated_at'])->translatedFormat('d F Y, H:i');
                })
                ->editColumn('regency', function ($history) {
                    return $history->regency ?? '-';
                })
                ->addColumn('actions', function ($history) {
                    return view('include.default-datatable-delete', ['url' => route('partners.destroy', $history['id'])]);
                })
                ->filter(function ($query) use ($request) {
                    $search = $request->input('search')['value'];
                    if ($search) {
                        $query->where('partners.name', 'LIKE', '%' . $search . '%')
                            ->orWhere(DB::raw("CONCAT('+62', tbr_partners.phone_number)"), 'LIKE', '%' . $search . '%');
                    }
                })
                ->order(function (Builder $query) use ($request) {
                    $order = $request->input('order')[0];

                    if ($order['column'] == 0) {
                        $query->orderBy('updated_at', 'desc');
                    } elseif ($order['column'] == 1) {
                        $query->orderBy('name', $order['dir']);
                    } elseif ($order['column'] == 2) {
                        $query->orderBy('group', $order['dir']);
                    } elseif ($order['column'] == 3) {
                        $query->orderBy('credit_limit', $order['dir']);
                    } elseif ($order['column'] == 4) {
                        $query->orderBy('regency', $order['dir']);
                    } elseif ($order['column'] == 5) {
                        $query->orderBy('phone_number', $order['dir']);
                    } elseif ($order['column'] == 6) {
                        $query->orderBy('blocked', $order['dir']);
                    } elseif ($order['column'] == 7) {
                        $query->orderBy('updated_at', $order['dir']);
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
        try {
            return view('partners.create', [
                'provinces' => Province::get(),
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();
            $validatedData['credit_limit'] = (int) str_replace('.', '', $validatedData['credit_limit']) ?? 0;
            $partner = Partner::create($validatedData);

            $partner->sendCreatePasswordNotification();

            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('partners.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        try {
            $regencies = Regency::where('province_id', $partner->province_id)->get();
            $districts = District::where('regency_id', $partner->regency_id)->get();
            return view('partners.edit', [
                'partner' => $partner,
                'provinces' => Province::get(),
                'regencies' => $regencies,
                'districts' => $districts,
            ]);
        } catch (\Throwable $th) {
            info($th);

            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validated();
            $validatedData['credit_limit'] = (int) str_replace('.', '', $validatedData['credit_limit']);
            if ($request->has('email') && $request->email != $partner->email) {
                $partner->forceFill(['password' => null])->save();
            }
            $partner->update($validatedData);


            DB::commit();

            return response()->json([
                'message' => trans('http-statuses.201'),
                'redirect' => route('partners.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        try {
            DB::beginTransaction();

            $partner->delete();

            DB::commit();

            return response()->json([
                'message' => trans('Berhasil dihapus.'),
                'redirect' => route('partners.index'),
            ]);
        } catch (\Throwable $th) {
            info($th);
            DB::rollBack();

            return response()->json([
                'message' => trans('http-statuses.500'),
            ], 500);
        }
    }
}
