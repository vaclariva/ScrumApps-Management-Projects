$(document).ready(function () {
    let sprintId = null;

    $(document).on('click', '.edit-name', function (e) {
        e.preventDefault();

        const id = $(this).data('id');
        const name = $(this).data('name');
        const description = $(this).data('description');
        const startDate = $(this).data('start_date');
        const endDate = $(this).data('end_date');
        const status = $(this).data('status');
        const resultReview = $(this).data('result_review');
        const resultRetrospective = $(this).data('result_retrospective');

        console.log($(this).data());

        sprintId = id;

        $('#modal_edit_sprints form').attr('action', '/sprints/' + id);
        $('#modal_edit_sprints #name').val(name ?? '');
        if (status === 'active') {
            $('#modal_edit_sprints #status').prop('checked', true);
        } else {
            $('#modal_edit_sprints #status').prop('checked', false);
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
            }) + ', ' + date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        $('#modal_edit_sprints #start_date').val(formatDate(startDate));
        $('#modal_edit_sprints #end_date').val(formatDate(endDate));

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

        setEditorData('edit_description', description);
        setEditorData('edit_result_review', resultReview);
        setEditorData('edit_result_retrospective', resultRetrospective);

        var myModal = new bootstrap.Modal(document.getElementById('modal_edit_sprints'));
        myModal.show();
    });

    $('#modal_edit_sprints form').on('submit', function (e) {
        e.preventDefault();
        console.log('Form submit diklik');

        const form = $(this);
        const url = '/sprints/' + sprintId;

        const data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: 'PUT',
            name: $('#modal_edit_sprints #name').val(),
            description: editors['edit_description'] ? editors['edit_description'].getData() : '',
            'result-review': editors['edit_result_review'] ? editors['edit_result_review'].getData() : '',
            'result-retrospective': editors['edit_result_retrospective'] ? editors['edit_result_retrospective'].getData() : '',
        };

        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            success: function (response) {
                console.log('Sprint berhasil diupdate');
                var myModalEl = document.getElementById('modal_edit_sprints');
                var modal = bootstrap.Modal.getInstance(myModalEl);
                modal.hide();

                location.reload();
            },
        });
    });
});
