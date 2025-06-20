<div id="kt_app_sidebar"
    class="app-sidebar flex-column"
    data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}"
    data-kt-drawer-overlay="true"
    data-kt-drawer-width="225px"
    data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <a href="{{ route('dashboard') }}" class="mx-auto mw-100 d-flex align-items-center">
            <img class="mw-100 h-55px" src="{{ asset('assets/svg/illustrations/logo.svg')}}" alt="">
        </a>
        <div id="kt_app_sidebar_toggle"
            anim="ripple"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm h-30px w-30px position-absolute top-50 start-100 translate-middle rotate active"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize"
            style="background-color: var(--tbr-primary)"
            >
            <script>
                onLoad();
            </script>
            <i class="ki-duotone ki-black-left-line fs-3 rotate-180 text-white">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
            <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                data-kt-scroll-save-state="true">
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6" id="kt_app_sidebar_menu"
                    data-kt-menu="true" data-kt-menu-expand="false">

                    {{-- Dashboard --}}
                    <div class="menu-item coming-soon" id="sidebar-dashboard">
                        <a class="menu-link" href="{{ route('dashboard') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-category fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </div>

                    {{-- Proyek --}}
                    <div class="menu-item" id="sidebar-project">
                        <a class="menu-link" href="{{ route('projects.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-monitor-mobile fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Proyek</span>
                        </a>
                    </div>

                    {{-- Selling --}}
                    {{-- <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-delivery-3 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Penjualan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion position-relative">
                            <div class="tbr_tree--road"></div>
                            <div class="menu-item tbr_tree" id="sidebar-selling-order">
                                <a class="menu-link" href="{{ route('orders.index') }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Pesanan</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Inventory --}}
                    {{-- <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-cube-2 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Inventori</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion position-relative">
                            <div class="tbr_tree--road"></div>

                            <div class="menu-item tbr_tree" id="sidebar-inventory-stock">
                                <a class="menu-link" href="{{ route('inventories.index') }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Stok</span>
                                </a>
                            </div>
                            <div class="menu-item tbr_tree" id="sidebar-inventory-warehouse">
                                <a class="menu-link" href="{{ route('warehouses.index') }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Lokasi</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Credit --}}
                    {{-- <div data-kt-menu-trigger="click" class="menu-item here menu-accordion coming-soon">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-bill fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Piutang</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion position-relative">
                            <div class="tbr_tree--road"></div>
                            <div class="menu-item tbr_tree" id="sidebar-credit-all">
                                <a class="menu-link" href="{{ route('coming-soon') }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Coming Soon</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Report --}}
                    {{-- <div data-kt-menu-trigger="click" class="menu-item here menu-accordion coming-soon">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-directbox-default fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Laporan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion position-relative">
                            <div class="tbr_tree--road"></div>
                            <div class="menu-item tbr_tree" id="sidebar-report-all">
                                <a class="menu-link" href="{{ route('coming-soon') }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Coming Soon</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Product --}}
                    {{-- <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-parcel fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Produk</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion position-relative">
                            <div class="tbr_tree--road"></div>
                            <div class="menu-item tbr_tree" id="sidebar-product-all">
                                <a class="menu-link" href="{{ route('products.index') }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Semua</span>
                                </a>
                            </div>
                            <div class="menu-item tbr_tree" id="sidebar-product-category">
                                <a class="menu-link" href="{{ route('categories.index') }}">
                                <span class="menu-tree"></span>
                                    <span class="menu-title">Kategori</span>
                                </a>
                            </div>
                            <div class="menu-item tbr_tree" id="sidebar-product-unit">
                                <a class="menu-link" href="{{ route('units.index') }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Satuan</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Customer --}}
                    {{-- <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-people fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </span>
                            <span class="menu-title">Pelanggan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion position-relative">
                            <div class="tbr_tree--road"></div>
                            <div class="menu-item tbr_tree" id="sidebar-customer-partner">
                                <a class="menu-link" href="{{ route('partners.index') }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Mitra</span>
                                </a>
                            </div>
                            <div class="menu-item tbr_tree" id="sidebar-customer-end-user">
                                <a class="menu-link" href="{{ route('coming-soon') }}">
                                <span class="menu-tree"></span>
                                    <span class="menu-title">End User</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}

                    {{-- Users --}}
                    @if (auth()->user()->isSuperAdmin)
                        <div class="menu-item" id="sidebar-users">
                            <a class="menu-link" href="{{ route('users.index') }}">
                                <span class="menu-icon">
                                    <i class="ki-duotone ki-security-user fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">Pengguna</span>
                            </a>
                        </div>
                    @endif

                    {{-- Informasi Sistem --}}
                    <div class="menu-item" id="sidebar-information">
                        <a class="menu-link" href="{{ route('informationSistem.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-information-3 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            </span>
                            <span class="menu-title">Informasi Sistem</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="app-sidebar-footer flex-column-auto py-4 px-6" id="kt_app_sidebar_footer">
        <div class="text-center overflow-hidden text-nowrap">© Copyright 2024 ScrumApps. <br> All Rights Reserved. Version {{ config('app.version') }}</div>
    </div>
</div>

