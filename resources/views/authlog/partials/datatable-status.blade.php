@php
    $variant = '';
    switch ($status) {
        case 'Failed':
            $variant = 'danger';
            break;
        case 'Logged In':
            $variant = 'success';
            break;
        case 'Verification':
            $variant = 'warning';
            break;
        case 'Logged Out':
            $variant = 'light';
            break;
        default:
            # code...
            break;
    }
@endphp

<div class="tbr_alert sm tbr_alert--{{ $variant }}">{{ $status }}</div>
