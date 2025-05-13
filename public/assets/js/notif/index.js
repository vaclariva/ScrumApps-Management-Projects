function readNotif({ el }) {
    let form = $(el).closest("form");
    let actionUrl = form.attr("action");

    $(el).find(".loader").removeClass("d-none");
    $(el).attr("disabled", true);

    $.ajax({
        url: actionUrl,
        method: "POST",
        data: form.serialize(),
        success: function (response) {
            console.log(response.message);

            form.remove();

            let badge = $("#notification-trigger .notif-badge");
            let newCount = response.unreadCount;

            if (newCount > 0) {
                if (badge.length) {
                    badge.html(`<span class="text-white">${newCount}</span>`);
                } else {
                    $("#notification-trigger").append(`
                        <span class="notif-badge position-absolute">
                            <span class="text-white">${newCount}</span>
                        </span>
                    `);
                }
            } else {
                badge.remove();
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        },
        complete: function () {
            $(el).removeAttr("disabled");
            $(el).find(".loader").addClass("d-none");
        }
    });
}
