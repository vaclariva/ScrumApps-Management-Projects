@php
    $roleLabels = [
        'ui/ux' => 'UI/UX',
        'backend' => 'BackEnd',
        'frontend' => 'FrontEnd',
        'fullstack' => 'FullStack',
        'quality_assurance' => 'Quality Assurance',
    ];
@endphp

<div class="d-flex align-items-center gap-4">
        <span>{{ $roleLabels[$team->role] }}</span>
</div>
