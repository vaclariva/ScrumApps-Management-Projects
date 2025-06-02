@php
    $priorityText = '';
    $badgeClass = '';

    switch($backlog->priority) {
        case 'high':
            $priorityText = 'Tinggi';
            $badgeClass = 'badge badge-light-danger';
            break;
        case 'medium':
            $priorityText = 'Sedang';
            $badgeClass = 'badge badge-light-warning';
            break;
        case 'low':
            $priorityText = 'Rendah';
            $badgeClass = 'badge badge-light-success';
            break;
    }
@endphp

<span class="{{ $badgeClass }} BacklogPriorityBadge" data-backlog-id="{{ $backlog->id }}">• {{ $priorityText }}</span>
