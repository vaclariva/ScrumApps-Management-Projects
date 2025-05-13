@php
    $isEmptyVariant = count($variants) == 0;
@endphp
@extends('layouts.app')
@section('pageTitle', 'Detail')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Produk', 'link' => route('products.index')],
            ['title' => 'Semua', 'link' => route('products.index')],
            ['title' => 'Detail', 'link' => ''],
        ]
    ])
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('assets/css/products/variant.css') }}">
@endpush
@section('content')
    @include('products.partials.nav-tab', ['activeIndex' => 1, 'showTabVariant' => $product->has_variant])
    <div class="card rounded-top-0">
        <div class="card-body">
            <span class="tbr_alert tbr_alert--info sm">Produk <span class="fw-bolder">{{ $product->name }}</span></span>
            <div class="table-responsive mt-8">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>
                                Varian
                                <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                            </th>
                            <th>
                                Satuan
                                <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                            </th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($variants as $variant)
                            @php
                                $hasPhoto = str_contains($variant->image, 'gallery.png') ? false : true;
                            @endphp
                            <tr data-variant-id="{{ $variant->id }}">
                                <td class="d-flex align-items-center gap-2">
                                    <img
                                        class="tbr_img--sm"
                                        src="{{ $variant->image }}" alt=""
                                        @if ($hasPhoto)
                                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class='tbr_tooltip--mw-fit' data-bs-title="<img width='300' src='{{ $variant->image }}' />" data-bs-html="true"
                                        @endif
                                    >
                                    <label
                                        class="btn tbr_btn tbr_btn--icon sm tbr_btn--light-success rounded-circle tbr_upload"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Unggah foto"
                                        data-ajax-disabled="true"
                                        for="image--{{ $loop->iteration }}"
                                    >
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.4" d="M20.5 10.19H17.61C15.24 10.19 13.31 8.26 13.31 5.89V3C13.31 2.45 12.86 2 12.31 2H8.07C4.99 2 2.5 4 2.5 7.57V16.43C2.5 20 4.99 22 8.07 22H15.93C19.01 22 21.5 20 21.5 16.43V11.19C21.5 10.64 21.05 10.19 20.5 10.19Z" fill="#17C653"/>
                                            <path d="M15.7997 2.21048C15.3897 1.80048 14.6797 2.08048 14.6797 2.65048V6.14048C14.6797 7.60048 15.9197 8.81048 17.4297 8.81048C18.3797 8.82048 19.6997 8.82048 20.8297 8.82048C21.3997 8.82048 21.6997 8.15048 21.2997 7.75048C19.8597 6.30048 17.2797 3.69048 15.7997 2.21048Z" fill="#17C653"/>
                                            <path d="M11.5275 12.47L9.5275 10.47C9.5175 10.46 9.5075 10.46 9.5075 10.45C9.4475 10.39 9.3675 10.34 9.2875 10.3C9.2775 10.3 9.2775 10.3 9.2675 10.3C9.1875 10.27 9.1075 10.26 9.0275 10.25C8.9975 10.25 8.9775 10.25 8.9475 10.25C8.8875 10.25 8.8175 10.27 8.7575 10.29C8.7275 10.3 8.7075 10.31 8.6875 10.32C8.6075 10.36 8.5275 10.4 8.4675 10.47L6.4675 12.47C6.1775 12.76 6.1775 13.24 6.4675 13.53C6.7575 13.82 7.2375 13.82 7.5275 13.53L8.2475 12.81V17C8.2475 17.41 8.5875 17.75 8.9975 17.75C9.4075 17.75 9.7475 17.41 9.7475 17V12.81L10.4675 13.53C10.6175 13.68 10.8075 13.75 10.9975 13.75C11.1875 13.75 11.3775 13.68 11.5275 13.53C11.8175 13.24 11.8175 12.76 11.5275 12.47Z" fill="#17C653"/>
                                        </svg>
                                    </label>
                                    <span
                                        @class([
                                            'btn tbr_btn tbr_btn--icon sm tbr_btn--light-primary rounded-circle tbr_remove_upload',
                                            'd-none' => !$hasPhoto
                                        ])
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Hapus foto"
                                        onclick="deletePhoto({el: this, url: '{{ route('products.deleteImageVariant', [$product->id, $variant->id]) }}'})"
                                    >
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M1.8382 15.572L0.324255 14.058C0.221787 13.9604 0.140212 13.8429 0.0844757 13.7128C0.028739 13.5827 0 13.4426 0 13.3011C0 13.1595 0.028739 13.0194 0.0844757 12.8893C0.140212 12.7592 0.221787 12.6417 0.324255 12.5441L12.5439 0.324258C12.6416 0.221789 12.759 0.140214 12.8892 0.0844767C13.0193 0.0287394 13.1594 0 13.3009 0C13.4425 0 13.5825 0.0287394 13.7127 0.0844767C13.8428 0.140214 13.9602 0.221789 14.0579 0.324258L15.5718 1.83822C15.6743 1.93588 15.7559 2.05333 15.8116 2.18345C15.8673 2.31357 15.8961 2.45365 15.8961 2.5952C15.8961 2.73675 15.8673 2.87683 15.8116 3.00695C15.7559 3.13707 15.6743 3.25452 15.5718 3.35218L3.35214 15.572C3.25464 15.6748 3.13725 15.7566 3.00711 15.8125C2.87697 15.8684 2.73681 15.8972 2.59517 15.8972C2.45353 15.8972 2.31337 15.8684 2.18323 15.8125C2.05309 15.7566 1.9357 15.6748 1.8382 15.572Z" fill="#DB0916"/>
                                            <path d="M15.6734 14.058L14.1594 15.572C14.0618 15.6745 13.9443 15.7561 13.8142 15.8118C13.6841 15.8675 13.544 15.8963 13.4025 15.8963C13.2609 15.8963 13.1208 15.8675 12.9907 15.8118C12.8606 15.7561 12.7432 15.6745 12.6455 15.572L0.425817 3.35218C0.323349 3.25452 0.241775 3.13707 0.186038 3.00695C0.130302 2.87683 0.101563 2.73675 0.101562 2.5952C0.101563 2.45365 0.130302 2.31357 0.186038 2.18345C0.241775 2.05333 0.323349 1.93588 0.425817 1.83822L1.93976 0.324258C2.03742 0.221789 2.15487 0.140214 2.28498 0.0844767C2.4151 0.0287394 2.55518 0 2.69673 0C2.83828 0 2.97836 0.0287394 3.10848 0.0844767C3.2386 0.140214 3.35604 0.221789 3.4537 0.324258L15.6734 12.5441C15.7761 12.6416 15.858 12.759 15.9139 12.8891C15.9698 13.0193 15.9986 13.1594 15.9986 13.3011C15.9986 13.4427 15.9698 13.5829 15.9139 13.713C15.858 13.8432 15.7761 13.9605 15.6734 14.058Z" fill="#DB0916"/>
                                        </svg>
                                    </span>
                                    <input type="file" name="image" id="image--{{ $loop->iteration }}" accept="image/*" hidden>
                                </td>
                                <td>
                                    <input type="text" class="tbr_form form-control md" name="name" value="{{ $variant->name }}"/>
                                </td>
                                <td>
                                    <div class="position-relative">
                                        @if ($variant->unit_deleted_at)
                                            <a type="button" class="tbr_hover--opacity tbr_unit--deleted" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Satuan ini telah dihapus dari sistem dan tidak dapat digunakan lagi.">
                                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M18.802 13.2641L13.4687 3.66406C12.752 2.3724 11.7603 1.66406 10.6687 1.66406C9.57702 1.66406 8.58535 2.3724 7.86868 3.66406L2.53535 13.2641C1.86035 14.4891 1.78535 15.6641 2.32702 16.5891C2.86868 17.5141 3.93535 18.0224 5.33535 18.0224H16.002C17.402 18.0224 18.4687 17.5141 19.0103 16.5891C19.552 15.6641 19.477 14.4807 18.802 13.2641Z" fill="#F6B100"/>
                                                    <path d="M10.6719 12.2917C10.3302 12.2917 10.0469 12.0083 10.0469 11.6667V7.5C10.0469 7.15833 10.3302 6.875 10.6719 6.875C11.0135 6.875 11.2969 7.15833 11.2969 7.5V11.6667C11.2969 12.0083 11.0135 12.2917 10.6719 12.2917Z" fill="#F6B100"/>
                                                    <path d="M10.6693 14.9969C10.6193 14.9969 10.5609 14.9885 10.5026 14.9802C10.4526 14.9719 10.4026 14.9552 10.3526 14.9302C10.3026 14.9135 10.2526 14.8885 10.2026 14.8552C10.1609 14.8219 10.1193 14.7885 10.0776 14.7552C9.9276 14.5969 9.83594 14.3802 9.83594 14.1635C9.83594 13.9469 9.9276 13.7302 10.0776 13.5719C10.1193 13.5385 10.1609 13.5052 10.2026 13.4719C10.2526 13.4385 10.3026 13.4135 10.3526 13.3969C10.4026 13.3719 10.4526 13.3552 10.5026 13.3469C10.6109 13.3219 10.7276 13.3219 10.8276 13.3469C10.8859 13.3552 10.9359 13.3719 10.9859 13.3969C11.0359 13.4135 11.0859 13.4385 11.1359 13.4719C11.1776 13.5052 11.2193 13.5385 11.2609 13.5719C11.4109 13.7302 11.5026 13.9469 11.5026 14.1635C11.5026 14.3802 11.4109 14.5969 11.2609 14.7552C11.2193 14.7885 11.1776 14.8219 11.1359 14.8552C11.0859 14.8885 11.0359 14.9135 10.9859 14.9302C10.9359 14.9552 10.8859 14.9719 10.8276 14.9802C10.7776 14.9885 10.7193 14.9969 10.6693 14.9969Z" fill="#F6B100"/>
                                                </svg>
                                            </a>
                                        @endif
                                        <select name="unit" class="tbr_form form-control form-select form-select-solid md" id="" data-control="select2">
                                            @if ($variant->unit_deleted_at)
                                                <option value="" selected disabled>{{ $variant->unit_deleted_name }}</option>
                                            @else
                                                <option value="init" selected disabled>Pilih satuan</option>
                                            @endif
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}" {{ $variant->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </td>
                                <td>
                                    <button class="btn tbr_btn tbr_btn--icon tbr_btn--light-primary sm mx-auto tbr_button--variant" anim="ripple" data-url-delete="{{ route('products.destroyVariant', [$product->id,$variant->id]) }}" data-loading="false">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6203 11.5446C11.4095 11.7542 11.1244 11.8718 10.8271 11.8718C10.5299 11.8718 10.2448 11.7542 10.034 11.5446L0.426523 2.04964C0.321079 1.94506 0.237385 1.82063 0.18027 1.68354C0.123155 1.54645 0.09375 1.39941 0.09375 1.25089C0.09375 1.10238 0.123155 0.955335 0.18027 0.818243C0.237385 0.681152 0.321079 0.556725 0.426523 0.452142C0.637306 0.24261 0.922439 0.125 1.21965 0.125C1.51686 0.125 1.80199 0.24261 2.01277 0.452142L11.6203 9.94714C11.7257 10.0517 11.8094 10.1762 11.8665 10.3132C11.9236 10.4503 11.953 10.5974 11.953 10.7459C11.953 10.8944 11.9236 11.0414 11.8665 11.1785C11.8094 11.3156 11.7257 11.4401 11.6203 11.5446Z" fill="#F8285A"/>
                                            <path opacity="0.3" d="M2.01381 11.6247C1.79898 11.8426 1.50643 11.9661 1.20051 11.9682C0.894594 11.9703 0.600367 11.8508 0.382558 11.636C0.164749 11.4212 0.0411998 11.1286 0.03909 10.8227C0.0369802 10.5168 0.156482 10.2226 0.371308 10.0047L9.97881 0.374746C10.1936 0.156937 10.4862 0.0333873 10.7921 0.0312775C11.098 0.0291677 11.3922 0.14867 11.6101 0.363495C11.8279 0.578321 11.9514 0.870872 11.9535 1.17679C11.9556 1.48271 11.8361 1.77694 11.6213 1.99475L2.01381 11.6247Z" fill="#F8285A"/>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div @class(['d-flex flex-column gap-2 flex-center tbr_empty--variant', 'd-none' => !$isEmptyVariant])>
                    <img src="{{ asset('assets/svg/illustrations/empty-variant.svg') }}" alt="" srcset="">
                    <h5 class="mb-0">Varian Produk Kosong</h5>
                    <span class="text-gray-600 mb-5">Silakan mulai menambahkan item sekarang.</span>
                </div>
                <button
                    class="btn tbr_btn tbr_btn--light-primary sm d-flex flex-center mx-auto gap-4 tbr_add--variant"
                    onclick="addVariant()"
                >
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" d="M7.33333 8.66927H4.66667C4.48986 8.66927 4.32029 8.59903 4.19526 8.47401C4.07024 8.34898 4 8.17942 4 8.0026C4 7.82579 4.07024 7.65622 4.19526 7.5312C4.32029 7.40618 4.48986 7.33594 4.66667 7.33594H7.33333V8.66927ZM11.3333 7.33594H8.66667V8.66927H11.3333C11.5101 8.66927 11.6797 8.59903 11.8047 8.47401C11.9298 8.34898 12 8.17942 12 8.0026C12 7.82579 11.9298 7.65622 11.8047 7.5312C11.6797 7.40618 11.5101 7.33594 11.3333 7.33594Z" fill="#DB0916"/>
                        <path opacity="0.3" d="M10.7959 1.33594H5.20927C3.07009 1.33594 1.33594 3.07009 1.33594 5.20927V10.7959C1.33594 12.9351 3.07009 14.6693 5.20927 14.6693H10.7959C12.9351 14.6693 14.6693 12.9351 14.6693 10.7959V5.20927C14.6693 3.07009 12.9351 1.33594 10.7959 1.33594Z" fill="#DB0916"/>
                        <path d="M11.3333 7.33333H8.66667V4.66667C8.66667 4.48986 8.59643 4.32029 8.4714 4.19526C8.34638 4.07024 8.17681 4 8 4C7.82319 4 7.65362 4.07024 7.5286 4.19526C7.40357 4.32029 7.33333 4.48986 7.33333 4.66667V7.33333H4.66667C4.48986 7.33333 4.32029 7.40357 4.19526 7.5286C4.07024 7.65362 4 7.82319 4 8C4 8.17681 4.07024 8.34638 4.19526 8.4714C4.32029 8.59643 4.48986 8.66667 4.66667 8.66667H7.33333V11.3333C7.33333 11.5101 7.40357 11.6797 7.5286 11.8047C7.65362 11.9298 7.82319 12 8 12C8.17681 12 8.34638 11.9298 8.4714 11.8047C8.59643 11.6797 8.66667 11.5101 8.66667 11.3333V8.66667H11.3333C11.5101 8.66667 11.6797 8.59643 11.8047 8.4714C11.9298 8.34638 12 8.17681 12 8C12 7.82319 11.9298 7.65362 11.8047 7.5286C11.6797 7.40357 11.5101 7.33333 11.3333 7.33333Z" fill="#DB0916"/>
                    </svg>
                    <span class="fw-bolder">Tambah Varian</span>
                </button>
            </div>
        </div>
    </div>
    @include('products.partials.detail.modal-confirmation-variant')
    @include('products.partials.detail.modal-delete-variant')
@endsection
@push('blockfoot')
    <script>
        const units = @json($units);
        const urlStore = '{{ route('products.storeVariant', $product->id) }}'
        const urlCheckVariant = '{{ route('products.checkVariant', $product->id) }}'
        const productId = '{{ $product->id }}'
        const galleryPng = '{{ asset('assets/images/gallery.png') }}'
        let indexDynamicForm = {{count($variants)+1}};
    </script>
    <script src="{{ asset('assets/js/default-delete.js') }}"></script>
    <script src="{{ asset('assets/js/products/variant.js') }}"></script>
    <script src="{{ asset('assets/js/autonumeric.js') }}"></script>
    <script>
        AutoNumeric.multiple(`.autonumeric`, {
            allowDecimalPadding: false,
            decimalCharacter: ",",
            digitGroupSeparator: ".",
            minimumValue: 0,
        });
    </script>
@endpush
