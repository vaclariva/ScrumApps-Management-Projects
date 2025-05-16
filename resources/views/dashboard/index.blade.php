@extends('layouts.app')
@section('pageTitle', 'Dashboard')
@section('sidebar')
    @include('layouts.sidebar.main')
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('assets/css/projects/index.css') }}">
@endpush
@section('content')

    {{-- <div class="d-flex flex-column flex-center h-100">
        <div class="px-20 px-lg-3">
            <img class="img-fluid" src="{{ asset('assets/svg/illustrations/comming-soon.svg') }}" alt="">
        </div>
        <h1 class="fw-bolder mt-9 fs-2qx">Segera Hadir</h1>
        <p class="text-gray-600 text-center">Kami sedang mengembangkan fitur baru yang akan segera tersedia.<br/> Nantikan kehadirannya untuk pengalaman yang lebih baik!</p>
    </div> --}}

    <div class="card">
        <div class="card-body">
            @include('dashboard.partials.dashboard-card')
            <br>
            @include('dashboard.partials.dashboard-pie-chart')
            <br>
            <div class="card p-5">
                <h2 class="ms-1 pb-3">Proyek Terbaru</h2>
                <div class="d-flex flex-wrap gap-9">
                    @foreach ($projects as $project)
                        @include('dashboard.partials.dashboard-list-project', ['project' => $project])
                    @endforeach

                    <div class="d-flex align-items-center">
                        <a href="{{ route('projects.index') }}"
                        class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger">
                            Lihat Lebih Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.partials.drawer-total')
    @include('dashboard.partials.drawer-hold')
    @include('dashboard.partials.drawer-in-progress')
    @include('dashboard.partials.drawer-done')
    @include('dashboard.partials.drawer-late')
    @push('blockfoot')
        <script src="{{ asset('assets/js/dashboard/index.js') }}"></script>
        <script src="{{ asset('assets/js/dashboard/pie-chart.js') }}"></script>
    @endpush
@endsection
