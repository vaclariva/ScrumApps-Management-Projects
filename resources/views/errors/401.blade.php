@extends('errors.layouts.app')
@section('pageTitle', '401')

@section('pict')
    <div class="d-flex flex-column flex-root tbr_auth--401"></div>
@endsection

@section('mobile')
    <div class="tbr_auth--mobile-401"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-center">
        <h1 class="font1 fw-bolder mb-4">401</h1>
    </div>
    <div class="d-flex flex-column flex-center w-75-responsive mx-auto">
        <h1 class="font2 fw-bolder mb-4" style="font-size: 3rem;">Unauthorized</h1>
        <p class="font3 mb-10 text-center">Halaman ini tidak tersedia untuk umum. <br> Untuk mengaksesnya, silahkan login terlebih dahulu.</p>

        <button anim="ripple" class="btn tbr_btn tbr_btn--primary w-100" type="button" onclick="window.location.href='/login'">Kembali</button>
    </div>
@endsection
