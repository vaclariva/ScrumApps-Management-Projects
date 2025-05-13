@push('blockhead')
    <link rel="stylesheet" href="{{ asset('assets/css/filter.css') }}">
@endpush
<div id="@yield('filter-id')" class="tbr_filter--wrapper">
    <button class="btn tbr_btn tbr_btn--light position-relative w-100" data-bs-toggle='dropdown' data-bs-auto-close='outside'
        aria-expanded="false">
        <div class="tbr_filter--badge">
            <span>0</span>
        </div>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.4"
                d="M17.1641 3.41667V5.25C17.1641 5.91667 16.7474 6.75 16.3307 7.16667L12.7474 10.3333C12.2474 10.75 11.9141 11.5833 11.9141 12.25V15.8333C11.9141 16.3333 11.5807 17 11.1641 17.25L9.9974 18C8.91406 18.6667 7.41406 17.9167 7.41406 16.5833V12.1667C7.41406 11.5833 7.08073 10.8333 6.7474 10.4167L5.91406 9.54167L10.7641 1.75H15.4974C16.4141 1.75 17.1641 2.5 17.1641 3.41667Z"
                fill="#A1A5B7" />
            <path
                d="M9.41927 1.75L5.1026 8.675L3.58594 7.08333C3.16927 6.66667 2.83594 5.91667 2.83594 5.41667V3.5C2.83594 2.5 3.58594 1.75 4.5026 1.75H9.41927Z"
                fill="#A1A5B7" />
        </svg>
        <span>Filter</span>
    </button>

    <div class="dropdown-menu dropdown-menu-lg-end tbr_filter py-0" style="max-width: 700px">
        <div class="d-flex">
            <div class="tbr_filter--left">
                @yield("filter-content-left")
            </div>
            <div class="tbr_filter--right flex-fill">
                @yield("filter-content-right")
            </div>
        </div>
        <div class="tbr_filter--footer d-flex flex-column flex-lg-row justify-content-between gap-4">
            <button class="btn tbr_btn tbr_btn--light-primary sm d-flex flex-center tbr_filter--clear-all" onclick="clearFilter({el: this})">Hapus Filter</button>
            <div class="d-flex gap-4 justify-content-center">
                <button class="btn tbr_btn tbr_btn--light sm d-flex flex-center tbr_filter--cancel" onclick="cancelFilter({el: this})">Batal</button>
                <button
                    class="btn tbr_btn tbr_btn--primary sm d-flex flex-center tbr_filter--apply"
                    disabled
                    onclick="applyFilter({el: this})"
                    data-dt="@yield('dt')"
                >
                    Terapkan
                </button>
            </div>
        </div>
    </div>
</div>
@push('blockfoot')
    <script src="{{ asset('assets/js/default-filter.js') }}"></script>
    <script>
        $(function(){
            $('.tbr_filter--wrapper [data-bs-toggle="dropdown"]').off('shown.bs.dropdown').on('shown.bs.dropdown', function () {
                $(this).closest('.tbr_filter--wrapper').css('z-index', 'var(--tbr-backdrop-zindex-overlap)')
                $('.tbr_backdrop').fadeIn();
            });
            $('.tbr_filter--wrapper [data-bs-toggle="dropdown"]').off('hidden.bs.dropdown').on('hidden.bs.dropdown', function () {
                $(this).closest('.tbr_filter--wrapper').css('z-index', '1')
                $('.tbr_backdrop').fadeOut();
                var rdp = $('.tbr_daterangepicker').data('daterangepicker');
                if(rdp){
                    rdp.hide();
                }
            });
        })
    </script>
@endpush
