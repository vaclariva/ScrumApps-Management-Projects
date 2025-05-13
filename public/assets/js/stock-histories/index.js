
function dtDrawCallbackFunctionName(){
    $('[data-bs-toggle="tooltip"]').tooltip();
}

$(function(){
    activeSidebarTree({id:"#sidebar-inventory-stock"});

    dtStockHistories = initDatatable({
        tableId: "table-stock-histories",
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
                name: "created_at",
                data: "created_at",
            },
            {
                name: "user_name",
                data: "user_name",
            },
            {
                name: "warehouse",
                data: "warehouse",
            },
            {
                name: "product_name_variant",
                data: "product_name_variant",
            },
            {
                name: "begin_stock",
                data: "begin_stock",
            },
            {
                name: "quantity",
                data: "quantity",
            },
            {
                name: "ending_stock",
                data: "ending_stock",
            },
            {
                name: "combined_column",
                data: null,
                render: function(data, type, row) {
                    return data.movement_type;
                }
            }
        ]});
})
