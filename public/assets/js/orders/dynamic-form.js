const modalProduct = $("#tbr-modal-product");
const productEmptyEl = $(".tbr_empty--product");
const btnAddProduct = $(".tbr_add--product");
const loaderOrdered = $("#loader-ordered");
const tableProductOrdered = $("#table-product-ordered");
const filterCategory = $("#filter-category");
const noteInput = $('[name=note]');

const debouncedUpdateOrderProduct = debounce((params) => {
    updateOrderProduct(params);
}, 1000);

let indexOrderProduct = 1;

$(function () {
    // Listen filter category in modal change
    filterCategory.on("select2:select", function () {
        dtProducts.ajax.reload();
    });

    // Listen note input
    noteInput.on("input", $.debounce(1000, function(){
        updateSalesOrder({
            beforeSendCallback: () => {$(this).attr('disabled',true);},
            successCallback: () => {$(this).attr("disabled", false);},
        });
    }));
});

function showModalProduct() {
    modalProduct.modal("show");
}

const dataDatatableProduct = function (d) {
    d.order_id = orderId;
    d.partner_id = selectPartner.val();
    d.warehouse_id = selectWarehouse.val();
    d.category_id = filterCategory.val();
    d.type = $('#type').val();
};

function initDataProduct() {
    dtProducts = initDatatable({
        tableId: "table-products",
        url: urlDatatableProduct,
        data: dataDatatableProduct,
        columns: [
            {
                name: "DT_RowIndex",
                data: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                name: "variant_name",
                data: "variant_name",
            },
            {
                name: "stock",
                data: "stock",
            },
            {
                name: "price",
                data: "price",
            },
            {
                name: "unit",
                data: "unit",
            },
            {
                name: "category",
                data: "category",
            },
            {
                name: "actions",
                data: "actions",
            },
        ],
    });
}

