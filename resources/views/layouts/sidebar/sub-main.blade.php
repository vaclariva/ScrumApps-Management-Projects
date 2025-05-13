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

                    {{-- Proyek --}}
                    <div class="menu-item" id="sidebar-project">
                        <a class="menu-link" href="{{ route('projects.index') }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-double-left-arrow">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Proyek</span>
                        </a>
                    </div>

                    {{-- Detail --}}
                    <div data-kt-menu-trigger="click" class="menu-item here menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-8">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Detail</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion position-relative">
                            <div class="tbr_tree--road"></div>
                            <div class="menu-item tbr_tree" id="sidebar-vision-boards">
                                <a class="menu-link" href="{{ route('vision-boards.index', ['project_id' => $project->id]) }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Vision Board</span>
                                </a>
                            </div>
                            <div class="menu-item tbr_tree" id="sidebar-backlogs">
                                <a class="menu-link" href="{{ route('backlogs.index',  ['project_id' => $project->id]) }}">
                                <span class="menu-tree"></span>
                                    <span class="menu-title">Backlog</span>
                                </a>
                            </div>
                            <div class="menu-item tbr_tree" id="sidebar-sprints">
                                <a class="menu-link" href="{{ route('sprints.index',  ['project_id' => $project->id]) }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Sprint</span>
                                </a>
                            </div>
                            <div class="menu-item tbr_tree" id="sidebar-developments">
                                <a class="menu-link" href="{{ route('developments.index',  ['project_id' => $project->id]) }}">
                                    <span class="menu-tree"></span>
                                    <span class="menu-title">Pengembangan</span>
                                </a>
                            </div>
                        </div>
                    </div>


                    {{-- Kalender --}}
                    <div class="menu-item" id="sidebar-calendars">
                        <a class="menu-link" href="{{ route('calendars.index', ['project_id' => $project->id]) }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-calendar fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Kalender</span>
                        </a>
                    </div>


                    {{-- Anggota --}}
                    <div class="menu-item" id="sidebar-teams">
                        <a class="menu-link" href="{{ route('teams.index', ['project_id' => $project->id]) }}">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-security-user fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Member</span>
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

