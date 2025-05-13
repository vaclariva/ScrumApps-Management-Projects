@if($status === 'Aktif')
    <span class="tbr_alert sm tbr_alert--success text-nowrap">Aktif</span>
@elseif($status === 'Nonaktif')
    <span class="tbr_alert sm tbr_alert--danger text-nowrap">Nonaktif</span>
@else
    <span class="badge badge-secondary">{{ $status }}</span>
@endif

