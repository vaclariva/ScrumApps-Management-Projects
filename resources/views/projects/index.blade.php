@extends('layouts.app')
@section('pageTitle', 'Proyek')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Proyek', 'link' => ''],
            ['title' => 'Semua', 'link' => ''],
        ]
    ])
@endsection
@section('sidebar')
    @include('layouts.sidebar.main')
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('assets/css/projects/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/projects/modal.css') }}">
@endpush

@section('content')
    @php
        $userRole = auth()->user()->role;
        $projectCount = count($projects);
    @endphp

    @if(in_array($userRole, ['ProductOwner', 'TeamDeveloper']))
    @if($projectCount === 0)
        <div class="d-flex flex-column flex-center h-100">
            <div class="px-20 px-lg-3">
                <img class="img-fluid" src="{{ asset('assets/svg/illustrations/empty-variant.svg') }}" alt="svg">
            </div>
            <h1 class="fw-bolder mt-9 fs-2qx">Belum Ada Proyek</h1>
            <p class="text-gray-600 text-center">Anda belum ditambahkan ke dalam proyek untuk berkolaborasi</p>
        </div>
    @else
    <div class="card">
        <div class="card-header d-flex text-center">
            <div class="flex-column">
                <h3 class="card-title fw-semibold">Daftar Proyek</h3>
                <span class="text-gray-600 text-sm">
                    Halaman ini berisi daftar proyek yang ada sesuai dengan hak akses dan kontribusi pengguna.
                </span>
            </div>
            @include('include.default-datatable-search', ['tableId' => 'table-user', 'fullInResponsive' => true])
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-9">
                @foreach ($projects as $project)
                    @include('projects.partials.projects-list', ['project' => $project])
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @elseif($userRole === 'Superadmin')
    <div class="card">
        <div class="card-header d-flex text-center">
            <div class="flex-column">
                <h3 class="card-title fw-semibold">Daftar Proyek</h3>
                <span class="text-gray-600 text-sm">
                    Halaman ini berisi daftar proyek yang ada sesuai dengan hak akses dan kontribusi pengguna.
                </span>
            </div>
            @include('include.default-datatable-search', ['tableId' => 'table-user', 'fullInResponsive' => true])
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-9">
                @include('projects.partials.projects-add')

                @foreach ($projects as $project)
                    @include('projects.partials.projects-list', ['project' => $project])
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @include('projects.modal-create')

    @push('blockfoot')
        <script src="{{ asset('assets/js/projects/index.js') }}"></script>
        <script src="{{ asset('assets/js/projects/icons.js') }}"></script>
        <script src="{{ asset('assets/js/projects/create.js') }}"></script>
        <script src="{{ asset('assets/js/projects/date-picker.js') }}"></script>
    @endpush
@endsection
