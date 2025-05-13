$(document).ready(function () {
    // 1. Uncheck semua checkbox filter
    $(".tbr_filter--wrapper input[type=checkbox]").prop("checked", false);

    // 2. Kosongkan semua input text atau date range picker
    $(".tbr_filter--wrapper input[type=text], .tbr_filter--wrapper input[type=date]").val("");

    // 3. Reset data-data yang ada di data attribute daterangepicker
    $(".tbr_daterangepicker").each(function () {
        $(this).removeData("start-date").removeData("end-date");
    });

    // 4. Hapus semua result filter yang tampil
    $(".tbr_filter--result-item").remove();

    // 5. Sembunyikan tombol Clear Filter dan area hasil filter
    $(".tbr_filter--result").each(function () {
        $(this).siblings("a[type=button]").addClass("d-none");
        $(this).parent().addClass("d-none");
    });

    // 6. Sembunyikan tombol "Lebih Banyak" kalau ada
    $(".tbr_filter--result-more").addClass("d-none");

    // 7. Reload datatable agar benar-benar bersih filternya
    if (typeof myDatatable !== "undefined") {
        myDatatable.ajax.reload(); // sesuaikan nama instance jika berbeda
    }
});

$(function () {
    // Listen search filter
    $("[data-tbr-search=true]").on("keyup", $.debounce(1000,function (e) {
        let searchValue = $(this).val().toLowerCase();
        let searchResultParent = $(this)
            .parent()
            .siblings(".tbr_search--result");
        let allInput = searchResultParent.find("input");
        let totalSearch = 0;
        allInput.each((index, element) => {
            let valueEl = $(element).attr("value").toLowerCase();
            if (valueEl.includes(searchValue)) {
                $(element).closest(".tbr_input--parent").removeClass("d-none");
                totalSearch++;
            } else {
                $(element).closest(".tbr_input--parent").addClass("d-none");
            }
        });
        if (totalSearch == 0) {
            searchResultParent.find(".tbr_search--empty").removeClass("d-none");
        } else {
            searchResultParent.find(".tbr_search--empty").addClass("d-none");
        }
    }));

    // Listen search with load more filter
    $("[data-tbr-search-more=true]").on("keyup", $.debounce(1000, function (e) {
        let searchValue = $(this).val().toLowerCase();
        let searchResultParent = $(this)
            .parent()
            .siblings(".tbr_search--result");
        let allInput = searchResultParent.find("input");
        let totalSearch = 0;
        let loadMoreEl = searchResultParent.find(".tbr_search--more");
        allInput.each((_, element) => {
            let valueEl = $(element).siblings('span').text().toLowerCase();
            if (valueEl.includes(searchValue)) {
                if(totalSearch < 10){
                    $(element).closest(".tbr_input--parent").removeClass("d-none").removeClass('in-load-more');
                }
                else{
                    $(element).closest(".tbr_input--parent").addClass('d-none').addClass('in-load-more');
                }
                totalSearch++;
            } else {
                $(element)
                    .closest(".tbr_input--parent")
                    .addClass("d-none")
                    .removeClass("in-load-more");
            }
        });
        if (totalSearch == 0) {
            searchResultParent.find(".tbr_search--empty").removeClass("d-none");
            loadMoreEl.addClass('d-none');
        } else {
            searchResultParent.find(".tbr_search--empty").addClass("d-none");
        }

        if(totalSearch > 10){
            loadMoreEl.removeClass("d-none");
        }
        else{
            loadMoreEl.addClass("d-none");
        }
    }));

    // Listen checkbox checked
    $(document).on("change", ".tbr_search--result input[type=checkbox]", function (e) {
        let isChecked = $(this).is(":checked");
        let dropdownParent = $(this).parents(".dropdown-menu");
        let parentTabId = $(this).closest(".tab-pane").attr('id');
        countBadgeFilter({isChecked: isChecked, dropdownParent: dropdownParent, parentTabId: parentTabId});
    });

    // Init Daterangepicker
    $(".tbr_daterangepicker")
        .daterangepicker({
            autoUpdateInput: false,
            autoApply: true,
            locale: {
                daysOfWeek: ["Mi", "Sn", "Sl", "Rb", "Km", "Jm", "Sa"],
                monthNames: [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember",
                ],
            },
        })
        .on("apply.daterangepicker", function (ev, picker) {
            let isChecked = $(this).val() === "";
            if (isChecked) {
                let dropdownParent = $(this).parents(".dropdown-menu");
                let parentTabId = $(this).closest(".tab-pane").attr("id");
                countBadgeFilter({
                    isChecked: isChecked,
                    dropdownParent: dropdownParent,
                    parentTabId: parentTabId,
                });
            }
            let startDate = moment(picker.startDate)
                .locale("id")
                .format("DD MMMM YYYY");
            let endDate = moment(picker.endDate)
                .locale("id")
                .format("DD MMMM YYYY");
            $(this).val(startDate + " - " + endDate);
        })
        .on("cancel.daterangepicker", function (ev, picker) {
            $(this).val("");
            let dropdownParent = $(this).parents(".dropdown-menu");
            let parentTabId = $(this).closest(".tab-pane").attr("id");
            countBadgeFilter({
                isChecked: false,
                dropdownParent: dropdownParent,
                parentTabId: parentTabId,
            });
            $(this).data("start-date", "");
            $(this).data("end-date", "");
        })
        .click(function (e) {
            $("div.daterangepicker").click(function (e) {
                e.stopPropagation();
            });
        });;

});

