<div class="tooltip-calendar">
    @if($type == 'mulai-proyek')
        <div class="tooltip-header text-success">
            Proyek: {{ $name }}
        </div>
        <div class="separator border-1 border-dashed my-5"></div>
        <div class="tooltip-body">
            <div class="d-flex gap-3 text-items-center">
                <i class="ki-duotone ki-information-4 text-success fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <p><strong>Kondisi:</strong> Mulai</p>
            </div>
            <div class="d-flex gap-3 text-items-center">
                <i class="ki-duotone ki-calendar-search text-success fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
                <p><strong>Tanggal:</strong> {{ $date->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    @elseif($type == 'berakhir-proyek')
        <div class="tooltip-header text-warning">
            Proyek: {{ $name }}
        </div>
        <div class="separator border-1 border-dashed my-5"></div>
        <div class="tooltip-body">
            <div class="d-flex gap-3 text-items-center">
                <i class="ki-duotone ki-information-4 text-warning fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <p><strong>Kondisi:</strong> Berakhir</p>
            </div>
            <div class="d-flex gap-3 text-items-center">
                <i class="ki-duotone ki-calendar-search text-warning fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
                <p><strong>Tanggal:</strong> {{ $date->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    @elseif($type == 'mulai-sprint')
        <div class="tooltip-header text-primary">
            Sprint: {{ $name }}
        </div>
        <div class="separator border-1 border-dashed my-5"></div>
        <div class="tooltip-body">
            <div class="d-flex gap-3 text-items-center">
                <i class="ki-duotone ki-information-4 text-primary fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <p><strong>Kondisi:</strong> Mulai</p>
            </div>
            <div class="d-flex gap-3 text-items-center">
                <i class="ki-duotone ki-calendar-search text-primary fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
                <p><strong>Tanggal:</strong> {{ $date->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    @elseif($type == 'berakhir-sprint')
        <div class="tooltip-header text-danger">
            Sprint: {{ $name }}
        </div>
        <div class="separator border-1 border-dashed my-5"></div>
        <div class="tooltip-body">
            <div class="d-flex gap-3 text-items-center">
                <i class="ki-duotone ki-information-4 text-danger fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                </i>
                <p><strong>Kondisi:</strong> Berakhir</p>
            </div>
            <div class="d-flex gap-3 text-items-center">
                <i class="ki-duotone ki-calendar-search text-danger fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
                <p><strong>Tanggal:</strong> {{ $date->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    @endif
</div>

<style>
    .tooltip-calendar {
        text-align: left;
    }
</style>
