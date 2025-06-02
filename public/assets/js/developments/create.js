function newCard(res) {
    return `
        <div class="kanban-item bg-primary text-white" data-id="${res.task.id}" data-class="light-primary">
            <span class="fw-bold">
                <span class="fw-bold">${res.task.title}</span>
            </span>
        </div>
    `;
}

function submitAjax({ el }) {
    let form = $(el).closest("form");
    let url = form.attr("action");
    let method = form.attr("method") ?? "POST";
    let formData = new FormData(form[0]);
    let btnOri = $(el).html();
    let loader = "Simpan Data Kanban <span class='spinner spinner-border spinner-border-sm text-white ms-2'></span>";

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
            console.log("Task berhasil dibuat:", res);
            showSuccessToast({ message: res?.message ?? "Task berhasil dibuat" });

            const task = res.task;
            if (kanban && task && task.status) {
                const statusConfig = {
                    _todo: 'primary',
                    _inprocess: 'warning',
                    _working: 'info',
                    _done: 'success'
                };
                const statusClass = statusConfig[task.status] || 'secondary';
                kanban.addElement(task.status, {
                    id: task.id,
                    title: `<span class="fw-bold">${task.title}</span>`,
                    class: `bg-light-${statusClass}`,
                    drag: true,
                    click: function (el) {
                        const clickedTaskId = el.dataset.eid;
                        const taskDetail = window.allTasksDetail.find(t => t.id == clickedTaskId);
                        if (taskDetail) {
                            openEditModal(taskDetail);
                        }
                    }
                });
                const boardContainer = document.querySelector(`[data-id="${task.status}"] .kanban-drag`);
                const newElement = boardContainer.querySelector(`[data-eid="${task.id}"]`);
                if (boardContainer && newElement) {
                    boardContainer.insertBefore(newElement, boardContainer.firstChild);
                }
                if (Array.isArray(window.allTasksDetail)) {
                    window.allTasksDetail.push(task);
                }
            } else {
                console.warn("Tidak bisa menambahkan card ke kanban. Periksa status atau instance kanban.");
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
