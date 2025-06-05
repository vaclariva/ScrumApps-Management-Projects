function updateCard(res) {
    console.log("UpdateCard jalan", updateCard);
    const backlog = res.backlog;
    const backlogId = backlog.id;
    const cardSelector = `#checklist-${backlogId}`;
    const targetContainer = $(`${cardSelector} .card-body .d-flex`).first();

    // Update Title
    const titleEl = $(`.card-title[data-backlog-id="${backlogId}"]`);
    if (titleEl.length && titleEl.text().trim() !== backlog.name) {
        titleEl.text(backlog.name);
    }

    // Update Priority Badge
    const badgeEl = $(`.BacklogPriorityBadge[data-backlog-id="${backlogId}"]`);
    const newPriority = backlog.priority;
    const newPriorityText =
        newPriority === 'high' ? 'Tinggi' :
        newPriority === 'medium' ? 'Sedang' :
        newPriority === 'low' ? 'Rendah' :
        newPriority;

    const newPriorityClass =
        newPriority === 'high' ? 'badge-light-danger' :
        newPriority === 'medium' ? 'badge-light-warning' :
        newPriority === 'low' ? 'badge-light-success' :
        'badge-light-secondary';

    if (badgeEl.length && (badgeEl.text().trim() !== newPriorityText || !badgeEl.hasClass(newPriorityClass))) {
        badgeEl.text(`• ${newPriorityText}`)
               .removeClass("badge-light-danger badge-light-warning badge-light-success badge-light-secondary")
               .addClass(newPriorityClass);
    }

    // Update Description Icon
    const iconWrapper = $(`.BacklogDescriptionDisplay[data-backlog-id="${backlogId}"]`);
    if (backlog.description) {
        iconWrapper.removeClass('d-none');
    } else {
        iconWrapper.addClass('d-none');
    }

    // Update Sprint Info
    const sprintInfoEl = $(`.BacklogSprintInfo[data-backlog-id="${backlogId}"]`);
    if (backlog.sprint_id) {
        sprintInfoEl.removeClass('d-none');
    } else {
        sprintInfoEl.addClass('d-none');
    }

    // Update Status "Selesai"
    const statusDoneEl = $(`.BacklogStatusDone[data-backlog-id="${backlogId}"]`);
    if (backlog.status === 'active') {
        statusDoneEl.removeClass('d-none');
    } else {
        statusDoneEl.addClass('d-none');
    }

    // Update data-* attributes pada tombol edit
    const editBtn = $(`.btn-edit-backlog[data-id="${backlogId}"]`);
    editBtn.data('name', backlog.name);
    editBtn.data('description', backlog.description);
    editBtn.data('priority', backlog.priority);
    editBtn.data('status', backlog.status);
    editBtn.data('applicant', backlog.applicant);
    editBtn.data('user-id', backlog.user_id);
    editBtn.data('project-id', backlog.project_id);
    editBtn.data('sprint-id', backlog.sprint_id);
    editBtn.data('user-name', backlog.user?.name);
    editBtn.data('user-photo', backlog.user?.photo);

    // Kalau kamu simpan check_backlogs juga di tombol:
    editBtn.attr('data-check-backlogs', JSON.stringify(backlog.check_backlogs));
    console.log('isi checkbacklog:', res.backlog.checkBacklogs)
}

$(document).on('click', '.btn-edit-backlog', function () {
    let backlogId = $(this).data('id');
    $('#editBacklogForm').attr('action', `/backlogs/${backlogId}`);
    $('#editBacklogId').val(backlogId);
    let checkBacklogs = $(this).data('check-backlogs');
    $('#editBacklogForm').data('check-backlogs', checkBacklogs);

});


