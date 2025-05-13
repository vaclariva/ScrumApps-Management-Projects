<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: true, lg: true}"
    data-kt-sticky-name="app-header-minimize" data-kt-sticky-offset="{default: '200px', lg: '0'}"
    data-kt-sticky-animation="false">

    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">

        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>

        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="{{ route('dashboard') }}" class="d-lg-none">
                <img alt="Logo" src="{{ asset('assets/svg/illustrations/logo.svg') }}" class="h-30px" />
            </a>
        </div>

        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                    id="kt_app_header_menu" data-kt-menu="true">
                    <div class="d-flex align-items-center">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                            aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex">
                                    <h4 class="mb-0 me-4 fw-bold">@yield('pageTitle')</h4>
                                    <a anim="ripple" type="button" class="btn tbr_btn tbr_btn--icon tbr_btn--light-primary md"
                                        href="{{ route('dashboard') }}">
                                        <svg class="" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path class="tbr_dynamic"
                                                d="M7.73 1.98047H4.83C3.26703 1.98047 2 3.2475 2 4.81047V7.71047C2 9.27343 3.26703 10.5405 4.83 10.5405H7.73C9.29297 10.5405 10.56 9.27343 10.56 7.71047V4.81047C10.56 3.2475 9.29297 1.98047 7.73 1.98047Z"
                                                fill="#C50C0E"></path>
                                            <path class="tbr_dynamic" opacity="0.3"
                                                d="M19.1704 2.01172H16.2704C14.7075 2.01172 13.4404 3.27875 13.4404 4.84172V7.74172C13.4404 9.30468 14.7075 10.5717 16.2704 10.5717H19.1704C20.7334 10.5717 22.0004 9.30468 22.0004 7.74172V4.84172C22.0004 3.27875 20.7334 2.01172 19.1704 2.01172Z"
                                                fill="#C50C0E"></path>
                                            <path class="tbr_dynamic" opacity="0.3"
                                                d="M7.73 13.4297H4.83C3.26703 13.4297 2 14.6967 2 16.2597V19.1597C2 20.7227 3.26703 21.9897 4.83 21.9897H7.73C9.29297 21.9897 10.56 20.7227 10.56 19.1597V16.2597C10.56 14.6967 9.29297 13.4297 7.73 13.4297Z"
                                                fill="#C50C0E"></path>
                                            <path class="tbr_dynamic"
                                                d="M19.1704 13.4609H16.2704C14.7075 13.4609 13.4404 14.728 13.4404 16.2909V19.1909C13.4404 20.7539 14.7075 22.0209 16.2704 22.0209H19.1704C20.7334 22.0209 22.0004 20.7539 22.0004 19.1909V16.2909C22.0004 14.728 20.7334 13.4609 19.1704 13.4609Z"
                                                fill="#C50C0E"></path>
                                        </svg>
                                    </a>
                                </li>
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        @include('layouts.header.notif')
        </div>
    </div>
</div>
