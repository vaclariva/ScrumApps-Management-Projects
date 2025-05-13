@extends('auth.layouts.app')
@section('pageTitle', 'Verifikasi Kode')
@section('content')
    <div class="mb-15 d-flex flex-column flex-center">
        <img src="{{ asset('assets/svg/illustrations/logo.svg') }}" width="160" alt="" srcset="">
    </div>
    <form
        action="{{ route('twofactor.validate') }}"
        method="POST"
        class="tbr_main_form d-flex flex-column flex-center mx-auto w-75-responsive"
        data-success-callback="successCallback"
        data-no-toast-error="true"
        data-error-callback="errorCallback"
    >
        @csrf
        <h1 class="fw-bolder mb-4">Verifikasi</h1>
        <p class="mb-10">Masukkan kode Two Factor Authentication.</p>

        <div class="tbr_alert tbr_alert--success text-center mb-10 d-none" id="alert-success">
            Kami sudah mengirimkan email yang berisi kode untuk proses login Anda.
        </div>

        <div class="tbr_alert tbr_alert--danger text-center mb-10 d-none" id="alert-error"></div>

        <div class="form-group w-100 mb-5">
            <input type="number" min=0 name="two_factor_code" id="two-factor-code" class="tbr_form form-control" placeholder="Kode two factor authentication">
        </div>

        <button anim="ripple" class="btn tbr_btn tbr_btn--primary flex-root w-100 mb-15" type="submit">Kirim</button>

        <div class="d-flex flex-center gap-2">
            <span class="fw-semibold">Tidak menerima kode verifikasi? <a type="button" class="tbr_text--primary fw-bold" onclick="resendCode({el: this, url: '{{ route('twofactor.resend') }}', token: '{{ csrf_token() }}' })">Kirim Ulang</a></span>
            <span class="spinner spinner-border tbr_text--primary d-none" id="loader"></span>
        </div>
    </form>

    @push('blockfoot')
        <script src="{{ asset('assets/js/auth/two-factor.js') }}"></script>
    @endpush
@endsection
