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
        <link rel="manifest" href="/manifest.json">
        <meta name="theme-color" content="#0d6efd">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet" />
        <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>

        {{-- Vendors CSS --}}
        <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('metronic/assets/css/style.bundle.css') }}">

        {{-- Assets CSS --}}
        <link rel="stylesheet" href="{{ asset('assets/css/root.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/projecttoastr.css') }}">
        <link rel="stylesheet" href="https://unpkg.com/jkanban@1.3.1/dist/jkanban.min.css" />
        @stack('blockhead')
    </head>

    <body
        id="kt_app_body"
        data-kt-app-layout="dark-sidebar"
        data-kt-app-header-fixed="true"
        data-kt-app-sidebar-enabled="true"
        data-kt-app-sidebar-fixed="true"
        data-kt-app-sidebar-hoverable="true"
        data-kt-app-sidebar-push-header="true"
        data-kt-app-sidebar-push-toolbar="true"
        data-kt-app-sidebar-push-footer="true"
        class="app-default"
        data-kt-app-toolbar-enabled=@hasSection('toolbar') true @endif
    >
        <script>
            /*
            * Sidebar toggle.
            */
            function onLoad() {
                const sidebar = document.getElementById("kt_app_body");
                const toggle = document.getElementById("kt_app_sidebar_toggle");

                if (window.localStorage.getItem("minimize") && window.localStorage.getItem("minimize") == "true") {
                    sidebar.setAttribute("data-kt-app-sidebar-minimize", "on");
                    toggle.classList.add("active");
                } else {
                    sidebar.setAttribute("data-kt-app-sidebar-minimize", "off");
                    toggle.classList.remove("active");
                }
            }

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
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                @include('layouts.header.main')
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    @yield('sidebar')
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<div class="d-flex flex-column flex-column-fluid">
                            @yield('toolbar')
							<div id="kt_app_content" class="tbr_main--content app-content flex-column-fluid">
                                <div class="app-container container-fluid h-100">
                                    @yield('content')
                                    @include('layouts.loading-page')
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="tbr_backdrop" style="display: none"></div>

        {{-- Vendors JS  --}}
        <script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}"></script>
        <script src="{{ asset('metronic/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
        <script src="assets/js/scripts.bundle.js"></script>

        <script src="https://unpkg.com/jkanban@1.3.1/dist/jkanban.min.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>


        {{-- Assets JS --}}
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/debounce.js') }}"></script>
        <script src="{{ asset('assets/js/default-setup-ajax.js') }}"></script>
        <script src="{{ asset('assets/js/default-toast.js') }}"></script>
        <script src="{{ asset('assets/js/default-ajax.js') }}"></script>
        <script src="{{ asset('assets/js/sidebar.js') }}"></script>
        <script src="{{ asset('assets/js/loading-page.js') }}"></script>
        <script src="{{ asset('assets/js/loading-page.js') }}"></script>

        <script>
            let toggle = document.getElementById("kt_app_sidebar_toggle");
            toggle.addEventListener('click', function() {
                let sidebar = document.getElementById("kt_app_body");
                let minimumSidebarState = sidebar.getAttribute("data-kt-app-sidebar-minimize") == "on" ? true : false;
                localStorage.setItem("minimize", !minimumSidebarState);
            });
            onLoad();
        </script>
        <script>
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function () {
                    navigator.serviceWorker.register('/serviceworker.js').then(function (registration) {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    }, function (err) {
                        console.log('ServiceWorker registration failed: ', err);
                    });
                });
            }
        </script>
        @stack('blockfoot')
	</body>
</html>
