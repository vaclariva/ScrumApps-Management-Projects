@extends('layouts.app')
@section('pageTitle', 'Proyek')
@section('breadcrumb')
    @include('include.default-breadcrumb', [
        'breadcrumbs' => [
            ['title' => 'Proyek', 'link' => ''],
            ['title' => 'Semua', 'link' => ''],
        ]
    ])
@endsection
@section('sidebar')
    @include('layouts.sidebar.sub-main')
@endsection

@section('content')
    @include('projects.partials.projects-detail')
    <br>

    <div class="card rounded-top-0">
        <div class="card-header d-flex text-center">
            <div class="flex-column">
                <h3 class="card-title fw-semibold">Kalender Proyek</h3>
                <span class="text-gray-600 text-sm">
                    Halaman ini digunakan untuk tanggal-tanggal yang berkaitan dengan pengembangan proyek.
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="calendar-legend d-flex gap-4 mb-4">
                <div class="flex items-center gap-2">
                    <i class="ki-solid ki-abstract-27 text-success fs-2"></i>
                    <span>Proyek Mulai</span>
                </div>
                <div class="flex text-items-center gap-2">
                    <i class="ki-solid ki-abstract-27 text-warning fs-2"></i>
                    <span>Proyek Berakhir</span>
                </div>
                <div class="flex text-items-center gap-2">
                    <i class="ki-solid ki-abstract-27 text-primary fs-2"></i>
                    <span>Sprint Mulai</span>
                </div>
                <div class="flex text-items-center gap-2">
                    <i class="ki-solid ki-abstract-27 text-danger fs-2"></i>
                    <span>Sprint Berakhir</span>
                </div>
            </div>
            <div id="agenda-calendar"></div>
        </div>
    </div>

    @push('blockfoot')
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
        <script src="{{ asset('assets/js/calendars/index.js') }}"></script>
        <script src="{{ asset('metronic/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let calendarEl = document.getElementById('agenda-calendar');

                let fullCalendarEl = new FullCalendar.Calendar(calendarEl, {
                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    themeSystem: 'standard',
                    dayMaxEvents: true,
                    locale: 'id',
                    initialView: 'dayGridMonth',
                    initialDate: '{{ date('Y-m-d') }}',
                    events: {{ Js::from($events) }},
                    eventDidMount: function (arg) {
                        let event = arg.event;
                        let tooltipHtml = `
                            <div class="text-left">
                                <div class="text-sm">${event.extendedProps.tooltip}</div>
                            </div>
                        `;
                        arg.el.setAttribute('data-bs-toggle', 'tooltip');
                        arg.el.setAttribute('data-bs-placement', 'top');
                        arg.el.setAttribute('data-bs-custom-class', 'tbr_tooltip--event');
                        arg.el.setAttribute('data-bs-html', 'true');
                        arg.el.setAttribute('title', tooltipHtml);
                        new bootstrap.Tooltip(arg.el, { trigger: 'hover' });
                    }
                });

                fullCalendarEl.render();
            });
        </script>
    @endpush
@endsection
