@extends('notifications.layouts.main')
@section('content')
    <div class="tbr_brand">
        <img src="{{ $message->embed(public_path('assets/images/email-logo.png')) }}" alt="{{ config('app.name') }}" width="217">
    </div>
    <div class="tbr_email--body">
        <h1 class="tbr_email--heading">
            <span class="fw-400">Halo,</span> <strong>{{ $project->user->name }}</strong>
        </h1>

        <p>
        Anda sudah tidak berkolaborasi sebagai <strong>Product Owner</strong>
        pada proyek <strong>{{ $project->name }}</strong>, karena proyek tersebut sudah tidak aktif lagi.
        </p>

        <p>
            Terima kasih telah bergabung dan berkolaborasi bersama kami.
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
