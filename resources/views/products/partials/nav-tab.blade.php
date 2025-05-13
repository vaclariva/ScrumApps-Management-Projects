<ul class="nav nav-underline tbr_nav--tab">
    <li class="nav-item">
        <a class="nav-link {{ $activeIndex == 0 ? 'active' : '' }}" aria-current="page" href="{{ route('products.edit', $product->id) }}">Detail</a>
    </li>
    <li class="nav-item" id="tab-variant" style='display: {{ $showTabVariant ? '' : 'none' }}'>
        <a class="nav-link {{ $activeIndex == 1 ? 'active' : '' }}" href="{{ route('products.indexVariant', $product->id) }}">Varian</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeIndex == 2 ? 'active' : '' }}" href="{{ route('products.indexB2b', $product->id) }}">B2B</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeIndex == 3 ? 'active' : '' }}" href="{{ route('products.indexB2c', $product->id) }}">B2C</a>
    </li>
</ul>
