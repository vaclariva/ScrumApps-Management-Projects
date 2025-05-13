@extends('layouts.app')
@section('pageTitle', 'Coming Soon')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => '', 'link' => ''],
        ]
    ])
@endsection
@section('content')

    <div class="d-flex flex-column flex-center h-100">
        <div class="px-20 px-lg-3">
            <img class="img-fluid" src="{{ asset('assets/svg/illustrations/comming-soon.svg') }}" alt="">
        </div>
        <h1 class="fw-bolder mt-9 fs-2qx">Segera Hadir</h1>
        <p class="text-gray-600 text-center">Kami sedang mengembangkan fitur baru yang akan segera tersedia.<br/> Nantikan kehadirannya untuk pengalaman yang lebih baik!</p>
    </div>


@endsection
