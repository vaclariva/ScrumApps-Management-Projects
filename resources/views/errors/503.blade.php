@extends('errors.layouts.app')
@section('pageTitle', '503')

@section('pict')
    <div class="d-flex flex-column flex-root tbr_auth--503"></div>
@endsection

@section('mobile')
    <div class="tbr_auth--mobile-503"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-center">
        <h1 class="font1 fw-bolder mb-4">503</h1>
    </div>
    <div class="d-flex flex-column flex-center w-75-responsive mx-auto">
        <h1 class="font2 fw-bolder mb-4">Service Unavailable</h1>
        <p class="font3 mb-10 text-center">Server untuk sementara tidak dapat melayani <br> permintaan Anda karena pemeliharaan atau <br> masalah kapasitas. Silahkan coba lagi nanti.</p>

        <button anim="ripple" class="btn tbr_btn tbr_btn--primary w-100" type="button" onclick="window.location.href='/login'">Kembali</button>
    </div>
@endsection