function clearFilter({el}){
    let allInput = $(el).parents(".dropdown-menu").find(".tbr_filter--right input");
    allInput.each((index, element) => {
        // check setiap input type
        if ($(element).attr("type") == "checkbox") {
            $(element).prop("checked", false).trigger('change');
        }
        // check daterange filter
        else if($(element).hasClass('tbr_daterangepicker')){
            var drp = $(element).data("daterangepicker");
            drp.clickCancel();
        }
    });
    let btnApply = $(el).parent().find('.tbr_filter--apply');
    applyFilter({el:btnApply});
}

function applyFilter({el}){
    let filterId = $(el).parents(".tbr_filter--wrapper").attr("id");
    let filterResultParent = $(`[data-for-result=${filterId}]`).find(".tbr_filter--result");
    let resultMore = filterResultParent.find('.tbr_filter--result-more');
    filterResultParent.find('.tbr_filter--result-item').remove();
    let allInput = $(el)
        .parents(".dropdown-menu")
        .find(".tbr_filter--right input");
    let totalFilter = 0;
    allInput.each((index, element) => {
        let parentTabId = $(element).parents(".tab-pane").attr("id");
        let tabText = $(`[data-bs-target="#${parentTabId}"]`).find("span").first().text();
        // check setiap input type
        if($(element).attr("type") == "checkbox" && $(element).is(":checked")){
            totalFilter++;
            filterResultParent.append(
                generateFilterResult({
                    key: tabText,
                    text: $(element).data("text"),
                    value: $(element).val(),
                    inputName: $(element).attr("name"),
                    inLoadMore: totalFilter > 7,
                    isShow: totalFilter < 8 || resultMore.text() == "Lebih Sedikit",
                })
            );
        }
        else if($(element).hasClass('tbr_daterangepicker') && $(element).val() != ""){
            totalFilter++;
            let picker = $(element).data("daterangepicker");
            $(element).data(
                "start-date",
                moment(picker.startDate).locale("id").format("YYYY-MM-DD")
            );
            $(element).data(
                "end-date",
                moment(picker.endDate).locale("id").format("YYYY-MM-DD")
            );
            filterResultParent.append(
                generateFilterResult({
                    key: tabText,
                    text: $(element).val(),
                    value: $(element).val(),
                    inputName: $(element).attr("name"),
                    inLoadMore: totalFilter > 6,
                    isShow: totalFilter < 7 || resultMore.text() == "Lebih Sedikit",
                })
            );
        }
    });

    if(totalFilter > 7){
        resultMore.removeClass('d-none').css('order', totalFilter);
    }
    else{
        resultMore.addClass("d-none");
    }

    if(totalFilter > 0){
        filterResultParent.siblings('a[type=button]').removeClass('d-none');
        filterResultParent.parent().removeClass('d-none');
    }
    else{
        filterResultParent.siblings("a[type=button]").addClass("d-none");
        filterResultParent.parent().addClass("d-none");
    }
    $(".tbr_backdrop").trigger("click");
    // reload datatable
    window[$(el).data("dt")].ajax.reload();
    $(`#${filterId}`).trigger("AppliedFilterEvent");
}

function loadMoreFilter({ el }) {
    let allInputHidden = $(el)
        .closest(".tbr_search--result")
        .find(".tbr_input--parent.d-none.in-load-more");
    let totalHidden = allInputHidden.length;
    if (totalHidden > 10) {
        for (let index = 0; index < 10; index++) {
            $(allInputHidden[index]).removeClass("d-none");
        }
    } else {
        for (let index = 0; index < totalHidden; index++) {
            $(allInputHidden[index]).removeClass("d-none");
        }
        $(el).parent().addClass('d-none');
    }
}

