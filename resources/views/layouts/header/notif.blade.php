<style>
    .notif-badge {
        top: -1px;
        right: -1px;
        background-color: #f8285a;
        padding: 2px 6px;
        border-radius: 50%;
        font-size: 8px;
        min-width: 15px;
        min-height: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loader {
        margin-right: 5px;
        display: none;
    }
</style>

<div class="app-navbar flex-shrink-0">
    <div class="app-navbar-item ms-1 ms-md-4">
        <div
            data-kt-menu-trigger="{default: 'click'}"
            data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end"
            class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-danger w-35px h-35px menu-dropdown position-relative"
            id="notification-trigger"
            >
            <i class="ki-duotone ki-notification-bing fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            @if($unreadCount > 0)
                <span class="notif-badge position-absolute">
                    <span class="text-white">{{ $unreadCount }}</span>
                </span>
            @endif
        </div>
        <div
            class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px"
            data-kt-menu="true"
            style="z-index: 105; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate(-183px, 74px);"
            data-popper-placement="bottom-end"
        >
            <div class="tab-content">
                <div class="tab-pane fade active show" id="kt_topbar_notifications_1" role="tabpanel">
                    <div class="scroll-y mh-325px my-5 px-8">
                        @foreach($filteredProjects as $project)
                            @php
                                $statusClass = $project->status === 'done' ? 'success' : 'danger';
                                $statusText = $project->status === 'done'
                                    ? "{$project->name} selesai dikembangkan"
                                    : "{$project->name} melewati waktu pengembangan";
                                $icon = $project->icon ?? 'ki-technology-2';
                                $formattedDate = \Carbon\Carbon::parse($project->end_date)->translatedFormat('d F Y, H:i');
                                $status = strtoupper($project->status);
                            @endphp

                            <div class="d-flex flex-stack py-4">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-35px me-4">
                                        <span class="symbol-label bg-light-{{ $statusClass }}">
                                            <i class="ki-duotone {{ $icon }} fs-2 text-{{ $statusClass }}">
                                                <span class="path1"></span><span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="mb-0 me-2">
                                        <a href="#" class="fs-6 text-gray-800 text-hover-{{ $statusClass }} fw-bolder">
                                            {{ $statusText }}
                                        </a>
                                        <div class="text-gray-500 fs-7">{{ $formattedDate }}</div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('notif.read', $project->id) }}" class="ms-auto">
                                    @csrf
                                    @if($project->read == false)
                                        <button anim="ripple" onclick="readNotif({el: this})" class="btn btn-sm btn-light-danger btn-xs">
                                            Dibaca
                                            <span class="loader d-none spinner-border spinner-border-sm"></span>
                                        </button>
                                    @endif
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.header.appearance')
</div>

@push('blockfoot')
        <script src="{{ asset('assets/js/notif/index.js') }}"></script>
@endpush
