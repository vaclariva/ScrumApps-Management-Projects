
function dtDrawCallbackFunctionName(){
    $('[data-bs-toggle="tooltip"]').tooltip();
}

$(function(){
    activeSidebarTree({id:"#sidebar-customer-partner"});

    dtPartners = initDatatable({
        tableId: "table-partners",
        url: urlDatatable,
        data: dataDatatable,
        dtDrawCallbackFunctionName: dtDrawCallbackFunctionName,
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
                name: "group",
                data: "group",
            },
            {
                name: "credit_limit",
                data: "credit_limit",
            },
            {
                name: "regency",
                data: "regency",
            },
            {
                name: "phone_number",
                data: "phone_number",
            },
            {
                name: "status",
                data: "status",
            },
            {
                name: "updated_at",
                data: "updated_at",
            },
            {
                name: "actions",
                data: "actions",
                orderable: false,
                searchable: false,
            },
        ]
    });
})
