$(function () {
    activeSidebarTree({ id: "#sidebar-product-category" });
    const dtUnits = initDatatable({
        tableId: "table-categories",
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
		orderable: false
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

    modalEdit.find("input[name=name]").prop("readonly", name == "Uncategories");
}

function showModalDelete({ url, name }) {
    const modalDelete = $("#tbr-modal-delete");
    modalDelete.modal("show");

    modalDelete.find("#category-name").text(name);
    modalDelete.find("form").attr("action", url);

    const selectDelegate = modalDelete.find("[name=category_delegate]");
    selectDelegate.find("option").not('[value="init"]').remove();

    categories.forEach((category) => {
        if (category.name != name) {
            let option = new Option(category.name, category.id, false, false);
            selectDelegate.append(option);
        }
    });
    selectDelegate.off("select2:select").on("select2:select", function () {
        modalDelete.find('[type="submit"]').prop("disabled", false);
    });
}
