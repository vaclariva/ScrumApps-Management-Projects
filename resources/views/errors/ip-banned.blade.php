@extends('errors.layouts.app')
@section('pageTitle', 'ip-banned')

@section('pict')
    <div class="d-flex flex-column flex-root tbr_auth--ip-banned"></div>
@endsection

@section('mobile')
    <div class="tbr_auth--mobile-ip-banned"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-center">
        <h1 class="font1 fw-bolder mb-4">Ohno</h1>
    </div>
    <div class="d-flex flex-column flex-center w-75-responsive mx-auto">
        <h1 class="font2 fw-bolder mb-4 text-center">Your IP has been banned!</h1>
        <p class="font3 mb-10 text-center">Alamat IP Anda telah di banned dan <br> saat ini dilarang melihat situs ini.</p>
    </div>
@endsection
