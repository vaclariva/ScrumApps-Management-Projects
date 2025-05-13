 @php
    $hasPhoto = str_contains($product->feature_image, 'gallery.png') ? false : true;
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
@section('content')
    @include('products.partials.nav-tab', ['activeIndex' => 0, 'showTabVariant' => $product->has_variant])
    <div class="card rounded-top-0">
        <div class="card-body">
            <form
                id="form-detail"
                action="{{ route('products.update', $product->id) }}"
                method="POST"
                class="tbr_main_form"
                {{-- data-no-toast-success="true" --}}
                data-complete-callback="completeCallback"
            >
                @method("PATCH")
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Foto Utama Produk</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div
                                id="empty-photo"
                                class="tbr_avatar tbr_avatar--input tbr_avatar--default d-none">
                            </div>
                            <img
                                class="tbr_avatar tbr_avatar--input"
                                id="photo-preview"
                                src="{{ $product->feature_image ?? '' }}" alt=""
                                @if ($hasPhoto)
                                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class='tbr_tooltip--mw-fit' data-bs-title="<img width='300' src='{{ $product->feature_image }}' />" data-bs-html="true"
                                @endif
                            />
                            <label
                                class="btn tbr_btn tbr_btn--icon sm tbr_btn--light-success rounded-circle"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Unggah foto"
                                data-ajax-disabled="true"
                            >
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M20.5 10.19H17.61C15.24 10.19 13.31 8.26 13.31 5.89V3C13.31 2.45 12.86 2 12.31 2H8.07C4.99 2 2.5 4 2.5 7.57V16.43C2.5 20 4.99 22 8.07 22H15.93C19.01 22 21.5 20 21.5 16.43V11.19C21.5 10.64 21.05 10.19 20.5 10.19Z" fill="#17C653"/>
                                    <path d="M15.7997 2.21048C15.3897 1.80048 14.6797 2.08048 14.6797 2.65048V6.14048C14.6797 7.60048 15.9197 8.81048 17.4297 8.81048C18.3797 8.82048 19.6997 8.82048 20.8297 8.82048C21.3997 8.82048 21.6997 8.15048 21.2997 7.75048C19.8597 6.30048 17.2797 3.69048 15.7997 2.21048Z" fill="#17C653"/>
                                    <path d="M11.5275 12.47L9.5275 10.47C9.5175 10.46 9.5075 10.46 9.5075 10.45C9.4475 10.39 9.3675 10.34 9.2875 10.3C9.2775 10.3 9.2775 10.3 9.2675 10.3C9.1875 10.27 9.1075 10.26 9.0275 10.25C8.9975 10.25 8.9775 10.25 8.9475 10.25C8.8875 10.25 8.8175 10.27 8.7575 10.29C8.7275 10.3 8.7075 10.31 8.6875 10.32C8.6075 10.36 8.5275 10.4 8.4675 10.47L6.4675 12.47C6.1775 12.76 6.1775 13.24 6.4675 13.53C6.7575 13.82 7.2375 13.82 7.5275 13.53L8.2475 12.81V17C8.2475 17.41 8.5875 17.75 8.9975 17.75C9.4075 17.75 9.7475 17.41 9.7475 17V12.81L10.4675 13.53C10.6175 13.68 10.8075 13.75 10.9975 13.75C11.1875 13.75 11.3775 13.68 11.5275 13.53C11.8175 13.24 11.8175 12.76 11.5275 12.47Z" fill="#17C653"/>
                                </svg>
                                <input type="file" onchange="setPreviewPhoto({el: this})" hidden name="feature_image" accept=".png, .jpg, .jpeg">
                            </label>
                            <span
                                class="btn tbr_btn tbr_btn--icon sm tbr_btn--light-primary rounded-circle d-none"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Hapus foto"
                                onclick="deletePhoto()"
                            >
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M1.8382 15.572L0.324255 14.058C0.221787 13.9604 0.140212 13.8429 0.0844757 13.7128C0.028739 13.5827 0 13.4426 0 13.3011C0 13.1595 0.028739 13.0194 0.0844757 12.8893C0.140212 12.7592 0.221787 12.6417 0.324255 12.5441L12.5439 0.324258C12.6416 0.221789 12.759 0.140214 12.8892 0.0844767C13.0193 0.0287394 13.1594 0 13.3009 0C13.4425 0 13.5825 0.0287394 13.7127 0.0844767C13.8428 0.140214 13.9602 0.221789 14.0579 0.324258L15.5718 1.83822C15.6743 1.93588 15.7559 2.05333 15.8116 2.18345C15.8673 2.31357 15.8961 2.45365 15.8961 2.5952C15.8961 2.73675 15.8673 2.87683 15.8116 3.00695C15.7559 3.13707 15.6743 3.25452 15.5718 3.35218L3.35214 15.572C3.25464 15.6748 3.13725 15.7566 3.00711 15.8125C2.87697 15.8684 2.73681 15.8972 2.59517 15.8972C2.45353 15.8972 2.31337 15.8684 2.18323 15.8125C2.05309 15.7566 1.9357 15.6748 1.8382 15.572Z" fill="#DB0916"/>
                                    <path d="M15.6734 14.058L14.1594 15.572C14.0618 15.6745 13.9443 15.7561 13.8142 15.8118C13.6841 15.8675 13.544 15.8963 13.4025 15.8963C13.2609 15.8963 13.1208 15.8675 12.9907 15.8118C12.8606 15.7561 12.7432 15.6745 12.6455 15.572L0.425817 3.35218C0.323349 3.25452 0.241775 3.13707 0.186038 3.00695C0.130302 2.87683 0.101563 2.73675 0.101562 2.5952C0.101563 2.45365 0.130302 2.31357 0.186038 2.18345C0.241775 2.05333 0.323349 1.93588 0.425817 1.83822L1.93976 0.324258C2.03742 0.221789 2.15487 0.140214 2.28498 0.0844767C2.4151 0.0287394 2.55518 0 2.69673 0C2.83828 0 2.97836 0.0287394 3.10848 0.0844767C3.2386 0.140214 3.35604 0.221789 3.4537 0.324258L15.6734 12.5441C15.7761 12.6416 15.858 12.759 15.9139 12.8891C15.9698 13.0193 15.9986 13.1594 15.9986 13.3011C15.9986 13.4427 15.9698 13.5829 15.9139 13.713C15.858 13.8432 15.7761 13.9605 15.6734 14.058Z" fill="#DB0916"/>
                                </svg>
                            </span>
                        </div>
                        <span class="tbr_text--icon">Foto harus memiliki Dimensi 150 x 150 px (rasio 1:1), Size maksimum 2Mb.<br/>Format file yang diizinkan adalah PNG, JPG, atau JPEG.</span>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="name" class="h6 tbr_font--weight-bold mt-4">Nama</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8">
                        <input
                            type="text"
                            class="tbr_form form-control"
                            name="name"
                            id="name"
                            value="{{ $product->name ?? '-' }}"
                            data-ajax-disabled="true"
                        />
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="categories" class="h6 tbr_font--weight-bold mt-4">Kategori</label>
                    </div>
                    <div class="col-lg-8">
                        <select
                            name="categories[]"
                            class="form-select tbr_form  form-select-solid"
                            data-control="select2"
                            data-close-on-select="false"
                            multiple="multiple"
                            data-ajax-disabled="true"
                            data-placeholder="Uncategories"
                        >
                            <option></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Jenis</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input
                                class="form-check-input"
                                type="radio"
                                value="Popular"
                                name="type"
                                id="popular"
                                @checked($product->type == 'Popular')
                                data-ajax-disabled="true"
                            />
                            <label class="form-check-label" for="popular">
                                Populer
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input
                                class="form-check-input"
                                type="radio"
                                value="Pengembangan"
                                name="type"
                                id="pengembangan" @checked($product->type == 'Pengembangan')
                                data-ajax-disabled="true"
                            />
                            <label class="form-check-label" for="pengembangan">
                                Pengembangan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Produk Memiliki Varian? </label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm mx-1">wajib</span>
                        <a type="button" data-bs-toggle="tooltip" data-bs-custom-class="tbr_tooltip--mw-fit" data-bs-title="<span class='fw-semibold'>Pilih <span class='tbr_text--primary'>Ya</span> jika produk ini memiliki variasi seperti ukuran, warna, atau tipe.<br/>Jika <span class='tbr_text--primary'>Tidak</span> produk akan ditampilkan sebagai satu versi tanpa variasi.</span>" data-bs-html="true" data-bs-placement="bottom">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M7.9974 1.33073C4.3155 1.33073 1.33073 4.3155 1.33073 7.99739C1.33073 11.6793 4.3155 14.6641 7.9974 14.6641C11.6793 14.6641 14.6641 11.6793 14.6641 7.9974C14.6641 4.3155 11.6793 1.33073 7.9974 1.33073Z" fill="#A1A5B7"/>
                                <path d="M8 6.83073C7.72667 6.83073 7.5 7.0574 7.5 7.33073L7.5 10.6641C7.5 10.9374 7.72667 11.1641 8 11.1641C8.27333 11.1641 8.5 10.9374 8.5 10.6641L8.5 7.33073C8.5 7.0574 8.27333 6.83073 8 6.83073Z" fill="#A1A5B7"/>
                                <path d="M7.38406 5.59C7.4174 5.67 7.46406 5.74333 7.52406 5.81C7.59073 5.87 7.66406 5.91667 7.74406 5.95C7.90406 6.01667 8.09073 6.01667 8.25073 5.95C8.33073 5.91667 8.40406 5.87 8.47073 5.81C8.53073 5.74333 8.5774 5.67 8.61073 5.59C8.64406 5.51 8.66406 5.42333 8.66406 5.33667C8.66406 5.25 8.64406 5.16333 8.61073 5.08333C8.5774 4.99667 8.53073 4.93 8.47073 4.86333C8.40406 4.80333 8.33073 4.75667 8.25073 4.72333C8.17073 4.69 8.08406 4.67 7.9974 4.67C7.91073 4.67 7.82406 4.69 7.74406 4.72333C7.66406 4.75667 7.59073 4.80333 7.52406 4.86333C7.46406 4.93 7.4174 4.99667 7.38406 5.08333C7.35073 5.16333 7.33073 5.25 7.33073 5.33667C7.33073 5.42333 7.35073 5.51 7.38406 5.59Z" fill="#A1A5B7"/>
                            </svg>
                        </a>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input
                                class="form-check-input"
                                type="radio"
                                value="0"
                                name="has_variant"
                                id="withoutVarian" @checked(!$product->has_variant)
                                data-ajax-disabled="true"
                            />
                            <label class="form-check-label" for="withoutVarian">
                                Tidak
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input
                                class="form-check-input"
                                type="radio"
                                value="1"
                                name="has_variant"
                                id="withVarian" @checked($product->has_variant)
                                data-ajax-disabled="true"
                            />
                            <label class="form-check-label" for="withVarian">
                                Ya
                            </label>
                        </div>
                    </div>
                </div>
                <div id="parent-not-variant" style="display: {{ $product->has_variant ? 'none' : '' }}">
                    <div class="row form-group mb-8">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <label for="unit_id" class="h6 tbr_font--weight-bold mt-4">Satuan</label>
                            <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                        </div>
                        <div class="col-lg-8 d-flex gap-20">
                            <select name="unit_id" class="tbr_form form-control form-select form-select-solid" id="unit_id" data-control="select2">
                                <option value="" selected disabled>Pilih satuan</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end gap-4">
                    <button type="button" onclick="window.location.href = '{{ route('products.index') }}'" anim="ripple" class="btn tbr_btn tbr_btn--light">Batal</button>
                    <button anim="ripple" type="submit" class="btn tbr_btn tbr_btn--primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('blockfoot')
    <script>
        const selectedCategoriesId = @json($category_id);
    </script>
    <script src="{{ asset('assets/js/products/edit.js') }}"></script>
@endpush
