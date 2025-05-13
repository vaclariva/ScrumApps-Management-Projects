@extends('layouts.app')
@section('pageTitle', 'Daftar Stok')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [['title' => 'Inventori', 'link' => ''], ['title' => 'Stok', 'link' => '']],
    ])
@endsection
@push('blockhead')
    <link rel="stylesheet" href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
    <style>
        .tbr_stock--menu {
            z-index: 90 !important;
        }
    </style>
@endpush
@section('content')
    @include('inventories.partials.nav-tab', ['activeIndex' => 0])
    <div class="card rounded-top-0">
        <div class="card-body">
            <div class="d-flex flex-column flex-lg-row gap-4 justify-content-between align-lg-items-center mb-8">
                <div class="d-flex gap-2">
                    <div>
                        <button class="btn tbr_btn tbr_btn--primary" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-start">
                            Stock In/Out
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded fw-semibold w-auto tbr_stock--menu"
                            data-kt-menu="true">
                            <div class="menu-item">
                                <a  href="{{ route('inventories.create', 'stock-in') }}"
                                    class="menu-link tbr_not--hover tbr_hover--opacity px-5 tbr_text--success fw-bold rounded-0">
                                    <span class="me-3">Stock In</span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M13.9126 5.20721V5.20927V10.7959C13.9126 11.8601 13.5983 12.6196 13.1056 13.1123C12.6129 13.605 11.8535 13.9193 10.7893 13.9193H5.20927C4.14511 13.9193 3.38586 13.605 2.89327 13.1118C2.40057 12.6185 2.08594 11.8573 2.08594 10.7893V5.20927C2.08594 4.14509 2.40025 3.38562 2.89293 2.89293C3.38562 2.40025 4.14509 2.08594 5.20927 2.08594H10.7959C11.8603 2.08594 12.6194 2.40031 13.1111 2.8926C13.6026 3.38474 13.9155 4.14351 13.9126 5.20721Z"
                                            fill="#17C653" stroke="#17C653" stroke-width="1.5" />
                                        <mask id="path-2-inside-1_2021_18980" fill="white">
                                            <path
                                                d="M12 7.5H8.5V4C8.5 3.72667 8.27333 3.5 8 3.5C7.72667 3.5 7.5 3.72667 7.5 4V7.5H4C3.72667 7.5 3.5 7.72667 3.5 8C3.5 8.27333 3.72667 8.5 4 8.5H7.5V12C7.5 12.2733 7.72667 12.5 8 12.5C8.27333 12.5 8.5 12.2733 8.5 12V8.5H12C12.2733 8.5 12.5 8.27333 12.5 8C12.5 7.72667 12.2733 7.5 12 7.5Z" />
                                        </mask>
                                        <path
                                            d="M12 7.5H8.5V4C8.5 3.72667 8.27333 3.5 8 3.5C7.72667 3.5 7.5 3.72667 7.5 4V7.5H4C3.72667 7.5 3.5 7.72667 3.5 8C3.5 8.27333 3.72667 8.5 4 8.5H7.5V12C7.5 12.2733 7.72667 12.5 8 12.5C8.27333 12.5 8.5 12.2733 8.5 12V8.5H12C12.2733 8.5 12.5 8.27333 12.5 8C12.5 7.72667 12.2733 7.5 12 7.5Z"
                                            fill="#17C653" />
                                        <path
                                            d="M8.5 7.5H7V9H8.5V7.5ZM7.5 7.5V9H9V7.5H7.5ZM7.5 8.5H9V7H7.5V8.5ZM8.5 8.5V7H7V8.5H8.5ZM12 6H8.5V9H12V6ZM10 7.5V4H7V7.5H10ZM10 4C10 2.89824 9.10176 2 8 2V5C7.44491 5 7 4.55509 7 4H10ZM8 2C6.89824 2 6 2.89824 6 4H9C9 4.55509 8.55509 5 8 5V2ZM6 4V7.5H9V4H6ZM7.5 6H4V9H7.5V6ZM4 6C2.89824 6 2 6.89824 2 8H5C5 8.55509 4.55509 9 4 9V6ZM2 8C2 9.10176 2.89824 10 4 10V7C4.55509 7 5 7.44491 5 8H2ZM4 10H7.5V7H4V10ZM6 8.5V12H9V8.5H6ZM6 12C6 13.1018 6.89824 14 8 14V11C8.55509 11 9 11.4449 9 12H6ZM8 14C9.10176 14 10 13.1018 10 12H7C7 11.4449 7.44491 11 8 11V14ZM10 12V8.5H7V12H10ZM8.5 10H12V7H8.5V10ZM12 10C13.1018 10 14 9.10176 14 8H11C11 7.44491 11.4449 7 12 7V10ZM14 8C14 6.89824 13.1018 6 12 6V9C11.4449 9 11 8.55509 11 8H14Z"
                                            fill="#17C653" mask="url(#path-2-inside-1_2021_18980)" />
                                    </svg>
                                </a>
                            </div>
                            <div class="separator opacity-75"></div>
                            <div class="menu-item">
                                <a
                                    href="{{ route('inventories.create', 'stock-out') }}"
                                    class="menu-link tbr_not--hover tbr_hover--opacity px-5 tbr_text--primary fw-bold rounded-0">
                                    <span class="me-3">Stock Out</span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M2.0874 10.7928L2.0874 10.7907L2.0874 5.20406C2.0874 4.13988 2.40171 3.38041 2.89439 2.88772C3.38708 2.39504 4.14655 2.08073 5.21073 2.08073L10.7907 2.08073C11.8549 2.08073 12.6141 2.39502 13.1067 2.88823C13.5994 3.38154 13.9141 4.14268 13.9141 5.21073L13.9141 10.7907C13.9141 11.8549 13.5998 12.6144 13.1071 13.1071C12.6144 13.5998 11.8549 13.9141 10.7907 13.9141L5.20406 13.9141C4.13975 13.9141 3.38057 13.5997 2.88889 13.1074C2.39737 12.6153 2.08447 11.8565 2.0874 10.7928Z"
                                            fill="#F8285A" stroke="#F8285A" stroke-width="1.5" />
                                        <mask id="path-2-inside-1_2021_18992" fill="white">
                                            <path
                                                d="M4 7.5L12 7.5C12.2733 7.5 12.5 7.72667 12.5 8C12.5 8.27333 12.2733 8.5 12 8.5L4 8.5C3.72667 8.5 3.5 8.27333 3.5 8C3.5 7.72667 3.72667 7.5 4 7.5Z" />
                                        </mask>
                                        <path
                                            d="M4 7.5L12 7.5C12.2733 7.5 12.5 7.72667 12.5 8C12.5 8.27333 12.2733 8.5 12 8.5L4 8.5C3.72667 8.5 3.5 8.27333 3.5 8C3.5 7.72667 3.72667 7.5 4 7.5Z"
                                            fill="#F8285A" />
                                        <path
                                            d="M4 9L12 9L12 6L4 6L4 9ZM12 9C11.4449 9 11 8.55509 11 8L14 8C14 6.89824 13.1018 6 12 6L12 9ZM11 8C11 7.44491 11.4449 7 12 7L12 10C13.1018 10 14 9.10176 14 8L11 8ZM12 7L4 7L4 10L12 10L12 7ZM4 7C4.55509 7 5 7.44491 5 8L2 8C2 9.10176 2.89824 10 4 10L4 7ZM5 8C5 8.55509 4.55509 9 4 9L4 6C2.89824 6 2 6.89824 2 8L5 8Z"
                                            fill="#F8285A" mask="url(#path-2-inside-1_2021_18992)" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('inventories-history.index') }}" class="btn tbr_btn tbr_btn--icon tbr_btn--light-primary">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.0181 1.92969C10.8037 1.94047 8.65535 2.68554 6.90976 4.04817C5.16417 5.41081 3.91992 7.31402 3.37195 9.45962L2.70165 8.44592C2.63819 8.33979 2.5539 8.24761 2.45385 8.17495C2.3538 8.10228 2.24007 8.05063 2.11952 8.02311C1.99897 7.99559 1.87409 7.99277 1.75242 8.01482C1.63075 8.03687 1.51481 8.08333 1.41158 8.15141C1.30836 8.21948 1.21998 8.30776 1.1518 8.41091C1.08362 8.51407 1.03703 8.62996 1.01485 8.75161C0.992672 8.87326 0.99536 8.99814 1.02275 9.11872C1.05015 9.2393 1.10168 9.35308 1.17424 9.45321L3.18881 12.5062C3.32875 12.702 3.53507 12.8403 3.76937 12.8954C4.00862 12.9428 4.25695 12.8952 4.46166 12.7626L7.48352 10.727C7.58771 10.6619 7.67774 10.5765 7.74826 10.476C7.81878 10.3754 7.86834 10.2616 7.894 10.1415C7.91965 10.0214 7.92088 9.89733 7.8976 9.77672C7.87432 9.65611 7.82701 9.54141 7.75849 9.43946C7.68997 9.33751 7.60164 9.25039 7.49876 9.18328C7.39587 9.11617 7.28053 9.07045 7.15961 9.04883C7.03869 9.02722 6.91466 9.03015 6.7949 9.05746C6.67513 9.08477 6.56209 9.13589 6.46249 9.20779L5.088 10.1345C5.45382 8.64956 6.22965 7.29735 7.327 6.23215C8.42436 5.16694 9.79903 4.43163 11.2942 4.11011C12.7893 3.78859 14.3447 3.89381 15.783 4.41377C17.2212 4.93373 18.4843 5.84748 19.4282 7.05077C20.3721 8.25407 20.9587 9.69845 21.1212 11.2191C21.2837 12.7398 21.0155 14.2755 20.3472 15.6511C19.6788 17.0266 18.6373 18.1867 17.3414 18.9988C16.0455 19.8109 14.5474 20.2423 13.0181 20.244C11.7071 20.2405 10.4164 19.9204 9.25556 19.3111C8.09477 18.7018 7.09827 17.8212 6.35078 16.7441C6.28383 16.6413 6.19691 16.553 6.09518 16.4845C5.99345 16.4159 5.87898 16.3685 5.75857 16.345C5.63815 16.3216 5.51426 16.3225 5.39423 16.3479C5.2742 16.3732 5.16049 16.4225 5.05984 16.4926C4.9592 16.5627 4.87368 16.6524 4.80835 16.7562C4.74302 16.8601 4.69923 16.976 4.67956 17.0971C4.6599 17.2181 4.66476 17.342 4.69387 17.4611C4.72297 17.5803 4.77573 17.6924 4.849 17.7908C6.06422 19.5427 7.80936 20.8586 9.82794 21.5451C11.8465 22.2316 14.0321 22.2525 16.0634 21.6047C18.0947 20.9569 19.8647 19.6746 21.1132 17.9462C22.3617 16.2178 23.0228 14.1346 22.9994 12.0026C23.0084 9.34415 21.9626 6.79071 20.0914 4.90236C18.2203 3.01401 15.6765 1.94495 13.0181 1.92969Z"
                                fill="#DB0916" />
                            <path opacity="0.4"
                                d="M12.9235 6.46094C12.6807 6.46094 12.4477 6.55741 12.276 6.72914C12.1043 6.90087 12.0078 7.13379 12.0078 7.37665V12.001C12.0117 12.2431 12.1076 12.4746 12.2761 12.6484L15.0233 15.4203C15.1957 15.59 15.4275 15.6856 15.6694 15.6868C15.9112 15.688 16.144 15.5947 16.3181 15.4267C16.4905 15.2557 16.5879 15.0232 16.5889 14.7804C16.59 14.5376 16.4945 14.3043 16.3236 14.1319L13.8392 11.6247V7.37665C13.8392 7.13379 13.7428 6.90087 13.571 6.72914C13.3993 6.55741 13.1664 6.46094 12.9235 6.46094Z"
                                fill="#DB0916" />
                        </svg>
                    </a>
                </div>
                <div class="d-flex flex-column flex-lg-row gap-4">
                    @include('include.default-datatable-search', [
                        'fullInResponsive' => true,
                        'tableId' => 'table-inventory',
                    ])
                    @include('inventories.partials.filter', [
                        'filterId' => 'filter-inventory-id',
                        'dt' => 'dtInventory',
                    ])
                </div>
            </div>
            @include('inventories.partials.result-filter', ['filterId' => 'filter-inventory-id'])
            <div class="table-responsive">
                @include('include.default-datatable', [
                    'tableId' => 'table-inventory',
                    'columns' => ['No', 'Produk', 'Jumlah', 'Satuan', 'Lokasi', 'Status', 'Diperbarui'],
                ])
            </div>
        </div>
    </div>
@endsection
@push('blockfoot')
    <script>
        var dtInventory;
        const urlDatatable = '{{ route('inventories.list') }}';

        var dataDatatable = function(d) {
            d.category = getCheckboxChecked({
                name: 'category'
            });
            d.warehouse = getCheckboxChecked({
                name: 'warehouse'
            });
            d.status = getCheckboxChecked({
                name: 'status'
            });
        }

        function getCheckboxChecked({
            name
        }) {
            let allInputValues = $(`input[name="${name}[]"]:checked`);
            let values = [];
            allInputValues.each(function() {
                values.push($(this).val());
            });
            return values;
        }
    </script>
    <script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/default-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/inventories/index.js') }}"></script>
@endpush
