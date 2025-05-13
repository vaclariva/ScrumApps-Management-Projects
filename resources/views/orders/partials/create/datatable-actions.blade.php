@php
    $isDisabled = $stock <= 0 || $is_on_order;
@endphp
<div class="d-flex justify-content-center">
    <button class="btn tbr_btn tbr_btn--primary sm" type="button" onclick="addOrderProduct({el: this, productVariantId: '{{ $productVariantId }}'})" {{ $isDisabled ? 'disabled' : '' }}>Tambah</button>
</div>
