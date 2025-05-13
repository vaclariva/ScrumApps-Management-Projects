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
    <link rel="stylesheet" href="{{ asset('assets/css/products/b2c-variant.css') }}">
@endpush
@section('content')
    @include('products.partials.nav-tab', ['activeIndex' => 3, 'showTabVariant' => $product->has_variant])
    <div class="card rounded-top-0">
        <div class="card-body">
            <span class="tbr_alert tbr_alert--info sm">Produk <span class="fw-bolder">{{ $product->name }}</span></span>
            <div class="table-responsive mt-8">
                <table class="table align-middle">
                    <thead>
                        <tr class="align-middle">
                            <th>
                                Foto
                            </th>
                            <th>
                                Nama Varian
                            </th>
                            <th>
                                Harga End User
                            </th>
                            <th class="d-flex align-items-center gap-2 border-0">
                                <div class="form-check form-switch form-check-custom form-check-danger form-check-solid">
                                    <input
                                        class="form-check-input tbr_switch"
                                        type="checkbox"
                                        value="1"
                                        name="all_visible"
                                        id="all-visible"
                                        data-ajax-disabled="true"
                                        {{ $is_all_visible ? 'checked' : '' }}
                                    />
                                </div>
                                <a type="button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tbr_tooltip--mw-fit" data-bs-title="<span class='fw-semibold'>Toggle ini digunakan untuk menampilkan atau <br/>menyembunyikan produk di aplikasi B2C.</span>" data-bs-html="true" data-bs-placement="bottom">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M7.9974 1.33073C4.3155 1.33073 1.33073 4.3155 1.33073 7.99739C1.33073 11.6793 4.3155 14.6641 7.9974 14.6641C11.6793 14.6641 14.6641 11.6793 14.6641 7.9974C14.6641 4.3155 11.6793 1.33073 7.9974 1.33073Z" fill="#A1A5B7"/>
                                        <path d="M8 6.83073C7.72667 6.83073 7.5 7.0574 7.5 7.33073L7.5 10.6641C7.5 10.9374 7.72667 11.1641 8 11.1641C8.27333 11.1641 8.5 10.9374 8.5 10.6641L8.5 7.33073C8.5 7.0574 8.27333 6.83073 8 6.83073Z" fill="#A1A5B7"/>
                                        <path d="M7.38406 5.59C7.4174 5.67 7.46406 5.74333 7.52406 5.81C7.59073 5.87 7.66406 5.91667 7.74406 5.95C7.90406 6.01667 8.09073 6.01667 8.25073 5.95C8.33073 5.91667 8.40406 5.87 8.47073 5.81C8.53073 5.74333 8.5774 5.67 8.61073 5.59C8.64406 5.51 8.66406 5.42333 8.66406 5.33667C8.66406 5.25 8.64406 5.16333 8.61073 5.08333C8.5774 4.99667 8.53073 4.93 8.47073 4.86333C8.40406 4.80333 8.33073 4.75667 8.25073 4.72333C8.17073 4.69 8.08406 4.67 7.9974 4.67C7.91073 4.67 7.82406 4.69 7.74406 4.72333C7.66406 4.75667 7.59073 4.80333 7.52406 4.86333C7.46406 4.93 7.4174 4.99667 7.38406 5.08333C7.35073 5.16333 7.33073 5.25 7.33073 5.33667C7.33073 5.42333 7.35073 5.51 7.38406 5.59Z" fill="#A1A5B7"/>
                                    </svg>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_variants as $product_variant)
                            @php
                                $hasPhoto = str_contains($product_variant->image, 'gallery.png') ? false : true;
                            @endphp
                            <tr data-variant-id="{{ $product_variant->id }}">
                                <td>
                                    <img
                                        class="tbr_img--sm"
                                        src="{{ $product_variant->image }}" alt=""
                                        @if ($hasPhoto)
                                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class='tbr_tooltip--mw-fit' data-bs-title="<img width='300' src='{{ $product_variant->image }}' />" data-bs-html="true"
                                        @endif
                                    >
                                </td>
                                <td>{{ $product_variant->variant_name ?? '-' }}</td>
                                <td>
                                    <div class="form-check form-switch form-check-custom form-check-danger form-check-solid">
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input
                                                type="text"
                                                class="tbr_form form-control autonumeric"
                                                min="0"
                                                name="price"
                                                id="price"
                                                data-ajax-disabled="true"
                                                value="{{ $product_variant->price ?? '0' }}"
                                            />
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch form-check-custom form-check-danger form-check-solid">
                                        <input
                                            class="form-check-input tbr_switch"
                                            type="checkbox"
                                            value="1"
                                            name="is_visible"
                                            id="is_visible"
                                            data-ajax-disabled="true"
                                            {{ $product_variant->is_visible ? 'checked' : '' }}
                                        />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('blockfoot')
    <script>
        const urlAllVisible = '{{ route('products.storeB2cVisibility', $product->id) }}';
        const storeUrl = '{{ route('products.storeB2c', $product->id) }}';
    </script>
    <script src="{{ asset('assets/js/autonumeric.js') }}"></script>
    <script src="{{ asset('assets/js/products/b2c-variant.js') }}"></script>
    <script>
        AutoNumeric.multiple(".autonumeric", {
            decimalPlaces: 0,
            decimalCharacter: ',',
            digitGroupSeparator: '.',
            minimumValue: 0
        });
    </script>
@endpush
