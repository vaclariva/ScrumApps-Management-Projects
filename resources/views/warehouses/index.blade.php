@extends('layouts.app')
@section('pageTitle', 'Lokasi')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Inventori', 'link' => ''],
            ['title' => 'Lokasi', 'link' => ''],
        ]
    ])
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
@endpush
@section('content')
    <div class="row gap-4 gap-lg-0">
        <div class="col-lg-5">
            <div class="card">
                <form action="{{ route('warehouses.store') }}" method="POST" class="tbr_main_form">
                    <div class="card-header">
                        <div>
                            <h5>Lokasi</h5>
                            <span class="text-gray-600">Isi formulir dibawah untuk menambahkan lokasi.</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-8">
                            <label for="name" class="h6 tbr_font--weight-bold">Nama</label>
                            <input type="text" name="name" id="name" class="tbr_form form-control">
                        </div>
                        <div class="form-group">
                            <label for="desc" class="h6 tbr_font--weight-bold">Keterangan</label>
                            <textarea name="desc" spellcheck="false" class="tbr_form form-control" id="desc" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-4">
                        <button anim="ripple" type="submit" class="btn tbr_btn tbr_btn--primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-8">
                        @include('include.default-datatable-search', ['tableId' => 'table-warehouse', 'fullInResponsive' => true])
                    </div>
                    @include('include.default-datatable', [
                        'tableId' => 'table-warehouse',
                        'columns' => ['No', 'Nama', 'Keterangan', 'Aksi']
                    ])
                </div>
            </div>
        </div>
    </div>
    @include('include.default-modal-delete')
    @include('warehouses.partials.modal-edit')
    @push('blockfoot')
        <script>
            const urlDatatable = '{{ route('warehouses.list') }}';
        </script>
        <script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/default-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/default-delete.js') }}"></script>
        <script src="{{ asset('assets/js/warehouses/index.js') }}"></script>
    @endpush
@endsection
