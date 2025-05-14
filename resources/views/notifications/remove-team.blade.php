@extends('notifications.layouts.main')
@section('content')
    <div class="tbr_brand">
        <img src="{{ $message->embed(public_path('assets/images/email-logo.png')) }}" alt="{{ config('app.name') }}" width="217">
    </div>
    <div class="tbr_email--body">
        <h1 class="tbr_email--heading">
            <span class="fw-400">Halo,</span> <strong>{{ $member }}</strong>
        </h1>

        <p>
        Anda telah dikeluarkan sebagai anggota tim pengembangan dari peran
        <strong>{{ $role }}</strong> pada proyek <strong>{{ $projectName }}</strong>.
        </p>

        <p>
            Terima kasih telah bergabung dan kolaborasi bersama tim kami.
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
