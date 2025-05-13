@extends('errors.layouts.app')
@section('pageTitle', '403')

@section('pict')
    <div class="d-flex flex-column flex-root tbr_auth--403"></div>
@endsection

@section('mobile')
    <div class="tbr_auth--mobile-403"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-center">
        <h1 class="font1 fw-bolder mb-4">403</h1>
    </div>
    <div class="d-flex flex-column flex-center w-75-responsive mx-auto">
        <h1 class="font2 fw-bolder mb-4">Forbidden</h1>
        <p class="font3 mb-10 text-center">Akses ke sumber daya ini di server ditolak!</p>

        <button anim="ripple" class="btn tbr_btn tbr_btn--primary w-100" type="button" onclick="window.location.href='/login'">Kembali</button>
    </div>
@endsection
