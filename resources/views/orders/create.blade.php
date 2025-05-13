@extends('layouts.app')
@section('pageTitle', 'Buat Pesanan')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Penjualan', 'link' => route('orders.index')],
            ['title' => 'Pesanan', 'link' => route('orders.index')],
            ['title' => 'Buat Pesanan', 'link' => ''],
        ]
    ])
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/orders/create.css') }}">
@endpush
@section('content')
    <div class="d-flex flex-column gap-5">
        @include('orders.partials.create.card-info-sales-order')
        @include('orders.partials.create.card-item-sales-order')
    </div>

    @include('orders.partials.create.modal-product')
    @include('orders.partials.create.modal-type-product')
    @include('orders.partials.create.modal-save')
    @include('orders.partials.create.modal-change-partner')
@endsection
@push('blockfoot')
    <script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/default-datatable.js')}}"></script>
    <script src="{{ asset('assets/js/autonumeric.js')}}"></script>
    <script src="{{ asset('assets/js/orders/create.js') }}"></script>
    <script src="{{ asset('assets/js/orders/create-item-so.js') }}"></script>
    <script src="{{ asset('assets/js/orders/dynamic-form.js') }}"></script>
    <script>
        const orderId = '{{ $order->id }}';
        const urlIndex = '{{ route('orders.index') }}';
        const urlUpdateSalesOrder = '{{ route('orders.updatePartial', $order->id) }}';
        const urlDatatableProduct = '{{ route('orders.getProductList') }}';
        const urlGetOrderProducts = '{{ route('orders.getOrderProduct') }}';
        const urlAddOrderProduct = '{{ route('orders.addProduct') }}';
        const urlChangeProductType = '{{ route('orders.changeProductType', $order->id) }}';
        const urlDeleteOrder = '{{ route('orders.destroy', $order->id) }}';
        const urlSubmitOrder = '{{ route('orders.store') }}';
        const circleSvg = '{{ asset('assets/svg/icons/circle.svg') }}';

        let dtProducts;

        AutoNumeric.multiple(".autonumeric", {
            decimalPlaces: 0,
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            minimumValue: 0
        });

        // inject sticky bottom content
        $('#kt_app_main').append(
            `<div class="position-sticky bottom-0 start-0 end-0 tbr_bg--white py-4 px-8">
                <div class="d-flex justify-content-end gap-4">
                    <button type="button" onclick="deleteOrder({el: this})" anim="ripple" class="btn tbr_btn tbr_btn--light">Batal</button>
                    <button anim="ripple" type="button" data-bs-toggle="modal" data-bs-target="#tbr_modal_save" onclick="$('#tbr_modal_save').find('button[type=submit]').attr('onclick', 'submitOrder({el: this, withRedirect: false})')" class="btn tbr_btn tbr_btn--light">Simpan & Tambah Baru</button>
                    <button anim="ripple" type="button" data-bs-toggle="modal" data-bs-target="#tbr_modal_save" onclick="$('#tbr_modal_save').find('button[type=submit]').attr('onclick', 'submitOrder({el: this, withRedirect: true})')" class="btn tbr_btn tbr_btn--primary">Simpan</button>
                </div>
            </div>`
        );

        // set default value select2
        $(function(){
            initDataProduct();
            if({{ $order->warehouse_id != null ? 'true' : 'false' }}){
                $('#warehouse_id').val({{ $order->warehouse_id }}).trigger('change').trigger('select2:select', [false]);
            }
            if({{ $order->partner_id != null ? 'true' : 'false' }}){
                $('#partner_id').val({{ $order->partner_id }}).trigger('change').trigger('select2:select', [false]);
            }
            getOrderProducts();
        });

    </script>
@endpush
