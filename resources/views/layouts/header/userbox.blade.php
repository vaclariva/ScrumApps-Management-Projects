<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
    <div class="cursor-pointer symbol symbol-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <img src="{{ auth()->user()->photo_path ?? 'asset("assets/images/avatar.png")' }}" class="rounded-1 object-fit-cover"
            alt="user" />
    </div>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <div class="symbol symbol-50px me-5">
                    <img alt="Logo"
                        class="object-fit-cover"
                        src="{{ auth()->user()->photo_path ?? 'asset("assets/images/avatar.png")' }}" />
                </div>
                <div class="d-flex flex-column">
                    @if (Str::length(auth()->user()->name) < 20)
                        <div class="fw-bold fs-5">{{ auth()->user()->name ?? '-' }}</div>
                    @else
                        <div
                            class="fw-bold fs-5"
                            data-bs-toggle="tooltip"
                            data-bs-title="{{ auth()->user()->name ?? '-' }}"
                            data-bs-trigger="hover"
                            data-bs-placement="bottom"
                            data-bs-custom-class="tbr_tooltip--mw-fit"
                        >
                            {{ Str::substr(auth()->user()->name, 0, 18) }}...
                        </div>
                    @endif
                    @if (Str::length(auth()->user()->role) < 22)
                        <span class="fw-semibold text-muted fs-7 pe-4">{{ auth()->user()->role ?? '-' }}</span>
                    @else
                        <span
                            class="fw-semibold text-muted fs-7 pe-4"
                            data-bs-toggle="tooltip"
                            data-bs-title="{{ auth()->user()->role ?? '-' }}"
                            data-bs-trigger="hover"
                            data-bs-placement="bottom"
                            data-bs-custom-class="tbr_tooltip--mw-fit"
                        >
                            {{ Str::substr(auth()->user()->role, 0, 22) }}...
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="separator my-2"></div>

        <div class="menu-item px-3 my-0">
            <a href="{{ route('profile.edit') }}" class="menu-link fw-medium px-3 py-2">
                <span class="menu-icon" data-kt-element="icon">
                    <i class="ki-duotone ki-profile-circle fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </span>
                <span class="menu-title">Profil Saya</span>
            </a>
        </div>

        <div class="menu-item px-3 my-0" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
        <a href="#" class="menu-link fw-medium px-3 py-2">
            <span class="menu-icon" data-kt-element="icon">
                <i class="ki-duotone ki-setting-2 fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <span class="menu-title">Pengaturan</span>
            <span class="menu-arrow"></span>
        </a>

        <div class="menu-sub menu-sub-dropdown py-4">
            <div class="menu-item px-3">
                <a href="{{ route('settings.database-backup.index') }}" class="menu-link fw-medium px-3 py-2">
                    <span class="menu-icon">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M14.4903 6.75031H3.51782C2.82385 6.75031 2.25781 6.18042 2.25781 5.49031V3.51781C2.25781 2.82385 2.82771 2.25781 3.51782 2.25781H14.4903C15.1843 2.25781 15.7503 2.8277 15.7503 3.51781V5.49031C15.7503 6.1786 15.1786 6.75031 14.4903 6.75031Z" fill="#A1A5B7" stroke="#A1A5B7" stroke-width="1.5"/>
                            <path opacity="0.4" d="M14.4903 15.7503H3.51782C2.82385 15.7503 2.25781 15.1804 2.25781 14.4903V12.5178C2.25781 11.8238 2.82771 11.2578 3.51782 11.2578H14.4903C15.1843 11.2578 15.7503 11.8277 15.7503 12.5178V14.4903C15.7503 15.1786 15.1786 15.7503 14.4903 15.7503Z" fill="#A1A5B7" stroke="#A1A5B7" stroke-width="1.5"/>
                            <path d="M4.5 5.8125C4.1925 5.8125 3.9375 5.5575 3.9375 5.25V3.75C3.9375 3.4425 4.1925 3.1875 4.5 3.1875C4.8075 3.1875 5.0625 3.4425 5.0625 3.75V5.25C5.0625 5.5575 4.8075 5.8125 4.5 5.8125Z" fill="#A1A5B7"/>
                            <path d="M7.5 5.8125C7.1925 5.8125 6.9375 5.5575 6.9375 5.25V3.75C6.9375 3.4425 7.1925 3.1875 7.5 3.1875C7.8075 3.1875 8.0625 3.4425 8.0625 3.75V5.25C8.0625 5.5575 7.8075 5.8125 7.5 5.8125Z" fill="#A1A5B7"/>
                            <path d="M4.5 14.8125C4.1925 14.8125 3.9375 14.5575 3.9375 14.25V12.75C3.9375 12.4425 4.1925 12.1875 4.5 12.1875C4.8075 12.1875 5.0625 12.4425 5.0625 12.75V14.25C5.0625 14.5575 4.8075 14.8125 4.5 14.8125Z" fill="#A1A5B7"/>
                            <path d="M7.5 14.8125C7.1925 14.8125 6.9375 14.5575 6.9375 14.25V12.75C6.9375 12.4425 7.1925 12.1875 7.5 12.1875C7.8075 12.1875 8.0625 12.4425 8.0625 12.75V14.25C8.0625 14.5575 7.8075 14.8125 7.5 14.8125Z" fill="#A1A5B7"/>
                            <path d="M13.5 5.0625H10.5C10.1925 5.0625 9.9375 4.8075 9.9375 4.5C9.9375 4.1925 10.1925 3.9375 10.5 3.9375H13.5C13.8075 3.9375 14.0625 4.1925 14.0625 4.5C14.0625 4.8075 13.8075 5.0625 13.5 5.0625Z" fill="#A1A5B7"/>
                            <path d="M13.5 14.0625H10.5C10.1925 14.0625 9.9375 13.8075 9.9375 13.5C9.9375 13.1925 10.1925 12.9375 10.5 12.9375H13.5C13.8075 12.9375 14.0625 13.1925 14.0625 13.5C14.0625 13.8075 13.8075 14.0625 13.5 14.0625Z" fill="#A1A5B7"/>
                        </svg>
                    </span>
                    <span class="menu-title">Database Backup</span>
                </a>
            </div>
            <div class="menu-item px-3">
                    <a href="{{ route('settings.smtps.index') }}" class="menu-link fw-medium px-3 py-2">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-sms fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Email Host</span>
                </a>
            </div>
        </div>
        </div>

        <div class="menu-item px-3 my-0" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
            <a href="#" class="menu-link fw-medium px-3 py-2">
                <span class="menu-icon" data-kt-element="icon">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4"
                            d="M3.99801 12.4527L3.99802 12.4527L3.99459 12.4501C3.87314 12.3604 3.7196 12.1767 3.59496 11.9266C3.4706 11.6772 3.41406 11.4401 3.41406 11.2835V5.20845C3.41406 4.9667 3.51037 4.66819 3.70209 4.39066C3.89339 4.11372 4.13778 3.91834 4.36188 3.83246L8.48232 2.28917C8.58754 2.25074 8.77507 2.21802 8.99813 2.21876C9.22355 2.21951 9.40472 2.25416 9.49982 2.29152L9.49979 2.29161L9.511 2.29581L13.636 3.84081L13.6379 3.84152C13.8576 3.92313 14.1013 4.11611 14.2935 4.39441C14.4857 4.67259 14.5816 4.9711 14.5816 5.20845V11.2835C14.5816 11.4395 14.5254 11.6744 14.4011 11.923C14.2772 12.1708 14.1227 12.358 13.9961 12.4538C13.9957 12.4541 13.9954 12.4543 13.9951 12.4546L9.87261 15.5352L9.87058 15.5367C9.65933 15.6957 9.34573 15.7966 8.99781 15.7966C8.6499 15.7966 8.3363 15.6957 8.12505 15.5367L8.12301 15.5352L3.99801 12.4527Z"
                            fill="#A1A5B7" stroke="#A1A5B7" stroke-width="1.5" />
                        <path
                            d="M9.33597 8.93753L9 9.04397L8.66403 8.93753C8.201 8.79083 7.875 8.37036 7.875 7.875C7.875 7.25421 8.37921 6.75 9 6.75C9.62079 6.75 10.125 7.25421 10.125 7.875C10.125 8.37036 9.799 8.79083 9.33597 8.93753Z"
                            fill="#A1A5B7" stroke="#A1A5B7" stroke-width="1.5" />
                    </svg>
                </span>
                <span class="menu-title">Keamanan</span>
                <span class="menu-arrow"></span>
            </a>

            <div class="menu-sub menu-sub-dropdown py-4">
                @if (auth()->user()->isSuperAdmin)
                    <div class="menu-item px-3">
                        <a href="{{ route('authlog.index') }}" class="menu-link fw-medium px-3 py-2">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-monitor-mobile fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Authentication Log</span>
                        </a>
                    </div>
                @endif

                <div class="menu-item px-3">
                    <a href="{{ route('settings.twofactors.index') }}"  class="menu-link fw-medium px-3 py-2">
                        <span class="menu-icon">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M3.99801 12.4527L3.99802 12.4527L3.99459 12.4501C3.87314 12.3604 3.7196 12.1767 3.59496 11.9266C3.4706 11.6772 3.41406 11.4401 3.41406 11.2835V5.20845C3.41406 4.9667 3.51037 4.66819 3.70209 4.39066C3.89339 4.11372 4.13778 3.91834 4.36188 3.83246L8.48232 2.28917C8.58754 2.25074 8.77507 2.21802 8.99813 2.21876C9.22355 2.21951 9.40472 2.25416 9.49982 2.29152L9.49979 2.29161L9.511 2.29581L13.636 3.84081L13.6379 3.84152C13.8576 3.92313 14.1013 4.11611 14.2935 4.39441C14.4857 4.67259 14.5816 4.9711 14.5816 5.20845V11.2835C14.5816 11.4395 14.5254 11.6744 14.4011 11.923C14.2772 12.1708 14.1227 12.358 13.9961 12.4538C13.9957 12.4541 13.9954 12.4543 13.9951 12.4546L9.87261 15.5352L9.87058 15.5367C9.65933 15.6957 9.34573 15.7966 8.99781 15.7966C8.6499 15.7966 8.3363 15.6957 8.12505 15.5367L8.12301 15.5352L3.99801 12.4527Z"
                                    fill="#A1A5B7" stroke="#A1A5B7" stroke-width="1.5" />
                                <path
                                    d="M9.33597 8.93753L9 9.04397L8.66403 8.93753C8.201 8.79083 7.875 8.37036 7.875 7.875C7.875 7.25421 8.37921 6.75 9 6.75C9.62079 6.75 10.125 7.25421 10.125 7.875C10.125 8.37036 9.799 8.79083 9.33597 8.93753Z"
                                    fill="#A1A5B7" stroke="#A1A5B7" stroke-width="1.5" />
                            </svg>
                        </span>
                        <span class="menu-title">Two Factor Authentication</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="separator my-2"></div>

        <form action="{{ route('logout') }}" method="post" class="tbr_main_form mx-5 my-3">
            @csrf
            <button anim="ripple" class="btn tbr_btn tbr_btn--primary w-100 p-0 fs-6" style="min-height: 32px;"
                type="submit">Keluar</button>
        </form>
    </div>
</div>
