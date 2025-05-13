<a
    type="button"
    onclick="showModalEdit({url: '{{ $url_update }}', name: '{{ $unit->name ?? '-' }}', desc: '{{ $unit->desc ?? '-' }}'})"
    class="text-primary">{{ $unit->name ?? '-' }}
</a>
