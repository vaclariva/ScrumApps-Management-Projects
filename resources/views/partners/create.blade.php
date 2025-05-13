@extends('layouts.app')
@section('pageTitle', 'Tambah')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Pelanggan', 'link' => route('partners.index')],
            ['title' => 'Mitra', 'link' => route('partners.index')],
            ['title' => 'Tambah', 'link' => ''],
        ]
    ])
@endsection
@section('content')
    <div class="card">
        <form
            action="{{ route('partners.store') }}"
            method="POST"
            class="tbr_main_form"
            data-complete-callback="completeCallback"
            data-success-callback="successCallback"
        >
            <div class="card-header flex-column ">
                <h5>Formulir Tambah Mitra</h5>
                <span class="text-gray-600">Isi formulir dibawah untuk menambahkan mitra.</span>
            </div>
            <div class="card-body">
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="name" class="h6 tbr_font--weight-bold mt-4">Nama</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" class="tbr_form form-control" name="name" id="name"/>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Kelompok</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="regular" name="group" id="regular"  />
                            <label class="form-check-label" for="regular">
                                Reguler
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="star" name="group" id="star"  />
                            <label class="form-check-label" for="star">
                                Star
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="credit_limit" class="h6 tbr_font--weight-bold mt-4">Plafon</label>
                    </div>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" class="tbr_form form-control autonumeric" min="0" name="credit_limit" id="credit_limit"/>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="province_id" class="h6 tbr_font--weight-bold mt-4">Provinsi</label>
                    </div>
                    <div class="col-lg-8">
                        <select name="province_id" class="tbr_form form-control form-select form-select-solid" id="province_id" data-control="select2">
                            <option value="" selected disabled>Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="regency_id" class="h6 tbr_font--weight-bold mt-4">Kota/Kab</label>
                    </div>
                    <div class="col-lg-8 position-relative">
                        <select name="regency_id" class="tbr_form form-control form-select form-select-solid" id="regency_id" data-control="select2" disabled>
                            <option value="" selected disabled>Pilih Kota/Kab</option>
                        </select>
                        <div class="position-absolute top-50 end-0 translate-middle-y pe-14 d-none" id="regency-loader">
                            <span class="spinner spinner-border spinner-border-sm tbr_text--primary" role="status" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="district_id" class="h6 tbr_font--weight-bold mt-4">Kecamatan</label>
                    </div>
                    <div class="col-lg-8 position-relative">
                        <select name="district_id" class="tbr_form form-control form-select form-select-solid" id="district_id" data-control="select2" data-placeholder="Pilih Kecamatan" disabled>
                            <option value="" selected disabled>Pilih Kecamatan</option>
                        </select>
                        <div class="position-absolute top-50 end-0 translate-middle-y pe-14 d-none" id="district-loader">
                            <span class="spinner spinner-border spinner-border-sm tbr_text--primary" role="status" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="address" class="h6 tbr_font--weight-bold mt-4">Alamat</label>
                    </div>
                    <div class="col-lg-8">
                        <textarea class="tbr_form form-control" name="address" id="address" rows="3"></textarea>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="phone_number" class="h6 tbr_font--weight-bold mt-4">Kontak</label>
                    </div>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <span class="input-group-text">+62</span>
                            <input type="number" class="tbr_form form-control" min="0" name="phone_number" id="phone_number"/>
                        </div>
                    </div>
                </div>

                <hr class="tbr_separator my-10"/>
                <div class="mb-8">
                    <h5>Pengaturan Akun</h5>
                    <span class="text-gray-600">Isi formulir dibawah untuk mengatur akun mitra.</span>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="email" class="h6 tbr_font--weight-bold mt-4">Alamat Email</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <span class="input-group-text">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" fill="#A1A5B7"/>
                                        <path d="M12.0027 12.868C11.1627 12.868 10.3127 12.608 9.66271 12.078L6.53271 9.57802C6.21271 9.31802 6.15271 8.84802 6.41271 8.52802C6.67271 8.20802 7.14271 8.14802 7.46271 8.40802L10.5927 10.908C11.3527 11.518 12.6427 11.518 13.4027 10.908L16.5327 8.40802C16.8527 8.14802 17.3327 8.19802 17.5827 8.52802C17.8427 8.84802 17.7927 9.32802 17.4627 9.57802L14.3327 12.078C13.6927 12.608 12.8427 12.868 12.0027 12.868Z" fill="#A1A5B7"/>
                                    </svg>
                            </span>
                            <input type="email" class="tbr_form form-control" name="email" id="email"/>
                        </div>
                        <span class="tbr_text--icon mt-2">Sistem akan mengirim link untuk buat kata sandi sekaligus memverifikasi alamat email ini.</span>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Akses Produk Pengembangan</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="0" name="is_access_product_dev" id="not_permitted"  />
                            <label class="form-check-label" for="not_permitted">
                                Tidak Diizinkan
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="1" name="is_access_product_dev" id="permitted"  />
                            <label class="form-check-label" for="permitted">
                                Diizinkan
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end gap-4">
                <button type="button" onclick="window.location.href = '{{ route('partners.index') }}'" anim="ripple" class="btn tbr_btn tbr_btn--light">Batal</button>
                <button anim="ripple" type="button" onclick="submitAjaxReload({el: this})" class="btn tbr_btn tbr_btn--light">Simpan & Tambah Baru</button>
                <button anim="ripple" type="button" onclick="submitAjax({el: this})" class="btn tbr_btn tbr_btn--primary">Simpan</button>
            </div>
        </form>
    </div>

    @push('blockfoot')
        <script src="{{ asset('assets/js/autonumeric.js') }}"></script>
        <script src="{{ asset('assets/js/partners/create.js') }}"></script>
        <script>
            AutoNumeric.multiple('.autonumeric', {
                decimalPlaces: 0,
                decimalCharacter: ',',
                digitGroupSeparator: '.',
                minimumValue: 0
            })
        </script>
    @endpush
@endsection
