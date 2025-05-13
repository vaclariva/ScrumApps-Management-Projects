$(function () {
    activeSidebarTree({ id: "#sidebar-sprints" });
    window.dtSprints = initDatatable({
        tableId: "table-sprints",
        url: urlDatatable,
        data: function (d) {
            d.startDate = getAppliedFilterDate({
                id: "#date",
                dataName: "start-date",
            });
            d.endDate = getAppliedFilterDate({
                id: "#date",
                dataName: "end-date",
            });
            status: getCheckboxChecked({ name: "status" });
        },
        columnDefs: [{ visible: canDelete, target: 8 }],
        columns: [
            {
                name: "DT_RowIndex",
                data: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                name: "name",
                data: "name",
            },
            {
                name: "description",
                data: "description",
                orderable: false,
            },
            {
                name: "start_date",
                data: "start_date",
            },
            {
                name: "end_date",
                data: "end_date",
                orderable: false,
            },
            {
                name: "result_review",
                data: "result_review",
                orderable: false,
            },
            {
                name: "result_retrospective",
                data: "result_retrospective",
                orderable: false,
            },
            {
                name: "status",
                data: "status",
                orderable: false,
            },
            {
                name: "actions",
                data: "actions",
                orderable: false,
                searchable: false,
            },
        ],
    });
});


