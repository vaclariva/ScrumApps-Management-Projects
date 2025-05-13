@extends('layouts.app')
@section('pageTitle', 'Database Backup')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Pengaturan', 'link' => ''],
            ['title' => 'Database Backup', 'link' => ''],
        ]
    ])
@endsection
@section('sidebar')
    @include('layouts.sidebar.main')
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush
@section('content')

    <div class="card">
        <div class="card-header flex-column">
            <h5>Database Backup</h5>
            <span class="text-gray-600">Amankan data penting bisnis Anda dengan melakukan database backup secara berkala.</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 d-flex align-items-center">
                    <label class="h6 mb-0">
                        Unduh Database Backup
                    </label>
                </div>
                <div class="col-lg-8">
                    <a href="{{ route('settings.database-backup.download') }}" target="_blank" class="btn tbr_btn tbr_btn--primary d-flex align-items-center gap-2" style="width: fit-content">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M20.5 10.19H17.61C15.24 10.19 13.31 8.26 13.31 5.89V3C13.31 2.45 12.86 2 12.31 2H8.07C4.99 2 2.5 4 2.5 7.57V16.43C2.5 20 4.99 22 8.07 22H15.93C19.01 22 21.5 20 21.5 16.43V11.19C21.5 10.64 21.05 10.19 20.5 10.19Z" fill="white"/>
                            <path d="M15.7997 2.21048C15.3897 1.80048 14.6797 2.08048 14.6797 2.65048V6.14048C14.6797 7.60048 15.9197 8.81048 17.4297 8.81048C18.3797 8.82048 19.6997 8.82048 20.8297 8.82048C21.3997 8.82048 21.6997 8.15048 21.2997 7.75048C19.8597 6.30048 17.2797 3.69048 15.7997 2.21048Z" fill="white"/>
                            <path d="M12.2775 14.72C11.9875 14.43 11.5075 14.43 11.2175 14.72L10.4975 15.44V11.25C10.4975 10.84 10.1575 10.5 9.7475 10.5C9.3375 10.5 8.9975 10.84 8.9975 11.25V15.44L8.2775 14.72C7.9875 14.43 7.5075 14.43 7.2175 14.72C6.9275 15.01 6.9275 15.49 7.2175 15.78L9.2175 17.78C9.2275 17.79 9.2375 17.79 9.2375 17.8C9.2975 17.86 9.3775 17.91 9.4575 17.95C9.5575 17.98 9.6475 18 9.7475 18C9.8475 18 9.9375 17.98 10.0275 17.94C10.1175 17.9 10.1975 17.85 10.2775 17.78L12.2775 15.78C12.5675 15.49 12.5675 15.01 12.2775 14.72Z" fill="white"/>
                        </svg>
                        <span>Unduh</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
