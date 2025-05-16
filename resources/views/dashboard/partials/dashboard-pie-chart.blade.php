<div class="row g-4">
    <div class="col-lg-8">
        <div class="card card-bordered">
            <div class="card-body">
                <div id="kt_amcharts_3"
                    data-total-projects="{{ $totalProjects }}"
                    data-hold-projects="{{ $holdProjects }}"
                    data-in-progress-projects="{{ $inProgressProjects }}"
                    data-done-projects="{{ $doneProjects }}"
                    data-late-projects="{{ $lateProjects }}"
                    style="height: 518px;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">ScrumApps</h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img class="img-fluid" src="{{ asset('assets/images/dashboard.png') }}" alt="" style="max-height: 330px; width: auto;">
                </div>
                <div style="text-align: justify;">
                    ScrumApps adalah aplikasi manajemen proyek yang dirancang khusus untuk tim yang menggunakan framework Scrum.
                    Dengan fitur seperti sprint planning, backlog management, task tracking, dan real-time collaboration,
                    ScrumApps membantu tim bekerja secara lebih terorganisir dan produktif.
                </div>
            </div>
        </div>
    </div>
</div>
