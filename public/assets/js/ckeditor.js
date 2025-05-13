$(document).ready(function () {
    window.editors = window.editors || {};

    $(".ckeditor-field").each(function () {
        const id = $(this).attr("id");

        if (!editors[id]) {
            ClassicEditor
                .create(this)
                .then(editor => {
                    editors[id] = editor;
                })
                .catch(error => {
                    console.error(`${id} failed to initialize`, error);
                });
        }
    });

    $('form').on('submit', function () {
        $.each(editors, function (id, editor) {
            $(`#${id}`).val(editor.getData());
        });
    });
});
