<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'App') }} - @yield('pageTitle')</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="google-site-verification" content="" />
        <meta name="msvalidate.01" content="" />
        <meta name="robots" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" sizes="32x32" href="{{ asset('assets/svg/favicon/large.svg') }}" type="image/x-icon">
        <link rel="shortcut icon" sizes="16x16" href="{{ asset('assets/svg/favicon/small.svg') }}" type="image/x-icon">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        {{-- Vendors CSS --}}
        <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('metronic/assets/css/style.bundle.css') }}">

        {{-- Assets CSS --}}
        <link rel="stylesheet" href="{{ asset('assets/css/root.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">

        @stack('blockhead')
    </head>
<body id="kt_app_body">
    {{-- Dark Mode JS --}}
    <script>

        /*
        * Dark-light mode.
        */
        var defaultThemeMode = "light";
        var themeMode;

        if ( document.documentElement ) {
            if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if ( localStorage.getItem("data-bs-theme") !== null ) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            } if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            } document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="tbr_auth--wrapper">
        {{-- <div class="tbr_auth--mobile"></div> --}}
        <div class="d-flex flex-lg-row flex-lg-column-fluid gap-5 z-index-2">
            <div class="tbr_auth--left d-none d-lg-flex">
                <img class="w-100 object-fit-cover mb-10" src="{{asset('assets/svg/illustrations/auth-left-top.svg')}}" alt="">
                <div class="d-flex flex-column flex-root tbr_auth--bg"></div>
                <div class="d-flex flex-column flex-center text-white mt-10">
                    <h1 class="text-white fs-2qx fw-bolder mb-4">ScrumApps</h1>
                    <p class="text-center">© Copyright 2024 ScrumApps.<br>
                    All Rights Reserved. Version {{ config('app.version') }}</p>
                </div>
                <img class="w-100 object-fit-cover mt-10" src="{{asset('assets/svg/illustrations/auth-left-bottom.svg')}}" alt="">
            </div>
            <div class="tbr_auth--right">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Vendors JS  --}}
    <script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.5.0/build/global/luxon.min.js"></script>

    {{-- Assets JS --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/default-toggle-password.js') }}"></script>
    <script src="{{ asset('assets/js/default-setup-ajax.js') }}"></script>
    <script src="{{ asset('assets/js/default-toast.js') }}"></script>
    <script src="{{ asset('assets/js/default-ajax.js') }}"></script>

    @stack('blockfoot')
</body>
</html>
