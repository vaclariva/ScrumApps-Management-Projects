@foreach ($breadcrumbs as $item)
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ $item['link'] }}" class="{{ $loop->last ? 'tbr_text--primary' : 'text-muted' }} fw-bold">
            {{ $item['title'] }}
        </a>
    </li>
@endforeach
