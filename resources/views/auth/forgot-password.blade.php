@extends('auth.layouts.app')
@section('pageTitle', 'Lupa Kata Sandi')
@section('content')
    <form
        action="{{ route('password.email') }}"
        method="POST"
        class="tbr_main_form d-flex flex-column flex-center mx-auto w-75-responsive"
        data-success-callback="successCallback"
        data-error-callback="errorCallback"
        data-no-toast-success="true"
        data-no-toast-error="true"
    >
        @csrf
        <h1 class="fw-bolder mb-4">Lupa Kata Sandi</h1>
        <p class="mb-10">Masukkan alamat email untuk atur ulang kata sandi.</p>

        <div class="tbr_alert tbr_alert--success text-center mb-10 d-none" id="alert-success">
            Kami sudah mengirimkan email yang berisi tautan untuk mereset kata sandi Anda.
        </div>

        <div class="tbr_alert tbr_alert--danger text-center mb-10 d-none" id="alert-error"></div>

        <div class="form-group w-100 mb-5">
            <input type="text" name="email" id="email" class="tbr_form form-control" placeholder="Alamat Email">
        </div>

        <div class="d-flex justify-content-center gap-4 w-75 mb-15">
            <a href="{{ route('login') }}" anim="ripple" class="btn tbr_btn tbr_btn--light d-flex flex-center flex-root">Batal</a>
            <button anim="ripple" class="btn tbr_btn tbr_btn--primary flex-root" type="submit">Kirim</button>
        </div>

        <div class="text-center">
            <span class="fw-semibold">Anda sudah ingat? <a href="{{ route('login') }}">Masuk</a></span>
        </div>
    </form>

    @push('blockfoot')
    <script src="{{ asset('assets/js/auth/forgot-password.js') }}"></script>
    @endpush
@endsection
