@extends('errors.layouts.app')
@section('pageTitle', '404')

@section('pict')
    <div class="d-flex flex-column flex-root tbr_auth--404"></div>
@endsection

@section('mobile')
    <div class="tbr_auth--mobile-404"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-center">
        <h1 class="font1 fw-bolder mb-4">404</h1>
    </div>
    <div class="d-flex flex-column flex-center w-75-responsive mx-auto">
        <h1 class="font2 fw-bolder mb-4">Not Found</h1>
        <p class="font3 mb-10 text-center">Maaf, halaman yang anda cari tidak ditemukan. <br> Pastikan Anda telah mengetik URL dengan benar.</p>

        <button anim="ripple" class="btn tbr_btn tbr_btn--primary w-100" type="button" onclick="window.location.href='/login'">Kembali</button>
    </div>
@endsection
