<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Sprint;
use App\Models\User;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        if (!$projectId) {
            abort(404, 'Project ID tidak ditemukan');
        }

        $project = Project::with('user')->findOrFail($projectId);

        $projectDates = [
            [
                'title' => $project->name,
                'start' => $project->start_date->format('Y-m-d'),
                'color' => '#ffc107',
                'extendedProps' => [
                    'tooltip' => view('calendars.partials.tooltip', [
                        'type' => 'mulai-proyek',
                        'name' => $project->name,
                        'date' => $project->start_date,
                    ])->render()
                ]
            ],
            [
                'title' => $project->name,
                'start' => $project->end_date->format('Y-m-d'),
                'color' => '#28a745',
                'extendedProps' => [
                    'tooltip' => view('calendars.partials.tooltip', [
                        'type' => 'berakhir-proyek',
                        'name' => $project->name,
                        'date' => $project->end_date,
                    ])->render()
                ]
            ],
        ];

        $sprints = Sprint::where('project_id', $projectId)->get();
        $sprintDates = $sprints->flatMap(function ($sprint) {
            return [
                [
                    'title' => $sprint->name,
                    'start' => $sprint->start_date->format('Y-m-d'),
                    'color' => '#ffc107',
                    'extendedProps' => [
                        'tooltip' => view('calendars.partials.tooltip', [
                            'type' => 'mulai-sprint',
                            'name' => $sprint->name,
                            'date' => $sprint->start_date,
                        ])->render()
                    ]
                ],
                [
                    'title' => $sprint->name,
                    'start' => $sprint->end_date->format('Y-m-d'),
                    'color' =>'#28a745',
                    'extendedProps' => [
                        'tooltip' => view('calendars.partials.tooltip', [
                            'type' => 'berakhir-sprint',
                            'name' => $sprint->name,
                            'date' => $sprint->end_date,
                        ])->render()
                    ]
                ],
            ];
        })->toArray();

        $events = array_merge($projectDates, $sprintDates);

        return view('calendars.index', compact('project', 'events'));
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
