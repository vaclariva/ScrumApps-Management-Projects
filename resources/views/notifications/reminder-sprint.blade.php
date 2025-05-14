@extends('notifications.layouts.main')

@section('content')
    <div class="tbr_brand">
        <img src="{{ $message->embed(public_path('assets/images/email-logo.png')) }}" alt="{{ config('app.name') }}" width="217">
    </div>

    <div class="tbr_email--body">
        <h1 class="tbr_email--heading">
            <span class="fw-400">Halo,</span> <strong></strong>
        </h1>

        <p>
            Anda adalah Product Owner dari proyek <strong>{{ $sprint->project->name }}</strong> dan saat ini sedang menjalankan sprint <strong>{{ $sprint->name }}</strong>.
        </p>

        @if ($daysLeft < 0)
            <p>
                Sprint ini akan berakhir dalam <strong>{{ $daysLeft }} hari</strong> pada tanggal <strong>{{ $sprint->end_date->format('d M Y') }}</strong>.
                Silakan pastikan semua task pada sprint ini terselesaikan sebelum batas waktu tersebut.
            </p>
        @else
            <p>
                Sprint ini telah melewati batas waktu yang ditentukan pada tanggal <strong>{{ $sprint->end_date->format('d M Y') }}</strong>.
                Segera lakukan evaluasi untuk memastikan keberhasilan proyek ini.
            </p>
        @endif

        <p>
            Terima kasih telah menggunakan ScrumApps. Tetap semangat dan tetap produktif!
        </p>

        <div>
            <b>Hormat kami,</b><br />
            <span class="tbr_text--link">{{ config('app.name') }}</span>
        </div>
    </div>

    <div class="tbr_email--footer">
        © Copyright 2025 ScrumApps.<br />
        All Rights Reserved. Version {{ config('app.version') }}
    </div>
@endsection
