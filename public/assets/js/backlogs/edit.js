$(document).ready(function () {
    $(document).on('click', '.btn-edit-backlog', function () {
        const modal = $('#modal_edit_backlog');
        const id = $(this).data('id');

        modal.find('form').attr('action', `/backlogs/${id}`);
        modal.find('input[name="_method"]').val('PATCH');
        modal.find('#project_id').val($(this).data('project-id'));
        modal.find('#user_id').val($(this).data('user-id'));
        modal.find('#edit_name').val($(this).data('name'));
        modal.find('#edit_description').val($(this).data('description'));
        const priority = $(this).data('priority');
        modal.find('select[name="priority"]').val(priority).trigger('change');
        modal.find('#edit_applicant').val($(this).data('applicant'));
        modal.find('#edit_status').prop('checked', $(this).data('status') === 'active');
        const sprintId = $(this).data('sprint-id');
        if (sprintId !== undefined) {
            modal.find('#edit_sprint_id').val(sprintId);
        }
        const userPhoto = $(this).data('user-photo') || '/assets/images/avatar.png';
        const userName = $(this).data('user-name');
        modal.find('img').attr('src', userPhoto).attr('alt', userName);
        modal.find('.text-muted.fs-7').text(userName);

        modal.modal('show');
    });
});

$('.btn-edit-backlog').on('click', function () {
    let rawJson = $(this).attr('data-check-backlogs');
    let checkBacklogs = [];

    try {
        checkBacklogs = JSON.parse(rawJson);
    } catch (e) {
        console.error('Gagal parse JSON:', e);
    }

    $.each(checkBacklogs, function (index, item) {
        console.log(item.name, item.status);
    });
});

$(document).on('click', '.btn-edit-backlog', function (e) {
    e.preventDefault();

    const rawData = $(this).attr('data-check-backlogs');
    const checkBacklogs = JSON.parse(rawData);

    $('#form-checklist .checklist-forms').empty();

    checkBacklogs.forEach(function (checkBacklog) {
        const name = checkBacklog.name ? checkBacklog.name : '';
        const checked = checkBacklog.status === 'active' ? 'checked' : '';

        const formHtml = `
            <form class="form-checklist d-flex flex-column gap-3 mb-3"
                action="/check-backlog/${checkBacklog.id}" method="POST"
                onsubmit="event.preventDefault();">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="backlog_id" value="${checkBacklog.backlog_id}">

                <div class="form-check checklist-item form-check-solid">
                    <input type="checkbox" name="status" class="form-check-input" ${checked} />
                    <input type="hidden" name="name" class="checklist-hidden-title" value="${name}">
                    <div class="form-check-label checklist-editable"
                        contenteditable="true"
                        style="width: 100%; outline: none;"
                        onfocus="this.style.backgroundColor='#fff5f5'; this.style.borderRadius='0.475rem'; this.style.padding='0.5rem';"
                        onblur="this.style.backgroundColor=''; this.style.padding='0';">
                        ${name}
                    </div>
                </div>
                <div class="d-flex gap-3 checklist-action-buttons d-none" hidden>
                    <button type="submit" class="btn btn-sm tbr_btn tbr_btn--primary">Simpan</button>
                    <button type="button" class="btn btn-sm btn-secondary btn-cancel-checklist">Batal</button>
                </div>
            </form>
        `;

        $('#form-checklist .checklist-forms').append(formHtml);
    });

    $('#form-checklist').show();
});
