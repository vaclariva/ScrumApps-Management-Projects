@extends('layouts.app')
@section('pageTitle', 'Dashboard')
@section('sidebar')
    @include('layouts.sidebar.main')
@endsection
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
        <div class="row g-4">
            <div class="col-lg">
                <div class="border border-dashed border-gray-300 rounded px-5 py-4 h-48 bg-blue-500 text-white relative">
                    <div>
                        <h2 class="text-3xl font-bold">150</h2>
                        <p class="text-lg">New Orders</p>
                    </div>
                    <div class="absolute bottom-4 right-4 text-6xl opacity-20">
                        🛍️
                    </div>
                    <a href="#" class="text-white text-sm underline absolute bottom-2">More info →</a>
                </div>
            </div>
            <div class="col-lg">
                <div class="border border-dashed border-gray-300 rounded px-5 py-4 h-48 bg-green-500 text-white relative">
                    <div>
                        <h2 class="text-3xl font-bold">53%</h2>
                        <p class="text-lg">Bounce Rate</p>
                    </div>
                    <div class="absolute bottom-4 right-4 text-6xl opacity-20">
                        📊
                    </div>
                    <a href="#" class="text-white text-sm underline absolute bottom-2">More info →</a>
                </div>
            </div>
            <div class="col-lg">
                <div class="border border-dashed border-gray-300 rounded px-5 py-4 h-48 bg-orange-500 text-white relative">
                    <div>
                        <h2 class="text-3xl font-bold">44</h2>
                        <p class="text-lg">User Registrations</p>
                    </div>
                    <div class="absolute bottom-4 right-4 text-6xl opacity-20">
                        👤
                    </div>
                    <a href="#" class="text-white text-sm underline absolute bottom-2">More info →</a>
                </div>
            </div>
            <div class="col-lg">
                <div class="border border-dashed border-gray-300 rounded px-5 py-4 h-48 bg-red-500 text-white relative">
                    <div>
                        <h2 class="text-3xl font-bold">65</h2>
                        <p class="text-lg">Unique Visitors</p>
                    </div>
                    <div class="absolute bottom-4 right-4 text-6xl opacity-20">
                        📈
                    </div>
                    <a href="#" class="text-white text-sm underline absolute bottom-2">More info →</a>
                </div>
            </div>
            <div class="col-lg">
                <div class="border border-dashed border-gray-300 rounded px-5 py-4 h-48 bg-red-500 text-white relative">
                    <div>
                        <h2 class="text-3xl font-bold">65</h2>
                        <p class="text-lg">Unique Visitors</p>
                    </div>
                    <div class="absolute bottom-4 right-4 text-6xl opacity-20">
                        📈
                    </div>
                    <a href="#" class="text-white text-sm underline absolute bottom-2">More info →</a>
                </div>
            </div>
        </div>
    </div>
</div>

    @push('blockfoot')
        <script src="{{ asset('assets/js/dashboard/index.js') }}"></script>
    @endpush
@endsection
