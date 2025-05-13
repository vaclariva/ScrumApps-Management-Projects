@extends('layouts.app')
@section('pageTitle', 'Daftar Riwayat')
@section('breadcrumb')
    @include('include.default-breadcrumb',  [
        'breadcrumbs' => [
            ['title' => 'Inventori', 'link' => route('inventories.index')],
            ['title' => 'Stok', 'link' => route('inventories.index')],
            ['title' => 'Riwayat', 'link' => '']
        ]
    ])
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row justify-content-lg-end gap-4 mb-8">
                <div class="d-flex flex-column flex-lg-row gap-4">
                    @include('include.default-datatable-search', ['fullInResponsive' => true, 'tableId' => 'table-stock-histories'])
                    @include('stock-histories.partials.listing.filter', ['filterId' => 'filter-stock-histories-id', 'dt' => 'dtStockHistories'])
                </div>
            </div>
            @include('stock-histories.partials.listing.result-filter', ['filterId' => 'filter-stock-histories-id'])
            @include('include.default-datatable', ['tableId' => 'table-stock-histories', 'columns'=>
                [
                    'No',
                    'Waktu',
                    'Pelaksana',
                    'Lokasi',
                    'Produk',
                    'Stok Awal',
                    'Perubahan',
                    'Stok Akhir',
                    'Peristiwa',
                ]
            ])
        </div>
    </div>
    @include('include.default-modal-delete')
@endsection
@push('blockfoot')
    <script>
        var dtProducts;
        const urlDatatable = '{{ route('inventories-history.list') }}'
        var dataDatatable = function(d){
            d.startDate = getAppliedFilterDate({
                id: '#date', dataName: 'start-date'
            });
            d.endDate = getAppliedFilterDate({
                id: '#date', dataName: 'end-date'
            });
            d.movementType = getCheckboxChecked({
                name:'type'
            });
            d.warehouse = getCheckboxChecked({
                name:'warehouse'
            });
            d.productVariant = getCheckboxChecked({
                name:'product'
            });
            d.correction = $('input[name="correction"]').is(':checked');
        }

        function getAppliedFilterDate({id, dataName}){
            return $(id).data(dataName);
        }

        function getCheckboxChecked({name}){
            let allInputValues = $(`input[name="${name}[]"]:checked`);
            let values = [];
            allInputValues.each(function(){
                values.push($(this).val());
            });
            return values;
        }

    </script>
    <script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/default-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/default-delete.js') }}"></script>
    <script src="{{ asset('assets/js/stock-histories/index.js') }}"></script>
@endpush
