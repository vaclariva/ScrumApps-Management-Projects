const inputDate = $("#date")
const inputWarehouseId = $("#warehouse_id")
const productVariantParent = $('table tbody');
let indexDynamicForm = 1;
$(function(){
    activeSidebarTree({ id: "#sidebar-inventory-stock" });

    // Listen update date
    setInterval(() => {
        inputDate.val(moment().locale("id").format("DD MMMM YYYY, HH:mm"));
    }, 1000);

    // Listen change warehouse
    $(document).on("select2:select", "#warehouse_id", function () {
        let allSelect = $('select[name="product_variant_id[]"]');
        allSelect.each((index, el)=>{
            if($(el).val()){
                getStok({productVariantId: $(el).val(), tr: $(el).parents("tr")});
            }
        })
    });

    // Listen change is corection
    $(document).on("change", 'input[name="checklist_correction[]"]', function () {
        let isChecked = $(this).is(":checked");
        let parentTr = $(this).parents("tr");
        let trCorrectionInput = parentTr.next("tr");
        let isCollapsedCorrection = trCorrectionInput.find(".accordion-header")[0].classList.contains("collapsed");

        if (isChecked) {
            trCorrectionInput.fadeIn();
            parentTr.addClass("border-0");
            if (isCollapsedCorrection) {
                trCorrectionInput.find(".accordion-header").trigger("click");
            }
        } else {
            trCorrectionInput.fadeOut();
            parentTr.removeClass("border-0");
        }
    });

    // Listen change product_variant_id[]
    $(document).on(
        "select2:select",
        "select[name='product_variant_id[]']",
        function () {
            let optionChecked = $(this).find("option:selected");
            let unitName = optionChecked.data('unit-name');
            $(this).parents("tr").find(".tbr_unit--name").text(unitName);
            getStok({productVariantId: $(this).val(), tr: $(this).parents("tr")});
        }
    );

    // Listen select2 material opening for disabled click
    $(document).on(
        "select2:opening",
        "select[name='product_variant_id[]']",
        function (e) {
            var valueOptions = [];
            var selectedElId = $(this).attr("id");
            $("select[name='product_variant_id[]']").each(function () {
                var item = $(this);
                valueOptions.push(
                    item.find('option[value="' + item.val() + '"]').text()
                );
            });
            setTimeout(() => {
                $(
                    `.select2-results ul#select2-${selectedElId}-results li`
                ).each(function () {
                    var item = $(this);
                    if (valueOptions.includes(item.text())) {
                        item.addClass("select2-results__option--selected").css({
                            cursor: "default",
                            "pointer-events": "none",
                        });
                    }
                });
            }, 0);
        }
    );

    // Listen select2 search to disable selected material
    $(document).on("input", ".select2-search__field", function (e) {
        setTimeout(() => {
            var valueOptions = [];
            var selectedElId = $(this).attr("aria-controls");
            $("select[name='product_variant_id[]']").each(function () {
                var item = $(this);
                valueOptions.push(
                    item.find('option[value="' + item.val() + '"]').text()
                );
            });
            $(`.select2-results ul#${selectedElId} li`).each(function () {
                var item = $(this);
                console.log(item);
                if (valueOptions.includes(item.text())) {
                    item.addClass("select2-results__option--selected").css({
                        cursor: "default",
                        "pointer-events": "none",
                    });
                }
            });
        }, 0);
    });

    addProductVariant();
});

function addProductVariant(){
    productVariantParent.append(generateTemplateStockIn());
    $(`#product_variant_id--${indexDynamicForm}`).select2();
    new AutoNumeric(`#quantity--${indexDynamicForm}`, {
        allowDecimalPadding: false,
        decimalCharacter: ",",
        digitGroupSeparator: ".",
        minimumValue: 0,
    });
    indexDynamicForm++;
    logicCollapseAccordion();
}

function removeProductVariant({el}){
    $(el).parents("tr").next('.tbr_correction').remove();
    $(el).parents("tr").remove();
}

function getStok({productVariantId, tr}){
    let url = `/inventories/check-stock/${productVariantId}`;
    let stockEl = tr.find(".tbr_stock--actual");
    $.ajax({
        url: url,
        type: "GET",
        data: {
            warehouse_id: inputWarehouseId.val(),
        },
        beforeSend: function(){
            stockEl.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        },
        success: function (res) {
            stockEl.html(res.productVariant.stock);
        },
        error: function (xhr, status, error) {
            if (typeof xhr.responseJSON?.errors === "object") {
                showErrorToast({
                    message: xhr.responseJSON?.errors,
                    isMessageObject: true,
                });
            } else {
                showErrorToast({
                    message: xhr.responseJSON?.message,
                    isMessageObject: false,
                });
            }
            stockEl.html("-");
        },
    });
}

