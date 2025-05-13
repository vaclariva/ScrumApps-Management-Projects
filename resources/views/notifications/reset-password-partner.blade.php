@extends('notifications.layouts.main')
@section('content')
    <div class="tbr_brand">
        <img src="{{ $message->embed(public_path('assets/images/email-logo.png')) }}" alt="{{ config('app.name') }}" width="217">
    </div>
    <div class="tbr_email--body">
        <h1 class="tbr_email--heading">
            <span class="fw-400">Halo,</span> <strong>{{ $partner->name }}</strong>
        </h1>

        <p>
            Terima kasih telah menghubungi kami, silakan klik tombol di bawah ini untuk mereset kata sandi Anda.
        </p>


        <center>
            <a type="button" class="tbr_btn mb-6" href="{{ $url }}">Reset Kata Sandi</a>
        </center>

        <p>
            Kode reset kata sandi ini akan kedaluwarsa dalam 60 menit.
        </p>
        <p>
            Jika Anda tidak ingin atau membatalkan pembuatan kata sandi baru, maka tidak ada tindakan lebih lanjut yang diperlukan.
        </p>

        <div>
            <b>Hormat kami,</b><br />
            <span class="tbr_text--link">{{ config('app.name') }}</span>
        </div>
    </div>
    <div class="tbr_email--footer">
        © Copyright 2025 ScrumApps.
        <br/>All Rights Reserved. Version {{ config('app.version') }}
    </div>
@endsection
