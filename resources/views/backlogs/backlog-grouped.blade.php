@extends('layouts.app')
@section('pageTitle', 'Proyek')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Proyek', 'link' => ''],
            ['title' => 'Detail', 'link' => ''],
        ]
    ])
@endsection
@section('sidebar')
    @include('layouts.sidebar.sub-main')
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/projects/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/projects/modal.css') }}">
@endpush

@section('content')
    {{-- Detail proyek --}}
    @include('projects.partials.projects-detail')
    @include('projects.modal-edit')
    <br>
    @include('backlogs.partials.nav-tab', ['activeIndex' => 1])

    {{-- View backlog --}}
    <div class="card rounded-top-0">
        <div class="card-header d-flex text-center">
            <div class="flex-column">
                <h3 class="card-title fw-semibold">Daftar Backlog Berdasarkan Sprint</h3>
                <span class="text-gray-600 text-sm">
                    Halaman ini digunakan untuk menyimpan daftar Backlog pada proyek yang dikelompokkan sesuai dengan sprint.
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div id="list-backlogs">
                    @foreach ($backlogsGrouped as $sprintName => $backlogs)
                        @include('backlogs.partials.backlogs-group', [
                            'backlogs' => $backlogs,
                            'sprintName' => $sprintName,
                            'project' => $project,
                            'sprints' => $sprints,
                            'checkBacklogs' => $checkBacklogs,
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @push('blockfoot')
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/default-delete.js') }}"></script>
        <script src="{{ asset('assets/js/default-textarea.js') }}"></script>
        <script src="{{ asset('assets/js/backlogs/index.js') }}"></script>
        <script src="{{ asset('assets/js/backlogs/create.js') }}"></script>
        <script src="{{ asset('assets/js/backlogs/edit.js') }}"></script>
        <script src="{{ asset('assets/js/check-backlog/create.js') }}"></script>
        <script src="{{ asset('assets/js/projects/icons.js') }}"></script>
        <script src="{{ asset('assets/js/projects/date-picker.js') }}"></script>
    @endpush
@endsection
