@extends('layouts.app')
@section('pageTitle', 'Detail')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Pelanggan', 'link' => route('partners.index')],
            ['title' => 'Mitra', 'link' => route('partners.index')],
            ['title' => 'Detail', 'link' => ''],
        ]
    ])
@endsection
@section('content')

    <div class="card">
        <form
            action="{{ route('partners.update', $partner->id) }}"
            method="POST"
            class="tbr_main_form"
            data-complete-callback="completeCallback"
            data-success-callback="successCallback"
        >
            @method('PATCH')
            <div class="card-header flex-column ">
                <h5>Detail Mitra</h5>
                <span class="text-gray-600">Isi formulir dibawah untuk memperbarui mitra.</span>
            </div>
            <div class="card-body">
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="name" class="h6 tbr_font--weight-bold mt-4">Nama</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" class="tbr_form form-control" name="name" id="name" value="{{ $partner->name ?? '' }}"/>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Kelompok</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="regular" name="group" id="regular" {{ $partner->group == 'regular' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="regular">
                                Reguler
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="star" name="group" id="star" {{ $partner->group == 'star' ? 'checked' : '' }}/>
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
                            <input type="text" class="tbr_form form-control autonumeric" min="0" name="credit_limit" id="credit_limit" value="{{ $partner->credit_limit ?? '' }}"/>
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
                                <option value="{{ $province->id }}" {{ $partner->province_id == $province->id ? 'selected' : '' }}>{{ $province->name ?? '-' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="regency_id" class="h6 tbr_font--weight-bold mt-4">Kota/Kab</label>
                    </div>
                    <div class="col-lg-8 position-relative">
                        <select name="regency_id" class="tbr_form form-control form-select form-select-solid" id="regency_id" data-control="select2" {{ $partner->regency_id ? '' : 'disabled' }}>
                            <option value="" selected disabled>Pilih Kota/Kab</option>
                            @foreach ($regencies as $regency)
                                <option value="{{ $regency->id }}" {{ $partner->regency_id == $regency->id ? 'selected' : '' }}>{{ $regency->name ?? '-' }}</option>
                            @endforeach
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

                        <select name="district_id" class="tbr_form form-control form-select form-select-solid" id="district_id" data-control="select2" {{ $partner->district_id ? '' : 'disabled' }}>
                            <option value="" selected disabled>Pilih Kecamatan</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}" {{ $partner->district_id == $district->id ? 'selected' : '' }}>{{ $district->name ?? '-' }}</option>
                            @endforeach
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
                        <textarea class="tbr_form form-control" name="address" id="address" rows="3">{{ $partner->address ?? '' }}</textarea>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="phone_number" class="h6 tbr_font--weight-bold mt-4">Kontak</label>
                    </div>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <span class="input-group-text">+62</span>
                            <input type="number" class="tbr_form form-control" min="0" name="phone_number" id="phone_number" value="{{ $partner->phone_number ?? '' }}"/>
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
                        <div class="d-flex gap-4 align-items-center">
                            <div class="input-group flex-root">
                                <span class="input-group-text">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4" d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z" fill="#A1A5B7"/>
                                        <path d="M12.0027 12.868C11.1627 12.868 10.3127 12.608 9.66271 12.078L6.53271 9.57802C6.21271 9.31802 6.15271 8.84802 6.41271 8.52802C6.67271 8.20802 7.14271 8.14802 7.46271 8.40802L10.5927 10.908C11.3527 11.518 12.6427 11.518 13.4027 10.908L16.5327 8.40802C16.8527 8.14802 17.3327 8.19802 17.5827 8.52802C17.8427 8.84802 17.7927 9.32802 17.4627 9.57802L14.3327 12.078C13.6927 12.608 12.8427 12.868 12.0027 12.868Z" fill="#A1A5B7"/>
                                    </svg>
                                </span>
                                <input type="email" class="tbr_form form-control" name="email" id="email" value="{{ $partner->email ?? '' }}"/>
                            </div>
                            @if (!$partner->password)
                                <button
                                    anim="ripple"
                                    class="btn tbr_btn tbr_btn--icon tbr_btn--light-primary md"
                                    type="button"
                                    onclick="resendEmail({el: this, url: '{{ route('password.partner.resend', $partner->id) }}'})"
                                    data-bs-toggle="tooltip"
                                    data-bs-title="Mengirim ulang tautan"
                                >
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 13C3.24 13 1 15.23 1 18C1 20.77 3.24 23 6 23C8.76 23 11 20.76 11 18C11 15.24 8.77 13 6 13ZM3.95999 15.96H6C6.38 15.96 6.67999 16.27 6.67999 16.64C6.67999 17.01 6.37 17.32 6 17.32H3.95999C3.57999 17.32 3.28 17.01 3.28 16.64C3.28 16.27 3.57999 15.96 3.95999 15.96ZM8.04001 20.04H3.95001C3.57001 20.04 3.26999 19.73 3.26999 19.36C3.26999 18.99 3.58001 18.68 3.95001 18.68H8.04001C8.42001 18.68 8.72 18.99 8.72 19.36C8.72 19.73 8.42001 20.04 8.04001 20.04Z" fill="#DB0916"/>
                                        <path opacity="0.4" d="M17 3H7C4 3 2 4.5 2 8V11.14C2 11.87 2.75001 12.33 3.42001 12.04C4.52001 11.56 5.76999 11.38 7.07999 11.59C9.69999 12.02 11.84 14.09 12.37 16.69C12.52 17.45 12.54 18.19 12.44 18.9C12.36 19.49 12.84 20.01 13.43 20.01H17C20 20.01 22 18.51 22 15.01V8.00999C22 4.49999 20 3 17 3Z" fill="#DB0916"/>
                                        <path d="M12.0027 11.868C11.1627 11.868 10.3127 11.608 9.66271 11.078L6.53271 8.57802C6.21271 8.31802 6.15271 7.84802 6.41271 7.52802C6.67271 7.20802 7.1427 7.14802 7.4627 7.40802L10.5927 9.90802C11.3527 10.518 12.6427 10.518 13.4027 9.90802L16.5327 7.40802C16.8527 7.14802 17.3327 7.19802 17.5827 7.52802C17.8427 7.84802 17.7927 8.32802 17.4627 8.57802L14.3327 11.078C13.6927 11.608 12.8427 11.868 12.0027 11.868Z" fill="#DB0916"/>
                                    </svg>
                                </button>
                            @endif

                        </div>
                        @if (!$partner->password)
                            <span class="tbr_text--icon mt-2">Tautan untuk membuat kata sandi baru sudah kedaluwarsa? Klik tombol di samping untuk mengirim ulang tautan pembuatan kata sandi.</span>
                        @endif
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Akses Produk Pengembangan</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="0" name="is_access_product_dev" id="not_permitted" {{ $partner->is_access_product_dev == 0 ? 'checked' : '' }}/>
                            <label class="form-check-label" for="not_permitted">
                                Tidak Diizinkan
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="1" name="is_access_product_dev" id="permitted" {{ $partner->is_access_product_dev == 1 ? 'checked' : '' }}/>
                            <label class="form-check-label" for="permitted">
                                Diizinkan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Status</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="1" name="blocked" id="not_active" {{ $partner->blocked == 1 ? 'checked' : '' }}/>
                            <label class="form-check-label" for="not_active">
                                Nonaktif
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="0" name="blocked" id="active" {{ $partner->blocked == 0 ? 'checked' : '' }}/>
                            <label class="form-check-label" for="active">
                                Aktif
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end gap-4">
                <button type="button" onclick="window.location.href = '{{ route('partners.index') }}'" anim="ripple" class="btn tbr_btn tbr_btn--light">Batal</button>
                <button anim="ripple" type="submit" class="btn tbr_btn tbr_btn--primary">Simpan</button>
            </div>
        </form>
    </div>

    @push('blockfoot')
        <script src="{{ asset('assets/js/autonumeric.js') }}"></script>
        <script src="{{ asset('assets/js/partners/edit.js') }}"></script>
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