function countBadgeFilter({isChecked, dropdownParent, parentTabId}){
    let buttonFilterBadge = dropdownParent
        .siblings("button")
        .find(".tbr_filter--badge");
    let badge = $(`[data-bs-target="#${parentTabId}"]`).find(
        ".tbr_filter--badge"
    );
    let totalBadgeDropdown = buttonFilterBadge.text();
    let totalBadge = badge.text();
    if (isChecked) {
        totalBadgeDropdown++;
        totalBadge++;
    } else {
        if(totalBadge > 0){
            totalBadge--;
        }
        if(totalBadgeDropdown > 0){
            totalBadgeDropdown--;
        }
    }
    buttonFilterBadge.text(totalBadgeDropdown);
    badge.text(totalBadge);

    if (totalBadge == 0) {
        badge.fadeOut();
    } else {
        badge.fadeIn();
    }

    let btnFilterApply = dropdownParent.find(".tbr_filter--apply");

    if (totalBadgeDropdown == 0) {
        btnFilterApply.prop('disabled', true);
        buttonFilterBadge.fadeOut();
    } else {
        btnFilterApply.prop('disabled', false);
        buttonFilterBadge.fadeIn();
    }
}

function loadMoreFilterResult({el}){
    let filterResultParent = $(el).closest(".tbr_filter--result");
    let allMoreResult = filterResultParent.find(".tbr_filter--result-item.in-load-more");
    let conditionalText = $(el).text();
    if(conditionalText == 'Lebih Banyak'){
        $(el).text('Lebih Sedikit');
        allMoreResult.each((index, element)=>{
            $(element).removeClass('d-none');
        })
    }
    else{
        $(el).text("Lebih Banyak");
        allMoreResult.each((index, element) => {
            $(element).addClass("d-none");
        });
    }
}

function deleteFilterResult({ el, inputName, value }) {
    let input = $(`input[name="${inputName}"]`);

    if (inputName != "date") {
        input = $(`input[name="${inputName}"][value="${value}"]`);
    }

    // check type input
    if ($(input).attr("type") == "checkbox") {
        input.prop("checked", false);
        input.trigger("change");
    } else if ($(input).hasClass("tbr_daterangepicker")) {
        let drp = $(input).data("daterangepicker");
        drp.clickCancel();
    }

    let btnApply = input.parents(".dropdown-menu").find(".tbr_filter--apply");
    btnApply.trigger("click");
}

function clearFilterOutside({ el }) {
    let filterId = $(el).parent().data("for-result");
    let clearButton = $(`#${filterId}`)
        .find(".dropdown-menu")
        .find(".tbr_filter--clear-all");
    clearButton.trigger('click');
}

function cancelFilter({el}){
    $(".tbr_backdrop").trigger("click");
}

function generateFilterResult({ key, text, value, inputName, inLoadMore, isShow }) {
    return `
        <div class="tbr_filter--result-item ${isShow ? "" : "d-none"} ${inLoadMore ? "in-load-more" : ""}">
            <span class="key me-2">${key}</span>
            <span class="value me-4">${text}</span>
            <a type="button" onclick="deleteFilterResult({el:this, inputName: '${inputName}', value: '${value}'})">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.72125 9.64472C9.54434 9.82026 9.30502 9.91878 9.05557 9.91878C8.80612 9.91878 8.5668 9.82026 8.38989 9.64472L0.326176 1.69046C0.237675 1.60285 0.16743 1.49861 0.119492 1.38376C0.0715552 1.26892 0.046875 1.14574 0.046875 1.02132C0.046875 0.896906 0.0715552 0.773723 0.119492 0.658877C0.16743 0.544031 0.237675 0.439795 0.326176 0.352182C0.503089 0.17665 0.742405 0.078125 0.991857 0.078125C1.24131 0.078125 1.48063 0.17665 1.65754 0.352182L9.72125 8.30645C9.80975 8.39406 9.87999 8.4983 9.92793 8.61314C9.97587 8.72799 10.0006 8.85117 10.0006 8.97559C10.0006 9.1 9.97587 9.22318 9.92793 9.33803C9.87999 9.45288 9.80975 9.55711 9.72125 9.64472Z" fill="#A1A5B7"/>
                    <path opacity="0.3" d="M1.65743 9.71224C1.47713 9.89471 1.23158 9.99821 0.974822 9.99998C0.71806 10.0017 0.471111 9.90163 0.288301 9.72167C0.10549 9.5417 0.00179383 9.29662 2.30546e-05 9.04034C-0.00174772 8.78407 0.0985522 8.53758 0.278858 8.35512L8.34257 0.287757C8.52287 0.105292 8.76841 0.00179044 9.02518 2.30111e-05C9.28194 -0.00174442 9.52889 0.0983665 9.7117 0.278333C9.89451 0.458299 9.99821 0.703378 9.99998 0.959656C10.0017 1.21593 9.90145 1.46242 9.72114 1.64488L1.65743 9.71224Z" fill="#A1A5B7"/>
                </svg>
            </a>
        </div>
    `;
}
