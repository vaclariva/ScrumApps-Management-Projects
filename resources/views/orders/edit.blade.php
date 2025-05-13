@extends('layouts.app')
@section('pageTitle', 'Detail Pesanan')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Penjualan', 'link' => route('orders.index')],
            ['title' => 'Pesanan', 'link' => route('orders.index')],
            ['title' => 'Detail', 'link' => ''],
        ]
    ])
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
@endpush
@section('content')
{{$order}}
{{ $orderDelivery }}
    <div class="d-flex flex-column gap-5">
        @include('orders.partials.edit.card-detail-order')
        @include('orders.partials.create.card-item-sales-order')
    </div>

    @include('orders.partials.edit.modal-cancel')
    @include('orders.partials.edit.modal-info')
    @include('orders.partials.edit.modal-process')
    @include('orders.partials.edit.modal-save')
@endsection
@push('blockfoot')
    <script>
        // inject sticky bottom content
        $('#kt_app_main').append(
            `<div class="position-sticky bottom-0 start-0 end-0 tbr_bg--white py-4 px-8">
                <div class="d-flex justify-content-between">
                    <button anim="ripple" type="button" id="cancel" data-bs-toggle="modal" data-bs-target="#tbr_modal_cancel" class="btn tbr_btn tbr_btn--light-primary">Batalkan Pesanan</button>
                    <div class="justify-content-end gap-4">
                        <button type="button" onclick="deleteOrder({el: this})" anim="ripple" class="btn tbr_btn tbr_btn--light">Buat Pesanan Baru</button>
                        <button anim="ripple" type="button" id="save-edit" data-bs-toggle="modal" data-bs-target="#tbr_modal_save_edit"  class="btn tbr_btn tbr_btn--primary">Simpan</button>
                        <button anim="ripple" type="button" id="process" data-bs-toggle="modal" data-bs-target="#tbr_modal_process" class="btn tbr_btn tbr_btn--primary">Proses Pesanan</button>
                    </div>
                </div>
            </div>`
        );
    </script>
    <script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/default-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/orders/edit.js') }}"></script>
@endpush
