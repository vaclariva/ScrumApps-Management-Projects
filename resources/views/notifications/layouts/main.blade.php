<!DOCTYPE html>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('metronic/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/css/root.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
        <style>
            .tbr_body {
                font-family: 'Inter', sans-serif;
                padding-top: 24px;
                padding-bottom: 24px;
                font-size: 14px;
                line-height: 26px;
                color: #2E3137;
                text-align: justify;
            }

            .tbr_brand {
                text-align: center;
                margin-bottom: 30px;
            }

            .tbr_email--body {
                max-width: 540px;
                background-color: #FFFFFF;
                border-radius: 40px;
                margin-left: auto;
                margin-right: auto;
                padding: 20px;
                box-shadow: 0px 1px 4px 0px #0000001F;
            }

            .tbr_center {
                text-align: center;
                margin-bottom: 20px;
            }

            .tbr_block--info {
                display: inline;
                color: #DB0916;
                font-weight: 700;
                background-color: rgb(219, 9, 22, 0.1);
                padding: 14px 35px;
                font-size: 1rem;
                border-radius: 8px;
            }

            .tbr_text--link {
                color: #DB0916;
                font-weight: 700;
            }

            .tbr_btn {
                color: #FFFFFF !important;
                font-weight: bold;
                text-align: center;
                text-decoration: none;
                position: relative;
                width: fit-content;
                display: block;
                border-radius: 0.475rem;
                transition: all .3s ease;
                padding: 12px;
                margin: 24px 0;
                background: #DB0916;
            }

            .tbr_btn:hover, .tbr_btn:focus, .tbr_btn:active {
                box-shadow: 0px 14px 25px -10px rgba(197, 13, 13, 0.6) -5px rgba(197, 13, 13, 0.20) !important;
            }

            .fw-400 {
                font-weight: 400 !important;
            }

            .tbr_email--footer {
                text-align: center;
                margin-top: 36px;
                margin-bottom: 20px;
                font-size: 13px;
                font-weight: 500;
                color: #2E3137;
            }
        </style>
    </head>

    <body class="tbr_body">
        <div class="d-flex flex-column flex-root">
            <div class="d-flex flex-column flex-column-fluid">
                @yield('content')
            </div>
        </div>
    </body>
</html>
