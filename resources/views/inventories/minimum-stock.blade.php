@extends('layouts.app')
@section('pageTitle', 'Daftar Stok Minimal')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [['title' => 'Inventori', 'link' => ''], ['title' => 'Stok', 'link' => '']],
    ])
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/inventories/minimum-stock.css') }}">
@endpush
@section('content')
    @include('inventories.partials.nav-tab', ['activeIndex' => 1])
    <div class="card rounded-top-0">
        <div class="card-body">
            <div class="row justify-content-end mb-8">
                <div class="col-lg-3 mb-4 mb-lg-0">
                    @include('include.default-datatable-search', [
                        'fullInResponsive' => true,
                        'tableId' => 'table-inventory-minimum-stock',
                    ])
                </div>
                <div class="col-lg-3 filter">
                    <select name="warehouse_id" id="warehouse-id" class="tbr_form form-select form-select-solid" data-dropdown-parent=".filter" data-control="select2" data-placeholder="Pilih Gudang">
                        <option></option>
                        @foreach ($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $loop->index == 0 ? 'selected' : '' }}>{{ $warehouse->name ?? '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                @include('include.default-datatable', [
                    'tableId' => 'table-inventory-minimum-stock',
                    'columns' => ['No', 'Produk', 'Stok Minimal', 'Satuan'],
                ])
            </div>
        </div>
    </div>
@endsection
@push('blockfoot')
    <script>
        var dtInventoryMinimumStock;
        const urlDatatable = '{{ route('inventories.minimumStock.list') }}';

        var dataDatatable = function(d) {
            d.warehouse = $('#warehouse-id').val();
        }
    </script>
    <script src="{{ asset('assets/js/autonumeric.js') }}"></script>
    <script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/default-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/inventories/minimum-stock.js') }}"></script>
@endpush