function updateAjax({ el }) {
    let form = $(el).closest("form");
    let url = form.attr("action");
    let method = form.attr("method") ?? "POST";
    let formData = new FormData(form[0]);
    let checkBacklogs = form.data('check-backlogs');
    formData.append('check_backlogs', JSON.stringify(checkBacklogs));
    formData.append('status', $('#edit_status').is(':checked') ? 'active' : 'inactive');

    let btnOri = $(el).html();
    let loader = "Simpan Data Backlog <span class='spinner spinner-border spinner-border-sm text-white ms-2'></span>";

    $.ajax({
        url: url,
        type: method,
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            $(el).attr("disabled", true);
            $(el).html(loader);
        },
        success: function (res) {
            console.log('Response dari updateBacklog:', res);
            const backlogId = res.backlog.id;

            const cardSelector = `#backlog_card_${res.backlog.id}`;
            const isCardExist = $(cardSelector).length > 0;

            if (isCardExist) {
                updateCard({
                    backlog: res.backlog,
                    project: res.project
                });
            } else if (res?.html) {
                $('#list-backlogs').prepend(res.html);
                KTMenu.createInstances();
            }

            let successCallbackName = form.data("success-callback");
            if (successCallbackName && typeof window[successCallbackName] === "function") {
                window[successCallbackName](res);
            } else {
                showSuccessToast({ message: res?.message ?? "Success" });
            }
        },
        error: function (xhr) {
            if (typeof xhr.responseJSON?.errors === "object") {
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
        },
        complete: function () {
            $(el).html(btnOri);
            $(el).attr("disabled", false);

            let completeCallbackName = form.data("complete-callback");
            if (completeCallbackName && typeof window[completeCallbackName] === "function") {
                window[completeCallbackName]();
            }
        }
    });
}

$(document).ready(function () {
    $(document).on('click', '.btn-edit-backlog', function () {
        const modal = $('#modal_edit_backlog');
        const id = $(this).data('id');

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
            modal.find('[name="sprint_id"]').val(sprintId).trigger('change');
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
    $('.btn-add-checklist').removeClass('d-none');

    const rawData = $(this).attr('data-check-backlogs');
    const checkBacklogs = JSON.parse(rawData);

    $('#form-checklist .checklist-forms').empty();

    checkBacklogs.forEach(function (checkBacklog) {
        const name = checkBacklog.name ?? '';
        const checked = checkBacklog.status === 'active' ? 'checked' : '';
        const backlogId = checkBacklog.backlog_id ?? '';
        const id = checkBacklog.id ?? '';
        const isSaved = !!id;
        const formAttributes = isSaved ? 'data-saved="true"' : 'data-saved="false"';
        const isActive = checkBacklog.status === 'active';
        const lineThroughStyle = isActive ? 'text-decoration: line-through;' : '';

        const formHtml = `
            <form class="form-checklist d-flex flex-column gap-3 mb-3 ffff"
                ${formAttributes}
                action="/check-backlog/store"
                method="POST"
                data-success-callback="checklistSaved"
                data-complete-callback="resetChecklistForm"
                data-check-backlog-id="${id}"
                onsubmit="event.preventDefault();">
                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                <input type="hidden" name="backlog_id" class="backlog-id-field" value="${backlogId}">
                <input type="hidden" name="id" class="checkBacklogId" value="${id}">
                <div class="form-check checklist-item form-check-solid">
                    <input type="checkbox"
                        class="form-check-input checklist-status-toggle"
                        data-id="${id}"
                        ${checked}>
                    <input type="hidden" name="name" class="checklist-hidden-title" />
                    <div class="form-check-label checklist-editable"
                        contenteditable="true"
                        spellcheck="false"
                        style="width: 100%; outline: none; ${lineThroughStyle}"
                        onfocus="this.style.backgroundColor='#fff5f5'; this.style.borderRadius='0.475rem'; this.style.padding='0.5rem';"
                        onblur="this.style.backgroundColor=''; this.style.padding='0';">
                        ${name}
                    </div>
                </div>
                <div class="d-flex gap-3 checklist-action-buttons d-none">
                    <button type="button" onclick="submitCheckbacklog({el: this})" class="btn btn-sm tbr_btn tbr_btn--primary btn-save-checklist">Tambah</button>
                    <button type="button" onclick="updateCheckbacklog({el: this})" class="btn btn-sm tbr_btn tbr_btn--primary btn-update-checklist d-none">Simpan</button>
                    <button type="button" class="btn btn-sm btn-secondary btn-cancel-checklist">Batal</button>
                    <button type="button" onclick="deleteCheckbacklog({el: this})" class="btn btn-sm btn-secondary btn-delete-checklist d-none">Hapus</button>
                </div>
            </form>
        `;

        $('#form-checklist .checklist-forms').append(formHtml);
    });
    $('#form-checklist').show();
});
