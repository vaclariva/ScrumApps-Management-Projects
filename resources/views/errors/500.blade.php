@extends('errors.layouts.app')
@section('pageTitle', '500')

@section('pict')
    <div class="d-flex flex-column flex-root tbr_auth--500"></div>
@endsection

@section('mobile')
    <div class="tbr_auth--mobile-500"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-center">
        <h1 class="font1 fw-bolder mb-4">500</h1>
    </div>
    <div class="d-flex flex-column flex-center w-75-responsive mx-auto">
        <h1 class="font2 fw-bolder mb-4">Internal Server Error</h1>
        <p class="font3 mb-10 text-center">Coba segarkan halaman ini atau hubungi kami jika <br> masalah berlanjut.</p>

        <button anim="ripple" class="btn tbr_btn tbr_btn--primary w-100" type="button" onclick="window.location.href='/login'">Kembali</button>
    </div>
@endsection
