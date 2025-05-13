<a
    type="button"
    onclick="showModalEdit({url: '{{ $url_update }}', name: '{{ $warehouse->name ?? '-' }}', desc: '{{ $warehouse->desc ?? '-' }}'})"
    class="text-primary">{{ $warehouse->name ?? '-' }}
</a>
