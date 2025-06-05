$(function () {
    activeSidebarTree({ id: "#sidebar-developments" });
});

var kanban;

var KTJKanbanDemoColor = function () {
    var exampleColor = function () {
        const kanbanContainer = document.getElementById('kt_docs_jkanban_color');
        if (kanbanContainer) {
            kanbanContainer.innerHTML = '';
        }

        const allTasks = window.allTasksDetail || [];

        const statuses = {
            _todo: { title: 'To Do', class: 'primary' },
            _in_progress: { title: 'In Progress', class: 'warning' },
            _qa: { title: 'Quality Assurance', class: 'info' },
            _done: { title: 'Done', class: 'success' }
        };

        const boards = [];

        for (const statusKey in statuses) {
            const boardConfig = statuses[statusKey];
            const tasksInStatus = allTasks.filter(task => task.status === statusKey);

            const board = {
                id: statusKey,
                title: boardConfig.title,
                class: boardConfig.class,
                item: tasksInStatus.map(task => ({
                    id: task.id,
                    title: `<div class="kanban-card-title fw-bold" data-eid="${task.id}">${task.title}</div>`,
                    class: task.class || '',
                    drag: true,
                    click: function (el) {
                        const clickedTaskId = el.querySelector('.kanban-card-title')?.dataset.eid;
                        const taskDetail = window.allTasksDetail.find(t => t.id == clickedTaskId);

                        if (taskDetail) {
                            openEditModal(taskDetail);
                            console.log('Task clicked for edit:', taskDetail);
                        } else {
                            console.error('Task detail tidak ditemukan untuk ID:', clickedTaskId);
                        }
                    }
                }))
            };
            boards.push(board);
        }

        kanban = new jKanban({
            element: '#kt_docs_jkanban_color',
            gutter: '0',
            widthBoard: '370px',
            boards: boards,
            dragItems: true,
            dropEl: function (el, target, source, sibling) {
                const droppedTaskId = el.dataset.eid;

                const newStatus = target.closest('.kanban-board').getAttribute('data-id');
                console.log('Dropped to status:', newStatus);

                const taskToUpdate = window.allTasksDetail.find(t => t.id == droppedTaskId);
                if (taskToUpdate) {
                    taskToUpdate.status = newStatus;
                    taskToUpdate.class = statuses[newStatus] ? `bg-light-${statuses[newStatus].class}` : '';
                }

                if (typeof updateTaskStatusInBackend === 'function') {
                    updateTaskStatusInBackend(droppedTaskId, newStatus);
                } else {
                    console.error('Function updateTaskStatusInBackend is not defined.');
                }
            }
        });
    };

    return {
        init: function () {
            exampleColor();
        },
        reinitializeKanban: exampleColor
    };
}();

// Run when DOM is ready
KTUtil.onDOMContentLoaded(function () {
    KTJKanbanDemoColor.init();
});
