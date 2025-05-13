@extends('layouts.app')
@section('pageTitle', 'Two factor Authentication')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Keamanan', 'link' => route('settings.twofactors.index')],
            ['title' => 'Two factor authentication', 'link' => route('settings.twofactors.index')],
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
            action="{{ route('settings.twofactors.update')}}"
            method="POST"
            class="tbr_main_form">
            @method("PATCH")

            <div class="card-header flex-column">
                <h5>Two factor authentication</h5>
                <span class="text-gray-600">Untuk keamanan, selalu aktifkan two factor authentication. Nonaktifkan jika tidak diperlukan.</span>
            </div>
            <div class="card-body">
                <div class="row form-group mb-8">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <label class="h6 tbr_font--weight-bold mt-4">Two factor authentication</label>
                    </div>
                    <div class="col-lg-8 d-flex gap-20">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="enabled_2fa" id="enabled" value="1"
                            {{ $enabled_2fa == '1' ? 'checked' : '' }} />
                            <label class="form-check-label" for="enabled">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" type="radio" name="enabled_2fa" id="disabled" value="0"
                            {{ $enabled_2fa == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="disabled">
                                Nonaktif
                            </label>
                        </div>
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
