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
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/projects/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/projects/modal.css') }}">
@endpush

@section('content')
    @include('developments.modal-create')
    @include('developments.modal-edit')
    @include('developments.partials.default-modal-delete')
    @include('projects.modal-edit')
    @include('include.default-modal-delete')
    @include('projects.partials.projects-detail')
    <br>

    <div class="card">
        <div class="card-header d-flex text-center">
            <div class="flex-column">
                <h3 class="card-title fw-semibold">Halaman Pengembangan</h3>
                <span class="text-gray-600 text-sm">
                    Halaman ini digunakan untuk menyimpan daftar pengembangan proyek.
                </span>
            </div>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_create_boards" anim="ripple" class="btn tbr_btn tbr_btn--primary d-flex flex-center gap-2">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M17.5724 6.50367V6.50573V13.4891C17.5724 14.8566 17.1677 15.8581 16.5087 16.5171C15.8498 17.176 14.8482 17.5807 13.4807 17.5807H6.50573C5.13823 17.5807 4.1369 17.176 3.47806 16.5164C2.81911 15.8566 2.41406 14.8529 2.41406 13.4807V6.50573C2.41406 5.13822 2.81879 4.13666 3.47773 3.47773C4.13666 2.81879 5.13822 2.41406 6.50573 2.41406H13.4891C14.8567 2.41406 15.858 2.81885 16.5157 3.47739C17.1733 4.13578 17.5762 5.13663 17.5724 6.50367Z" fill="white" stroke="white" stroke-width="1.5"/>
                    <mask id="path-2-inside-1_1796_18943" fill="white">
                    <path d="M13.3307 9.3724H10.6224V6.66406C10.6224 6.3224 10.3391 6.03906 9.9974 6.03906C9.65573 6.03906 9.3724 6.3224 9.3724 6.66406V9.3724H6.66406C6.3224 9.3724 6.03906 9.65573 6.03906 9.9974C6.03906 10.3391 6.3224 10.6224 6.66406 10.6224H9.3724V13.3307C9.3724 13.6724 9.65573 13.9557 9.9974 13.9557C10.3391 13.9557 10.6224 13.6724 10.6224 13.3307V10.6224H13.3307C13.6724 10.6224 13.9557 10.3391 13.9557 9.9974C13.9557 9.65573 13.6724 9.3724 13.3307 9.3724Z"/>
                    </mask>
                    <path d="M13.3307 9.3724H10.6224V6.66406C10.6224 6.3224 10.3391 6.03906 9.9974 6.03906C9.65573 6.03906 9.3724 6.3224 9.3724 6.66406V9.3724H6.66406C6.3224 9.3724 6.03906 9.65573 6.03906 9.9974C6.03906 10.3391 6.3224 10.6224 6.66406 10.6224H9.3724V13.3307C9.3724 13.6724 9.65573 13.9557 9.9974 13.9557C10.3391 13.9557 10.6224 13.6724 10.6224 13.3307V10.6224H13.3307C13.6724 10.6224 13.9557 10.3391 13.9557 9.9974C13.9557 9.65573 13.6724 9.3724 13.3307 9.3724Z" fill="white"/>
                    <path d="M10.6224 9.3724H9.1224V10.8724H10.6224V9.3724ZM9.3724 9.3724V10.8724H10.8724V9.3724H9.3724ZM9.3724 10.6224H10.8724V9.1224H9.3724V10.6224ZM10.6224 10.6224V9.1224H9.1224V10.6224H10.6224ZM13.3307 7.8724H10.6224V10.8724H13.3307V7.8724ZM12.1224 9.3724V6.66406H9.1224V9.3724H12.1224ZM12.1224 6.66406C12.1224 5.49397 11.1675 4.53906 9.9974 4.53906V7.53906C9.51064 7.53906 9.1224 7.15082 9.1224 6.66406H12.1224ZM9.9974 4.53906C8.8273 4.53906 7.8724 5.49397 7.8724 6.66406H10.8724C10.8724 7.15082 10.4842 7.53906 9.9974 7.53906V4.53906ZM7.8724 6.66406V9.3724H10.8724V6.66406H7.8724ZM9.3724 7.8724H6.66406V10.8724H9.3724V7.8724ZM6.66406 7.8724C5.49397 7.8724 4.53906 8.8273 4.53906 9.9974H7.53906C7.53906 10.4842 7.15082 10.8724 6.66406 10.8724V7.8724ZM4.53906 9.9974C4.53906 11.1675 5.49397 12.1224 6.66406 12.1224V9.1224C7.15082 9.1224 7.53906 9.51064 7.53906 9.9974H4.53906ZM6.66406 12.1224H9.3724V9.1224H6.66406V12.1224ZM7.8724 10.6224V13.3307H10.8724V10.6224H7.8724ZM7.8724 13.3307C7.8724 14.5008 8.8273 15.4557 9.9974 15.4557V12.4557C10.4842 12.4557 10.8724 12.844 10.8724 13.3307H7.8724ZM9.9974 15.4557C11.1675 15.4557 12.1224 14.5008 12.1224 13.3307H9.1224C9.1224 12.844 9.51064 12.4557 9.9974 12.4557V15.4557ZM12.1224 13.3307V10.6224H9.1224V13.3307H12.1224ZM10.6224 12.1224H13.3307V9.1224H10.6224V12.1224ZM13.3307 12.1224C14.5008 12.1224 15.4557 11.1675 15.4557 9.9974H12.4557C12.4557 9.51064 12.844 9.1224 13.3307 9.1224V12.1224ZM15.4557 9.9974C15.4557 8.8273 14.5008 7.8724 13.3307 7.8724V10.8724C12.844 10.8724 12.4557 10.4842 12.4557 9.9974H15.4557Z" fill="white" mask="url(#path-2-inside-1_1796_18943)"/>
                </svg>
                <span>Tambah</span>
            </a>
        </div>
        <div class="card-body">
            <div id="kt_docs_jkanban_color"></div>
        </div>
    </div>

    @push('blockfoot')
        <script>
            window.kanbanData = @json($tasks);
            window.allTasksDetail = @json($allTasks);
        </script>
        <script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/default-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/js/default-delete.js') }}"></script>
        <script src="{{ asset('assets/js/developments/index.js') }}"></script>
        <script src="{{ asset('assets/js/developments/create.js') }}"></script>
        <script src="{{ asset('assets/js/developments/edit.js') }}"></script>
        <script src="{{ asset('assets/js/developments/delete.js') }}"></script>
        <script src="{{ asset('assets/js/developments/checkdev.js') }}"></script>
        <script src="{{ asset('assets/js/projects/icons.js') }}"></script>
        <script src="{{ asset('assets/js/projects/date-picker.js') }}"></script>
    @endpush
@endsection
