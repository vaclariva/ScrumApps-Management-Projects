@extends('notifications.layouts.main')
@section('content')
    <div class="tbr_brand">
        <img src="{{ $message->embed(public_path('assets/images/email-logo.png')) }}" alt="{{ config('app.name') }}" width="217">
    </div>
    <div class="tbr_email--body">
        <h1 class="tbr_email--heading">
            <span class="fw-400">Halo,</span> <strong>{{ $user->name }}</strong>
        </h1>

        <p>
            Demi keamanan pada akun Anda, kami menyediakan fasilitas two factor authentication. Untuk melanjutkan masuk ke aplikasi, silahkan salin dan inputkan kode di bawah ini.
        </p>

        <div class="tbr_center">
            <div class="tbr_block--info">{{ $code }}</div>
        </div>

        <p>Tautan two factor authentication ini akan kedaluwarsa dalam {{ config('auth.passwords.users.expire') }} menit.</p>
        <p>Jika Anda tidak ingin atau membatalkan masuk ke aplikasi, maka tidak ada tindakan lebih lanjut yang diperlukan.</p>

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
