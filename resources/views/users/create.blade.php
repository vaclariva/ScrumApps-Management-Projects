@extends('layouts.app')
@section('pageTitle', 'Tambah')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Pengguna', 'link' => route('users.index')],
            ['title' => 'Semua', 'link' => route('users.index')],
            ['title' => 'Tambah', 'link' => ''],
        ]
    ])
@endsection
@section('sidebar')
    @include('layouts.sidebar.main')
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
@endpush
@section('content')

    <div class="card">
        <form
            action="{{ route('users.store') }}"
            method="POST"
            class="tbr_main_form"
            data-complete-callback="completeCallback"
            data-success-callback="successCallback"
        >
            <div class="card-header flex-column ">
                <h5>Formulir Tambah Pengguna</h5>
                <span class="text-gray-600">Isi formulir dibawah untuk menambahkan pengguna.</span>
            </div>
            <div class="card-body">
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Foto</label>
                    </div>
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div
                                id="empty-photo"
                                class="tbr_avatar tbr_avatar--input tbr_avatar--default">
                            </div>
                            <img
                                class="tbr_avatar tbr_avatar--input d-none"
                                id="photo-preview"
                                src="" alt=""
                            />
                            <label
                                class="btn tbr_btn tbr_btn--icon sm tbr_btn--light-success rounded-circle"
                                data-kt-image-input-action="change"
                                data-bs-toggle="tooltip"
                                data-bs-dismiss="click"
                                title="Unggah foto"
                            >
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M20.5 10.19H17.61C15.24 10.19 13.31 8.26 13.31 5.89V3C13.31 2.45 12.86 2 12.31 2H8.07C4.99 2 2.5 4 2.5 7.57V16.43C2.5 20 4.99 22 8.07 22H15.93C19.01 22 21.5 20 21.5 16.43V11.19C21.5 10.64 21.05 10.19 20.5 10.19Z" fill="#17C653"/>
                                    <path d="M15.7997 2.21048C15.3897 1.80048 14.6797 2.08048 14.6797 2.65048V6.14048C14.6797 7.60048 15.9197 8.81048 17.4297 8.81048C18.3797 8.82048 19.6997 8.82048 20.8297 8.82048C21.3997 8.82048 21.6997 8.15048 21.2997 7.75048C19.8597 6.30048 17.2797 3.69048 15.7997 2.21048Z" fill="#17C653"/>
                                    <path d="M11.5275 12.47L9.5275 10.47C9.5175 10.46 9.5075 10.46 9.5075 10.45C9.4475 10.39 9.3675 10.34 9.2875 10.3C9.2775 10.3 9.2775 10.3 9.2675 10.3C9.1875 10.27 9.1075 10.26 9.0275 10.25C8.9975 10.25 8.9775 10.25 8.9475 10.25C8.8875 10.25 8.8175 10.27 8.7575 10.29C8.7275 10.3 8.7075 10.31 8.6875 10.32C8.6075 10.36 8.5275 10.4 8.4675 10.47L6.4675 12.47C6.1775 12.76 6.1775 13.24 6.4675 13.53C6.7575 13.82 7.2375 13.82 7.5275 13.53L8.2475 12.81V17C8.2475 17.41 8.5875 17.75 8.9975 17.75C9.4075 17.75 9.7475 17.41 9.7475 17V12.81L10.4675 13.53C10.6175 13.68 10.8075 13.75 10.9975 13.75C11.1875 13.75 11.3775 13.68 11.5275 13.53C11.8175 13.24 11.8175 12.76 11.5275 12.47Z" fill="#17C653"/>
                                </svg>
                                <input type="file" onchange="setPreviewPhoto({el: this})" hidden name="photo_path" accept=".png, .jpg, .jpeg">
                            </label>
                            <span
                                class="btn tbr_btn tbr_btn--icon sm tbr_btn--light-primary rounded-circle"
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
                        <input type="text" class="tbr_form form-control" name="name" id="name"/>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Jenis Kelamin</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="male" name="gender" id="male"  />
                            <label class="form-check-label" for="male">
                                Laki-Laki
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" value="female" name="gender" id="female"  />
                            <label class="form-check-label" for="female">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="phone_number" class="h6 tbr_font--weight-bold mt-4">No Telepon</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-text">+62</span>
                            <input type="number" class="tbr_form form-control" min="0" name="phone_number" id="phone_number"/>
                    </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="email" class="h6 tbr_font--weight-bold mt-4">Email</label>
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
                        <label for="role" class="h6 tbr_font--weight-bold mt-4">Role</label>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm ms-1">wajib</span>
                    </div>
                    <div class="col-lg-8">
                        <div class="d-flex gap-20 mb-1">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" name="role" id="role_product_owner" value="ProductOwner" />
                                <label class="form-check-label" for="role_product_owner">
                                    Business Analyst
                                </label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" name="role" id="role_team_developer" value="TeamDeveloper" />
                                <label class="form-check-label" for="role_team_developer">
                                    Team Developer
                                </label>
                            </div>
                        </div>
                        <span class="tbr_text--icon">
                            Business Analyst sebagai pemilik dari proyek.<br/>
                            Team Developer sebagai tim pengembang proyek.
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end gap-4">
                <button type="button" onclick="window.location.href = '{{ route('users.index') }}'" anim="ripple" class="btn tbr_btn tbr_btn--light">Batal</button>
                <button anim="ripple" type="button" onclick="submitAjaxReload({el: this})" class="btn tbr_btn tbr_btn--primary">Simpan</button>
            </div>
        </form>
    </div>

    @push('blockfoot')
        <script src="{{ asset('assets/js/users/create.js') }}"></script>
    @endpush
@endsection
