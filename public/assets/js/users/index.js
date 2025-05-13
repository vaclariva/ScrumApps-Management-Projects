$(function () {
    activeSidebar({ id: "#sidebar-users" });
    window.dtUser = initDatatable({
        tableId: "table-user",
        url: urlDatatable,
        data: dataDatatable,
        columnDefs: [{ visible: canDelete, target: 5 }],
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
                name: "phone_number",
                data: "phone_number",
                orderable: false,
            },
            {
                name: "email",
                data: "email",
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
