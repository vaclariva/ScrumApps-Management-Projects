function dtRowCallback(row, data) {
    let hasPhoto = !data.feature_image.includes("gallery.png");
    if (hasPhoto) {
        let img = $(row).find("img");
        img.tooltip("dispose");
        img.tooltip({
            title: `<img width='300' src='${data.feature_image}' />`,
            html: true,
            trigger: "hover focus",
            placement: "right",
            customClass: "tbr_tooltip--mw-fit",
        });
    }
}

$(function () {
    activeSidebarTree({ id: "#sidebar-product-all" });

    dtProducts = initDatatable({
        tableId: "table-products",
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
                name: "name",
                data: "name",
                searchable: false,
            },
            {
                name: "total_variant",
                data: "total_variant",
                searchable: false,
            },
            {
                name: "visibility",
                data: "visibility",
                searchable: false,
            },
            {
                name: "categories",
                data: "categories",
                searchable: false,
            },
            {
                name: "type",
                data: "type",
                searchable: false,
            },
            {
                name: "updated_at",
                data: "updated_at",
                searchable: false,
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
