@if($status === 'processing')
    <span class="tbr_alert xs tbr_alert--info text-nowrap d-flex align-items-center">
        Diproses
    </span>
@elseif($status === 'waiting')
    <span class="tbr_alert xs tbr_alert--warning text-nowrap d-flex align-items-center">
        Menunggu
    </span>
@elseif($status === 'completed')
    <span class="tbr_alert xs tbr_alert--success d-flex align-items-center">
        Selesai
    </span>
@elseif($status === 'canceled')
    <span class="tbr_alert xs tbr_alert--extra-light d-flex align-items-center">
        Dibatalkan
    </span>
@endif
