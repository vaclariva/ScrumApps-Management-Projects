$(document).ready(function () {
    $('[data-bs-target="#modal_edit_vision_boards"]').on('click', function () {
        const id = $(this).data('id');
        $('#modal_edit_vision_boards form').attr('action', '/vision-boards/' + id);

        $.get('/vision-boards/' + id, function (data) {
            $('#edit_name').val(data.name ?? '');

            function setEditorData(editorId, value) {
                if (editors[editorId]) {
                    editors[editorId].setData(value ?? '');
                } else {
                    let count = 0;
                    const interval = setInterval(() => {
                        if (editors[editorId]) {
                            editors[editorId].setData(value ?? '');
                            clearInterval(interval);
                        }
                        count++;
                        if (count > 10) clearInterval(interval);
                    }, 100);
                }
            }

            setEditorData('edit_vision', data.vision);
            setEditorData('edit_target_group', data.target_group);
            setEditorData('edit_needs', data.needs);
            setEditorData('edit_products', data.products);
            setEditorData('edit_goals', data.business_goals);
            setEditorData('edit_competitors', data.competitors);
        });
    });
});
