@php
    $variant = '';
    switch ($status) {
        case 'Out Of Stock':
            $variant = 'danger';
            break;
        case 'Available':
            $variant = 'success';
            break;
        case 'Low':
            $variant = 'warning';
            break;
        default:
            # code...
            break;
    }
@endphp

<div class="tbr_alert sm tbr_alert--{{ $variant }} text-nowrap">{{ $status }}</div>
