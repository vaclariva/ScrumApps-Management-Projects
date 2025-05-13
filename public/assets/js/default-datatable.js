/**
 * Initializes a Datatable with the provided table ID, URL, data, and columns.
 *
 * @param {object} options - An object containing tableId, url, data, and columns.
 * @return {void}
 */
function initDatatable({
    tableId,
    url,
    data,
    columns,
    dtDrawCallbackFunctionName = null,
    dtPreDrawCallbackFunctionName = null,
    dtRowCallbackFunctionName = null,
    columnDefs = null,
    freezeLeftColumns = null
}) {
    if (url) {
        var ajaxCall = {
            url: url,
        };
        if (data) {
            ajaxCall["data"] = data;
        }
    }
    ajaxCall["error"] = function (xhr, status, error) {
        if (xhr.status == 401) {
            window.location.reload();
        }
    };
    dt = $(`#${tableId}`).DataTable({
        // lengthChange: false,
        language: {
            searchPlaceholder: "Search",
            sLengthMenu: "_MENU_",
            processing:
                "<div class='d-flex justify-content-center align-items-center'> Sedang memproses</div>",
            search: "",
            loadingRecords: "",
            zeroRecords: "Tidak ada data yang tersedia dalam tabel",
        },
        columnDefs: columnDefs,
        length: false,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        info: false,
        order: [[0]],
        stateSave: false,
        ajax: ajaxCall,
        columns: columns,
        fixedColumns: {
            leftColumns: freezeLeftColumns,
        },
        preDrawCallback: function () {
            typeof dtPreDrawCallbackFunctionName == "function" &&
                dtPreDrawCallbackFunctionName();
        },
        drawCallback: function () {
            $(`[name="${tableId}_length"]`).select2({
                minimumResultsForSearch: Infinity,
            });
            typeof dtDrawCallbackFunctionName == "function" &&
                dtDrawCallbackFunctionName();
        },
        rowCallback: function (row, data) {
            typeof dtRowCallbackFunctionName == "function" &&
                dtRowCallbackFunctionName(row, data);
        },
    });

    // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
    dt.on("draw", function () {
        KTMenu.createInstances();
    });

    // Listen search
    eval("var searchId = `#" + tableId + "-search`;");
    $(searchId).on(
        "keyup",
        $.debounce(1000, function () {
            defaultSearchDatatable({ tableId: tableId, query: $(this).val() });
        })
    );

    // listen length
    eval("var lengthId = `#" + tableId + "-length`;");
    $(lengthId).on("change", function () {
        defaultLengthDatatable({ tableId: tableId, length: $(this).val() });
    });
    return dt;
}

/**
 * Reloads the data in the specified DataTable.
 *
 * @param {string} tableId - The ID of the table to reload.
 * @return {void}
 */
function defaultReloadDatatable({ tableId }) {
    $(`#${tableId}`).DataTable().ajax.reload();
}

/**
 * Updates the search query for a given DataTable.
 *
 * @param {string} tableId - The ID of the DataTable element.
 * @param {string} query - The search query to apply.
 */
function defaultSearchDatatable({ tableId, query }) {
    $(`#${tableId}`).DataTable().search(query).draw();
}

/**
 * Sets the default length of the datatable with the given tableId.
 *
 * @param {string} tableId - The ID of the table
 * @param {number} length - The default length to set
 */
function defaultLengthDatatable({ tableId, length }) {
    $(`#${tableId}`).DataTable().page.len(length).draw();
}
