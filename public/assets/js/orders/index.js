const tableVertical = $("#table-orders-vertical");
const widgetLoader = $('.widget-loader');
const widgetTitle = $(".tbr_widget--title");
const filter = $("#filter-orders-id");
const search = $("#table-orders-search");

function dtDrawCallback(){
    $('[data-bs-toggle="tooltip"]').tooltip();
    if(tableVertical.find('td').length > 0){
        tableVertical.removeClass('empty');
        hideElement({ el: tableVertical.siblings("#no-data") });
        let bodyWidth = $('.card-body').width();
        let widthLast = {
            'width' : bodyWidth,
            'min-width' : bodyWidth,
            'max-width' : bodyWidth,
        }
        tableVertical.find('tr[data-for="no"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="so_number"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="partner_name"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="product_order_type"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="grand_total"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="payment"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="delivery"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="status"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="user_name"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="ordered_at"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="updated_at"] td').last().css(widthLast);
        tableVertical.find('tr[data-for="actions"] td').last().css(widthLast);
    }
    else{
        tableVertical.addClass('empty');
        showElement({ el: tableVertical.siblings("#no-data") });
    }
}

function dtPreDrawCallback(){
    tableVertical.find('td').remove();
}

function dtRawCallback(row, data){
    tableVertical.find('tr[data-for="no"]').append(`<td><div><span>${data.DT_RowIndex}</span></div></td>`);
    tableVertical.find('tr[data-for="so_number"]').append(`<td><div><span>${data.so_number}</span></div></td>`);
    tableVertical.find('tr[data-for="partner_name"]').append(`<td><div><span>${data.partner_name}</span></div></td>`);
    tableVertical.find('tr[data-for="product_order_type"]').append(`<td><div><span>${data.product_order_type}</span></div></td>`);
    tableVertical.find('tr[data-for="grand_total"]').append(`<td><div><span>${data.grand_total}</span></div></td>`);
    tableVertical.find('tr[data-for="payment"]').append(`<td><div><span>${data.payment}</span></div></td>`);
    tableVertical.find('tr[data-for="delivery"]').append(`<td><div><span>${data.delivery}</span></div></td>`);
    tableVertical.find('tr[data-for="status"]').append(`<td><div><span>${data.status}</span></div></td>`);
    tableVertical.find('tr[data-for="user_name"]').append(`<td><div><span>${data.user_name}</span></div></td>`);
    tableVertical.find('tr[data-for="ordered_at"]').append(`<td><div><span>${data.ordered_at}</span></div></td>`);
    tableVertical.find('tr[data-for="updated_at"]').append(`<td><div><span>${data.updated_at}</span></div></td>`);
    tableVertical.find('tr[data-for="actions"]').append(`<td><div><span>${data.actions}</span></div></td>`);
}

$(function () {
    activeSidebarTree({ id: "#sidebar-selling-order" });
    let isDesktop = $('body').width() > 768;
    dtOrders = initDatatable({
        tableId: "table-orders",
        url: urlDatatable,
        data: dataDatatable,
        dtPreDrawCallbackFunctionName: dtPreDrawCallback,
        dtDrawCallbackFunctionName: dtDrawCallback,
        dtRowCallbackFunctionName: dtRawCallback,
        freezeLeftColumns: isDesktop ? 2 : 0,
        columns: [
            {
                name: "DT_RowIndex",
                data: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                name: 'so_number',
                data: 'so_number'
            },
            {
                name: 'partner_name',
                data: 'partner_name',
            },
            {
                name: 'product_order_type',
                data: 'product_order_type'
            },
            {
                name: 'grand_total',
                data: 'grand_total'
            },
            {
                name: 'payment',
                data: 'payment'
            },
            {
                name: 'delivery',
                data: 'delivery'
            },
            {
                name: 'status',
                data: 'status'
            },
            {
                name: 'user_name',
                data: 'user_name'
            },
            {
                name: 'ordered_at',
                data: 'ordered_at'
            },
            {
                name: 'updated_at',
                data: 'updated_at'
            },
            {
                name: 'actions',
                data: 'actions'
            },
        ],
    });

    // Listen search input
    search.on("keyup",
        $.debounce(1000, function () {
            getWidgetData();
        })
    );

    // Listen filter change
    filter.on("AppliedFilterEvent", function () {
        getWidgetData();
    });

    var drp = $(".tbr_daterangepicker").data('daterangepicker');
    drp.setStartDate(moment().startOf('year'));
    drp.setEndDate(moment());
    var picker = {
        startDate: moment().startOf("year"),
        endDate: moment(),
    };

    $(".tbr_daterangepicker").trigger('apply.daterangepicker', [picker]);
    $(".tbr_filter--apply").trigger('click');
    getWidgetData();
});

function getWidgetData(){
    $.ajax({
        url: urlWidget,
        type: "GET",
        data: {
            startDate: getAppliedFilterDate({
                id: "#date",
                dataName: "start-date",
            }),
            endDate: getAppliedFilterDate({
                id: "#date",
                dataName: "end-date",
            }),
            type: getCheckboxChecked({ name: "type" }),
            payment: getCheckboxChecked({ name: "payment" }),
            delivery: getCheckboxChecked({ name: "delivery" }),
            status: getCheckboxChecked({ name: "status" }),
            search: $("#table-orders-search").val(),
        },
        beforeSend: function () {
            hideElement({ el: widgetTitle });
            showElement({ el: widgetLoader });
            widgetTitle.text('-');
        },
        success: function (res) {
            $('#total-order').text(res.total_order ?? 0);
            $('#total-order-processing').text(res.total_order_processing ?? 0);
            $('#total-order-packaged').text(res.total_order_packaged ?? 0);
            $("#total-payment-waiting").text(res.total_payment_waiting ?? 0);
            $("#order-grand-total").text(rupiah(res.order_grand_total ?? 0));
        },
        error: function(xhr, status, error) {
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
            hideElement({ el: widgetLoader });
            showElement({ el: widgetTitle });
        },
    });
}
