@extends('layouts.app')
@section('pageTitle', 'Email host')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Pengaturan', 'link' => route('settings.smtps.index')],
            ['title' => 'Email Host', 'link' => route('settings.smtps.index')],
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
            action="{{ route('settings.smtps.update')}}"
            method="POST"
            class="tbr_main_form">
            @method("PATCH")

            <div class="card-header flex-column">
                <h5>Email Host</h5>
                <span class="text-gray-600">Anda perlu melakukan konfigurasi email terlebih dahulu sebelum sistem ini digunakan.</span>
            </div>
            <div class="card-body">
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="from_name" class="h6 tbr_font--weight-bold mt-4">From Name</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" class="tbr_form form-control" name="from_name" id="from_name" value="{{ $setting->from_name ?? '' }}"/>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="mail_from_address" class="h6 tbr_font--weight-bold mt-4">Mail From Address</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" class="tbr_form form-control" name="mail_from_address" id="mail_from_address"  value="{{ $setting->mail_from_address ?? '' }}"/>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="smtp_host" class="h6 tbr_font--weight-bold mt-4">SMTP Host</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" class="tbr_form form-control" name="smtp_host" id="smtp_host"  value="{{ $setting->smtp_host ?? '' }}"/>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Type of Encryption</label>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="type_of_encryption" id="ssl" value="ssl"
                            {{ isset($setting) && $setting->type_of_encryption == 'ssl' ? 'checked' : '' }}/>
                            <label class="form-check-label" for="ssl">
                                SSL / Port : 465
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio"  name="type_of_encryption" id="tls" value="tls"
                            {{ isset($setting) && $setting->type_of_encryption == 'tls' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tls">
                                TLS / Port : 587
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="smtp_username" class="h6 tbr_font--weight-bold mt-4">SMTP Username</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" class="tbr_form form-control" name="smtp_username" id="smtp_username"  value="{{ $setting->smtp_username ?? '' }}"/>
                    </div>
                </div>
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label for="smtp_password" class="h6 tbr_font--weight-bold mt-4">SMTP Password</label>
                    </div>
                    <div class="col-lg-8">
                        <input type="text" class="tbr_form form-control" name="smtp_password" id="smtp_password"  value="{{ $setting->smtp_password ?? '' }}"/>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end gap-4">
                <a href="/dashboard" class="btn tbr_btn tbr_btn--light">Batal</a>
                <button type="submit" class="btn tbr_btn tbr_btn--primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
