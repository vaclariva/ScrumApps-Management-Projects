$(function () {
    activeSidebar({ id: "#sidebar-teams" });
    window.dtTeam = initDatatable({
        tableId: "table-teams",
        url: urlDatatable,
        data: dataDatatable,
        columnDefs: [{ visible: canDelete, target: 3 }],
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
                name: "role",
                data: "role",
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
