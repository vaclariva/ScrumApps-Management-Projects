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
    <link rel="stylesheet" href="{{ asset('assets/css/backlogs/index.css') }}">
@endpush

@section('content')
    {{-- Detail proyek --}}
    @include('projects.partials.projects-detail')
    @include('projects.modal-edit')
    @include('backlogs.modal-create')
    @include('backlogs.partials.checkbacklog-template')
    <br>
    @include('backlogs.partials.nav-tab', ['activeIndex' => 0])

    {{-- Tab Content --}}
    <div class="tab-content" id="backlogTabContent">
        {{-- Tab 1: Backlog List --}}
        <div class="tab-pane fade {{ $activeIndex == 0 ? 'show active' : '' }}" id="backlog-content" role="tabpanel" aria-labelledby="backlog-tab">
            <div class="card rounded-top-0">
                <div class="card-header d-flex text-center">
                    <div class="flex-column">
                        <h3 class="card-title fw-semibold">Daftar Backlog</h3>
                        <span class="text-gray-600 text-sm">
                            Halaman ini digunakan untuk menyimpan daftar Backlog pada proyek.
                        </span>
                    </div>
                    <div class="d-flex flex-column flex-lg-row justify-content-lg-between gap-4 mb-8">
                        @if (auth()->user()->isSuperAdmin || auth()->user()->isBusinessAnalyst)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_create_backlogs" anim="ripple" class="btn tbr_btn tbr_btn--primary d-flex flex-center gap-2">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M17.5724 6.50367V6.50573V13.4891C17.5724 14.8566 17.1677 15.8581 16.5087 16.5171C15.8498 17.176 14.8482 17.5807 13.4807 17.5807H6.50573C5.13823 17.5807 4.1369 17.176 3.47806 16.5164C2.81911 15.8566 2.41406 14.8529 2.41406 13.4807V6.50573C2.41406 5.13822 2.81879 4.13666 3.47773 3.47773C4.13666 2.81879 5.13822 2.41406 6.50573 2.41406H13.4891C14.8567 2.41406 15.858 2.81885 16.5157 3.47739C17.1733 4.13578 17.5762 5.13663 17.5724 6.50367Z" fill="white" stroke="white" stroke-width="1.5"/>
                                    <mask id="path-2-inside-1_1796_18943" fill="white">
                                    <path d="M13.3307 9.3724H10.6224V6.66406C10.6224 6.3224 10.3391 6.03906 9.9974 6.03906C9.65573 6.03906 9.3724 6.3224 9.3724 6.66406V9.3724H6.66406C6.3224 9.3724 6.03906 9.65573 6.03906 9.9974C6.03906 10.3391 6.3224 10.6224 6.66406 10.6224H9.3724V13.3307C9.3724 13.6724 9.65573 13.9557 9.9974 13.9557C10.3391 13.9557 10.6224 13.6724 10.6224 13.3307V10.6224H13.3307C13.6724 10.6224 13.9557 10.3391 13.9557 9.9974C13.9557 9.65573 13.6724 9.3724 13.3307 9.3724Z"/>
                                    </mask>
                                    <path d="M13.3307 9.3724H10.6224V6.66406C10.6224 6.3224 10.3391 6.03906 9.9974 6.03906C9.65573 6.03906 9.3724 6.3224 9.3724 6.66406V9.3724H6.66406C6.3224 9.3724 6.03906 9.65573 6.03906 9.9974C6.03906 10.3391 6.3224 10.6224 6.66406 10.6224H9.3724V13.3307C9.3724 13.6724 9.65573 13.9557 9.9974 13.9557C10.3391 13.9557 10.6224 13.6724 10.6224 13.3307V10.6224H13.3307C13.6724 10.6224 13.9557 10.3391 13.9557 9.9974C13.9557 9.65573 13.6724 9.3724 13.3307 9.3724Z" fill="white"/>
                                </svg>
                                <span>Tambah</span>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div id="list-backlogs">
                        @foreach ($backlogs as $backlog)
                            @include('backlogs.partials.backlogs-card', [
                                'backlog' => $backlog,
                                'project' => $project,
                                'sprints' => $sprints,
                                'checkBacklogs' => $checkBacklogs,
                            ])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 2: Grouped Backlog --}}
        <div class="tab-pane fade {{ $activeIndex == 1 ? 'show active' : '' }}" id="grouped-content" role="tabpanel" aria-labelledby="grouped-tab">
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
                    <div id="list-backlogs-grouped">
                        @if(isset($backlogsGrouped))
                            @foreach ($backlogsGrouped as $sprintName => $backlogs)
                                @include('backlogs.partials.backlogs-group', [
                                    'backlogs' => $backlogs,
                                    'sprintName' => $sprintName,
                                    'project' => $project,
                                    'sprints' => $sprints,
                                    'checkBacklogs' => $checkBacklogs,
                                    'loop' => $loop,
                                ])
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <p class="text-muted">Klik tab "Kelompok Backlog" untuk memuat data</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('blockfoot')
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/default-textarea.js') }}"></script>
        <script src="{{ asset('assets/js/backlogs/index.js') }}"></script>
        <script src="{{ asset('assets/js/backlogs/create.js') }}"></script>
        <script src="{{ asset('assets/js/backlogs/edit.js') }}"></script>
        <script src="{{ asset('assets/js/backlogs/duplicate.js') }}"></script>
        <script src="{{ asset('assets/js/default-delete.js') }}"></script>
        <script src="{{ asset('assets/js/backlogs/checklist.js') }}"></script>
        <script src="{{ asset('assets/js/check-backlog/create.js') }}"></script>
        <script src="{{ asset('assets/js/projects/icons.js') }}"></script>
        <script src="{{ asset('assets/js/projects/date-picker.js') }}"></script>
    @endpush
@endsection
