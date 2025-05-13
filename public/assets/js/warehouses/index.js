$(function () {
    activeSidebarTree({ id: "#sidebar-inventory-warehouse" });
    const dtWarehouses = initDatatable({
        tableId: "table-warehouse",
        url: urlDatatable,
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
                name: "desc",
                data: "desc",
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

function showModalEdit({ url, name, desc }) {
    const modalEdit = $("#tbr-modal-edit");
    modalEdit.modal("show");

    modalEdit.find("form").attr("action", url);
    modalEdit.find("input[name=name]").val(name);
    modalEdit.find("textarea[name=desc]").val(desc);
}