function generateTemplateStockIn(){
    let options = "";
    productVariants.forEach((productVariant) => {
        options += `
            <option value="${productVariant.id}" data-unit-name="${productVariant.unit_name}">
                ${productVariant.product_name} ${productVariant.name ? `- ${productVariant.name}` : ''}
            </option>`;
    });
    return `
    <tr>
        <td>
            <select name="product_variant_id[]" class="tbr_form form-control form-select form-select-solid md" id="product_variant_id--${indexDynamicForm}" data-control="select2" data-placeholder="Pilih Produk">
                <option></option>
                ${options}
            </select>
        </td>
        <td>
            <span class='tbr_stock--actual'>-</span>
        </td>
        <td>
            <div class="input-group flex-root md">
                <span class="input-group-text">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 12H18" stroke="#A1A5B7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <input type="number-with-coma" class="tbr_form form-control md" name="quantity[]" id="quantity--${indexDynamicForm}" value=""/>
            </div>
        </td>
        <td>
            <span class='tbr_unit--name'>-</span>
        </td>
        <td>
            <label class="form-check form-check-inline d-flex align-items-center justify-content-center">
                <input class="form-check-input md" type="checkbox" name="checklist_correction[]"
                    value="1"/>
            </label>
        </td>
        <td>
            <button class="btn tbr_btn tbr_btn--icon tbr_btn--light-primary sm mx-auto tbr_button--delete" anim="ripple" onclick="removeProductVariant({el: this})">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.6203 11.5446C11.4095 11.7542 11.1244 11.8718 10.8271 11.8718C10.5299 11.8718 10.2448 11.7542 10.034 11.5446L0.426523 2.04964C0.321079 1.94506 0.237385 1.82063 0.18027 1.68354C0.123155 1.54645 0.09375 1.39941 0.09375 1.25089C0.09375 1.10238 0.123155 0.955335 0.18027 0.818243C0.237385 0.681152 0.321079 0.556725 0.426523 0.452142C0.637306 0.24261 0.922439 0.125 1.21965 0.125C1.51686 0.125 1.80199 0.24261 2.01277 0.452142L11.6203 9.94714C11.7257 10.0517 11.8094 10.1762 11.8665 10.3132C11.9236 10.4503 11.953 10.5974 11.953 10.7459C11.953 10.8944 11.9236 11.0414 11.8665 11.1785C11.8094 11.3156 11.7257 11.4401 11.6203 11.5446Z" fill="#F8285A"/>
                    <path opacity="0.3" d="M2.01381 11.6247C1.79898 11.8426 1.50643 11.9661 1.20051 11.9682C0.894594 11.9703 0.600367 11.8508 0.382558 11.636C0.164749 11.4212 0.0411998 11.1286 0.03909 10.8227C0.0369802 10.5168 0.156482 10.2226 0.371308 10.0047L9.97881 0.374746C10.1936 0.156937 10.4862 0.0333873 10.7921 0.0312775C11.098 0.0291677 11.3922 0.14867 11.6101 0.363495C11.8279 0.578321 11.9514 0.870872 11.9535 1.17679C11.9556 1.48271 11.8361 1.77694 11.6213 1.99475L2.01381 11.6247Z" fill="#F8285A"/>
                </svg>
            </button>
        </td>
    </tr>
    <tr style="display: none" class="tbr_correction">
        <td colspan="6" class="pt-0">
            <div class="accordion accordion-icon-toggle tbr_accordion" id="accodion-parent-${indexDynamicForm}">
                <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-${indexDynamicForm}">
                    <div class="d-flex flex-root align-items-center gap-4">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M17.9193 6.9724V13.1807C17.9193 13.3057 17.8776 13.4307 17.7693 13.5391C16.5609 14.7557 14.4109 16.9224 13.1776 18.1641C13.0693 18.2807 12.9276 18.3307 12.7859 18.3307H6.14427C3.9026 18.3307 2.08594 16.5141 2.08594 14.2724V6.9724C2.08594 4.73073 3.9026 2.91406 6.14427 2.91406H13.8609C16.1026 2.91406 17.9193 4.73073 17.9193 6.9724Z" fill="#A1A5B7"/>
                            <path d="M6.90625 5.23906C6.55625 5.23906 6.28125 4.95573 6.28125 4.61406V2.28906C6.28125 1.9474 6.55625 1.66406 6.90625 1.66406C7.25625 1.66406 7.53125 1.9474 7.53125 2.28906V4.60573C7.53125 4.95573 7.25625 5.23906 6.90625 5.23906Z" fill="#A1A5B7"/>
                            <path d="M13.0937 5.23906C12.7437 5.23906 12.4688 4.95573 12.4688 4.61406V2.28906C12.4688 1.93906 12.7521 1.66406 13.0937 1.66406C13.4437 1.66406 13.7187 1.9474 13.7187 2.28906V4.60573C13.7187 4.95573 13.4437 5.23906 13.0937 5.23906Z" fill="#A1A5B7"/>
                            <path d="M12.3161 10.5938H6.13281C5.78281 10.5938 5.50781 10.3104 5.50781 9.96875C5.50781 9.62708 5.79115 9.34375 6.13281 9.34375H12.3161C12.6661 9.34375 12.9411 9.62708 12.9411 9.96875C12.9411 10.3104 12.6661 10.5938 12.3161 10.5938Z" fill="#A1A5B7"/>
                            <path d="M9.99948 13.6797H6.13281C5.78281 13.6797 5.50781 13.3964 5.50781 13.0547C5.50781 12.7047 5.79115 12.4297 6.13281 12.4297H9.99948C10.3495 12.4297 10.6245 12.713 10.6245 13.0547C10.6245 13.3964 10.3495 13.6797 9.99948 13.6797Z" fill="#A1A5B7"/>
                            <path d="M17.9172 13.1818C17.9172 13.3068 17.8755 13.4318 17.7672 13.5401C16.5589 14.7568 14.4089 16.9234 13.1755 18.1651C13.0672 18.2818 12.9255 18.3318 12.7839 18.3318C12.5089 18.3318 12.2422 18.1151 12.2422 17.7984V14.8818C12.2422 13.6651 13.2755 12.6568 14.5422 12.6568C15.3339 12.6484 16.4339 12.6484 17.3755 12.6484C17.7005 12.6484 17.9172 12.9068 17.9172 13.1818Z" fill="#A1A5B7"/>
                        </svg>
                        <span>Koreksi</span>
                        <span class="tbr_alert tbr_alert--light p-1 fw-semibold fs-8 sm">wajib</span>
                    </div>
                    <span class="accordion-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.90848 14.3705C9.79881 14.3711 9.69009 14.3501 9.58856 14.3086C9.48702 14.2671 9.39468 14.206 9.31681 14.1288L4.31681 9.12879C4.2387 9.05132 4.17671 8.95915 4.1344 8.8576C4.09209 8.75605 4.07031 8.64713 4.07031 8.53712C4.07031 8.42711 4.09209 8.31819 4.1344 8.21664C4.17671 8.11509 4.2387 8.02292 4.31681 7.94545C4.47295 7.79024 4.68416 7.70312 4.90431 7.70313C5.12447 7.70312 5.33568 7.79024 5.49181 7.94545L9.90848 12.3621L14.3168 7.94545C14.4729 7.79024 14.6842 7.70313 14.9043 7.70313C15.1245 7.70313 15.3357 7.79024 15.4918 7.94545C15.5699 8.02292 15.6319 8.11509 15.6742 8.21664C15.7165 8.31819 15.7383 8.42711 15.7383 8.53712C15.7383 8.64713 15.7165 8.75605 15.6742 8.8576C15.6319 8.95915 15.5699 9.05132 15.4918 9.12879L10.4918 14.1288C10.3366 14.2827 10.1271 14.3695 9.90848 14.3705Z" fill="#A1A5B7"/>
                        </svg>
                    </span>
                </div>
                <div id="accordion-${indexDynamicForm}" class="collapse">
                    <textarea class="tbr_form form-control" placeholder="Contoh: Maaf salah input jumlah stok..." name="correction[]" rows="3"></textarea>
                </div>
            </div>
        </td>
    </tr>
    `;
}

function logicCollapseAccordion() {
    let correctionInput = $("textarea[name='correction[]'");
    correctionInput.each((index, correction) => {
        let value = $(correction).val();
        let collapseParent = $(correction).parents(".collapse");
        let isExpand = collapseParent.hasClass("show");
        let accordion = collapseParent.siblings(".accordion-header");
        if (value.length > 0 && isExpand) {
            console.log(accordion);
            accordion.trigger("click");
        }
    });
}
