@extends('layouts.app')
@section('pageTitle', 'Authentication Log')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Keamanan', 'link' => ''],
            ['title' => 'Authentication Log', 'link' => ''],
        ]
    ])
@endsection
@section('sidebar')
    @include('layouts.sidebar.main')
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header gap-4">
            <div>
                <h5>Daftar Authentication Log</h5>
                <span class="text-gray-600">Berikut adalah daftar authentication log yang mencatat aktivitas login dan akses pengguna.</span>
            </div>
            @include('include.default-datatable-search', ['fullInResponsive' => true, 'tableId' => 'table-authlog'])
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @include('include.default-datatable', [
                    'tableId' => 'table-authlog',
                    'columns' => ['No', 'Email', 'User Agent', 'OS', 'Duration', 'Last Seen', 'Last Login', 'Last Logout', 'Status'],
                    'minWidths' => ['40px', 'auto', '200px', '40px', '100px', '100px', '100px', '100px', '100px'],
                ])
            </div>
        </div>
    </div>

    @push('blockfoot')
        <script>
            const urlDatatable = '{{ route('authlog.list') }}';
        </script>
        <script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/default-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/authlog/index.js') }}"></script>
    @endpush
@endsection
