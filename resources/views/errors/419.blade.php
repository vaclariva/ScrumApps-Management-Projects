@extends('errors.layouts.app')
@section('pageTitle', '419')

@section('pict')
    <div class="d-flex flex-column flex-root tbr_auth--419"></div>
@endsection

@section('mobile')
    <div class="tbr_auth--mobile-419"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-center">
        <h1 class="font1 fw-bolder mb-4">419</h1>
    </div>
    <div class="d-flex flex-column flex-center w-75-responsive mx-auto">
        <h1 class="font2 fw-bolder mb-4">Page Expired</h1>
        <p class="font3 mb-10 text-center">Maaf, sesi Anda telah berakhir. <br> Segarkan halaman dan coba lagi.</p>

        <button anim="ripple" class="btn tbr_btn tbr_btn--primary w-100" type="button" onclick="window.location.href='/login'">Kembali</button>
    </div>
@endsection
