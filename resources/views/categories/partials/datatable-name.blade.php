<a
    type="button"
    onclick="showModalEdit({url: '{{ $url_update }}', name: '{{ $category->name ?? '-' }}', desc: '{{ $category->desc ?? '-' }}'})"
    class="text-primary">{{ $category->name ?? '-' }}
</a>
