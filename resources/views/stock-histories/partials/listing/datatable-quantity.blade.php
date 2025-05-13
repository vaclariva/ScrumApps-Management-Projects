<td>
    @if($begin_stock > $ending_stock)
        <span class="tbr_text--danger">-{{ $quantity }}</span>
    @elseif($ending_stock > $begin_stock)
        <span class="tbr_text--success">+{{ $quantity }}</span>
    @else
        <span>{{ $quantity }}</span>
    @endif
</td>
