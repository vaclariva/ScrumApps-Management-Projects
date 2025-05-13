@extends('errors.layouts.app')
@section('pageTitle', 'database-not-found')

@section('pict')
    <div class="d-flex flex-column flex-root tbr_auth--database-not-found"></div>
@endsection

@section('mobile')
<div class="tbr_auth--mobile-database-not-found"></div>
@endsection

@section('content')
    <div class="d-flex flex-column flex-center">
        <h1 class="font1 fw-bolder mb-4">Oops</h1>
    </div>
    <div class="d-flex flex-column flex-center w-75-responsive mx-auto">
        <h1 class="font2 fw-bolder mb-4 text-center">Error Establishing a <br> Database Connection</h1>
    </div>
@endsection
