function dtRowCallback(row, data){
    let productImage = data.product_image;
    if(productImage){
        let img = $(row).find('img');
        img.tooltip("dispose");
        img.tooltip({
            title: `<img width='300' src='${productImage}' />`,
            html: true,
            trigger: "hover focus",
            placement: "right",
            customClass: "tbr_tooltip--mw-fit",
        });
    }
}

$(function () {
    activeSidebarTree({ id: "#sidebar-inventory-stock" });
    dtInventory = initDatatable({
        tableId: "table-inventory",
        url: urlDatatable,
        data: dataDatatable,
        dtRowCallbackFunctionName: dtRowCallback,
        columns: [
            {
                name: "DT_RowIndex",
                data: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                name: "product_variant_name",
                data: "product_variant_name",
            },
            {
                name: "stock",
                data: "stock",
            },
            {
                name: "unit_name",
                data: "unit_name",
            },
            {
                name: "warehouse_name",
                data: "warehouse_name",
            },
            {
                name: "status",
                data: "status",
            },
            {
                name: "updated_at",
                data: "updated_at",
            },
        ],
    });
});