function getOrderProducts() {
    $.ajax({
        url: urlGetOrderProducts,
        method: "GET",
        data: {
            order_id: orderId,
            partner_id: selectPartner.val(),
        },
        beforeSend: function () {
            showElement({ el: loaderOrdered });
            hideElement({ el: productEmptyEl });
            hideElement({ el: btnAddProduct });
            hideElement({ el: tableProductOrdered.find("tbody") });
        },
        success: function (res) {
            indexOrderProduct = 1;
            tableProductOrdered.find("tbody").empty();
            showElement({ el: tableProductOrdered.find("tbody") });
            if (res.length > 0) {
                let productOrdered = res;
                productOrdered.map((value, index) => {
                    appendOrderProduct({ data: value });
                });
            } else {
                showElement({ el: productEmptyEl });
            }
            calculateGrandTotal();
        },
        error: function (xhr, status, error) {
            if (typeof xhr.responseJSON?.errors === "object") {
                errorList = xhr.responseJSON?.errors;
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                errorList = xhr.responseJSON?.message;
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
        },
        complete: function () {
            hideElement({ el: loaderOrdered });
            showElement({ el: btnAddProduct });
        },
    });
}

function addOrderProduct({ el, productVariantId }) {
    let button = $(el);
    let buttonOri = button.html();
    let loader =
        "<span class='spinner spinner-border spinner-border-sm text-white'></span>";
    $.ajax({
        url: urlAddOrderProduct,
        method: "POST",
        data: {
            partner_id: selectPartner.val(),
            order_id: orderId,
            product_variant_id: productVariantId,
        },
        beforeSend: function () {
            button.html(loader);
            button.attr("disabled", true);
        },
        success: function (res) {
            getOrderProducts();
        },
        error: function (xhr, status, error) {
            if (typeof xhr.responseJSON?.errors === "object") {
                errorList = xhr.responseJSON?.errors;
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                errorList = xhr.responseJSON?.message;
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
        },
        complete: function () {
            button.html(buttonOri);
            button.attr("disabled", true);
        },
    });
}

function deleteOrderProduct({ el, url }) {
    let button = $(el);
    let buttonOri = button.html();
    let loader =
        "<span class='spinner spinner-border spinner-border-sm tbr_text--primary'></span>";
    $.ajax({
        url: url,
        method: "DELETE",
        beforeSend: function () {
            button.html(loader);
            button.attr("disabled", true);
        },
        success: function (res) {
            getOrderProducts();
        },
        error: function (xhr, status, error) {
            if (typeof xhr.responseJSON?.errors === "object") {
                errorList = xhr.responseJSON?.errors;
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                errorList = xhr.responseJSON?.message;
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
        },
        complete: function () {
            button.html(buttonOri);
            button.attr("disabled", false);
        },
    });
}

function updateOrderProduct({ tr, quantity, productDiscount }) {
    let button = $(tr).find("td").last().find("button");
    let buttonOri = button.html();
    let loader =
        "<span class='spinner spinner-border spinner-border-sm tbr_text--primary'></span>";
    $.ajax({
        url: tr.data("url"),
        method: "PUT",
        beforeSend: function () {
            button.html(loader);
            button.attr("disabled", true);
        },
        data: {
            warehouse_id: selectWarehouse.val(),
            quantity: quantity,
            product_discount: productDiscount,
        },
        success: function (res) {
            console.log(res);
        },
        error: function (xhr, status, error) {
            if (typeof xhr.responseJSON?.errors === "object") {
                errorList = xhr.responseJSON?.errors;
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                errorList = xhr.responseJSON?.message;
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
        },
        complete: function () {
            button.html(buttonOri);
            button.attr("disabled", false);
        },
    });
}

function appendOrderProduct({ data }) {
    tableProductOrdered
        .find("tbody")
        .append(generateTemplateOrder({ data: data }));
    new AutoNumeric(`#qty--${indexOrderProduct}`, {
        allowDecimalPadding: false,
        decimalCharacter: ",",
        digitGroupSeparator: ".",
        minimumValue: 0,
    });
    new AutoNumeric(`#discount--${indexOrderProduct}`, {
        decimalPlaces: 0,
        decimalCharacter: ",",
        digitGroupSeparator: ".",
        minimumValue: 0,
    });
    $('[data-bs-toggle="tooltip"]').tooltip({
        html: true,
        trigger: "hover",
        title: `<div class="d-flex align-items-start flex-column">
                    <div class="text-gray-800 fw-bolder">Produk ini tidak tersedia di ${warehouseNameDestination.first().text()}. Silakan: </div>
                    <div class="d-flex align-items-center gap-2 ms-2">
                        <img src='${circleSvg}' width="4" height="4"/>
                        <span>Tambahkan stok di ${warehouseNameDestination.first().text()} melalui manajemen inventaris, atau</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 ms-2">
                        <img src='${circleSvg}' width="4" height="4" />
                        <span>Hapus produk ini dari daftar pesanan untuk melanjutkan pemesanan.</span>
                    </div>
                </div>`,
        customClass: "tbr_tooltip--mw-fit",
    });
    indexOrderProduct++;
}

function generateTemplateOrder({ data }) {
    return `
    <tr data-url='${data.url_delete}'
        ${data.is_over ? "style='background-color: var(--tbr-light-danger)' data-bs-toggle='tooltip'" : ""}
    >
        <td>${indexOrderProduct}</td>
        <td>
            <div class="d-flex align-items-center gap-4">
                <img src="${
                    data.image
                }" alt="" width="36" height="36" class="rounded-3 object-fit-cover">
                <div class="d-flex flex-column">
                    <span class="text-gray-800 font-bold">${
                        data.product_name ?? "-"
                    }</span>
                    <span class="text-gray-600 font-bold">${
                        data.variant_name ?? "-"
                    }</span>
                </div>
            </div>
        </td>
        <td>${data.product_stock}</td>
        <td>Kg</td>
        <td>
            <div class="input-group md">
                <button class="btn tbr_btn tbr_btn--icon md input-group-text" onclick="minusQty({el: this})" ${
                    data.is_over ? "style='opacity: 1' disabled" : ""
                }>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5544 8.20312L4.54688 8.24813C4.34796 8.24813 4.1572 8.32714 4.01655 8.4678C3.87589 8.60845 3.79688 8.79921 3.79688 8.99813C3.79688 9.19704 3.87589 9.3878 4.01655 9.52846C4.1572 9.66911 4.34796 9.74813 4.54688 9.74813L13.5469 9.70312C13.7458 9.70312 13.9366 9.62411 14.0772 9.48346C14.2179 9.3428 14.2969 9.15204 14.2969 8.95312C14.2969 8.75421 14.2179 8.56345 14.0772 8.4228C13.9366 8.28214 13.7458 8.20312 13.5469 8.20312H13.5544Z" fill="#7E8299"/>
                    </svg>
                </button>
                <input
                    type="text"
                    class="tbr_form form-control md autonumeric px-1 text-center ajax-disabled qty-row"
                    id="qty--${indexOrderProduct}"
                    oninput="calculateTotalPriceRow({index: '${indexOrderProduct}'})"
                    value="${data.quantity}" data-price="${data.price ?? 0}"
                    ${data.is_over ? "disabled" : ""}
                />
                <button class="btn tbr_btn tbr_btn--icon md input-group-text" onclick="addQty({el: this})" ${
                    data.is_over ? "style='opacity: 1' disabled" : ""
                }>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 8.25H9.75V4.5C9.75 4.30109 9.67098 4.11032 9.53033 3.96967C9.38968 3.82902 9.19891 3.75 9 3.75C8.80109 3.75 8.61032 3.82902 8.46967 3.96967C8.32902 4.11032 8.25 4.30109 8.25 4.5V8.25H4.5C4.30109 8.25 4.11032 8.32902 3.96967 8.46967C3.82902 8.61032 3.75 8.80109 3.75 9C3.75 9.19891 3.82902 9.38968 3.96967 9.53033C4.11032 9.67098 4.30109 9.75 4.5 9.75H8.25V13.5C8.25 13.6989 8.32902 13.8897 8.46967 14.0303C8.61032 14.171 8.80109 14.25 9 14.25C9.19891 14.25 9.38968 14.171 9.53033 14.0303C9.67098 13.8897 9.75 13.6989 9.75 13.5V9.75H13.5C13.6989 9.75 13.8897 9.67098 14.0303 9.53033C14.171 9.38968 14.25 9.19891 14.25 9C14.25 8.80109 14.171 8.61032 14.0303 8.46967C13.8897 8.32902 13.6989 8.25 13.5 8.25Z" fill="#7E8299"/>
                    </svg>
                </button>
            </div>
        </td>
        <td>${rupiah(data.price ?? 0)}</td>
        <td>
            <div class="input-group md">
                <span class="input-group-text">Rp</span>
                <input
                    type="text"
                    class="tbr_form form-control md autonumeric px-1 text-center ajax-disabled"
                    oninput="calculateTotalPriceRow({index: '${indexOrderProduct}'})"
                    id="discount--${indexOrderProduct}"
                    value="${data.product_discount ?? ""}"
                    ${data.is_over ? "disabled" : ""}
                />
            </div>
        </td>
        <td><span class="total-price-row" id="total-price--${indexOrderProduct}">${rupiah(
        (data.price ?? 0) * (data.quantity ?? 0) - (data.discount ?? 0)
    )}</span></td>
        <td>
            <div class="d-flex flex-center">
                <button class="btn tbr_btn tbr_btn--icon tbr_btn--light-primary sm ajax-disabled" type="button" onclick="deleteOrderProduct({el: this, url: '${
                    data.url_delete
                }'})">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M12.9576 3.04372C13.2398 3.32596 13.2398 3.78357 12.9576 4.06582L4.06973 12.9537C3.78748 13.2359 3.32987 13.2359 3.04762 12.9537C2.76538 12.6714 2.76538 12.2138 3.04762 11.9316L11.9355 3.04372C12.2177 2.76147 12.6753 2.76147 12.9576 3.04372Z" fill="#F8285A"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04762 3.04372C3.32987 2.76147 3.78748 2.76147 4.06973 3.04372L12.9576 11.9316C13.2398 12.2138 13.2398 12.6714 12.9576 12.9537C12.6753 13.2359 12.2177 13.2359 11.9355 12.9537L3.04762 4.06582C2.76538 3.78357 2.76538 3.32596 3.04762 3.04372Z" fill="#F8285A"/>
                    </svg>
                </button>
            </div>
        </td>
    </tr>`;
}

function addQty({ el }) {
    let input = $(el).siblings("input");
    let autonumeric = AutoNumeric.getAutoNumericElement("#" + input.attr("id"));
    let inputVal = input.val();
    if (inputVal.length > 0) {
        inputVal = autonumeric.getNumber() + 1;
    } else {
        inputVal = 1;
    }
    autonumeric.set(inputVal);
    input.trigger("input");
}

function minusQty({ el }) {
    let input = $(el).siblings("input");
    let autonumeric = AutoNumeric.getAutoNumericElement("#" + input.attr("id"));
    let inputVal = input.val();
    if (autonumeric.getNumber() > 1) {
        inputVal = autonumeric.getNumber() - 1;
    } else {
        inputVal = 0;
    }
    autonumeric.set(inputVal);
    input.trigger("input");
}

function calculateTotalPriceRow({ index }) {
    let qty = AutoNumeric.getAutoNumericElement(`#qty--${index}`).getNumber();
    let price = $(`#qty--${index}`).data("price") ?? 0;
    let discount = AutoNumeric.getAutoNumericElement(
        `#discount--${index}`
    ).getNumber();

    let totalPrice = (qty * price) - (discount * qty);
    if (totalPrice < 0) {
        totalPrice = 0;
    }
    $(`#total-price--${index}`).text(rupiah(totalPrice));

    let tr = $(`#total-price--${index}`).closest("tr");

    calculateGrandTotal();

    debouncedUpdateOrderProduct({
        tr: tr,
        quantity: qty,
        productDiscount: discount,
        id: tr.data("url"),
    });
}

function calculateGrandTotal(){
    // Calculate grand total
    let totalPriceRows = $(".total-price-row");
    let grandTotal = 0;
    let totalPriceRow = 0
    let extraDiscount = AutoNumeric.getAutoNumericElement('[name=extra_discount]').getNumber();
    let shippingCost = AutoNumeric.getAutoNumericElement('[name=shipping_cost]').getNumber();
    totalPriceRows.each((index, value)=>{
        let price = $(value).text().replace(/Rp\s?|\.|,/g, '');
        totalPriceRow += parseInt(price);
    });
    grandTotal += totalPriceRow;
    grandTotal -= extraDiscount;
    grandTotal += shippingCost;
    if(grandTotal < 0){
        grandTotal = 0;
    }
    $("#total-price-row").text(rupiah(totalPriceRow));
    $("#grand-total").text(rupiah(grandTotal));

    // calculate qty item
    let qtyRows = $(".qty-row");
    let qtyItems = 0;
    qtyRows.each((_, value)=>{
        let qty = AutoNumeric.getAutoNumericElement(value).getNumber();
        qtyItems += qty;
    });
    qtyItems = AutoNumeric.format(qtyItems, {
        allowDecimalPadding: false,
        decimalCharacter: ",",
        digitGroupSeparator: ".",
        minimumValue: 0,
    });
    $("#total-qty").text(qtyItems);
}

function debounce(func, wait) {
    let timeout = {};
    return function (...args) {
        let id = args[0].id;
        if(timeout[id]){
            clearTimeout(timeout[id]);
        }
        timeout[id] = setTimeout(() => func.apply(this, args), wait);
    };
}
