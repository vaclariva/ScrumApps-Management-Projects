<table id="{{ $tableId }}" class="table align-middle table-row-dashed fs-6 gy-3">
    <thead>
        <tr class="text-start text-gray-500 fw-bold fs-7 gs-0">
            @foreach($columns as $column)
                <th
                    class="{{ $column == "Aksi" ? "text-center" : "" }}"
                    @if(isset($minWidths) && $loop->index < count($minWidths))
                        style="min-width: {{ $minWidths[$loop->index] }};"
                    @endif
                >
                    {!! $column !!}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold"></tbody>
</table>
