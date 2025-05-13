/**
 * Function to handle the default delete operation.
 *
 * @param {string} url - The URL to send the DELETE request to.
 */
function defaultDelete(url) {
    var modalCreate = new bootstrap.Modal(
        document.getElementById("tbr_modal_delete"),
        {
            keyboard: false,
        }
    );

    var myModalEl = document.getElementById("tbr_modal_delete");

    modalCreate.show();

    myModalEl.addEventListener("shown.bs.modal", function (event) {
        $(myModalEl)
            .find("#tbr_confirm_delete")
            .off()
            .on("click", function (event) {
                event.preventDefault();
                const createButton = $(this);
                const buttonText = createButton.html();
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                        _token: $("meta[name=csrf-token]").attr("content"),
                    },
                    beforeSend: function () {
                        createButton.prop("disabled", true);
                        createButton.html(
                            `Memproses <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
                        );
                    },
                    success: function (res) {
                        showSuccessToast({
                            message: res?.message ?? "Success",
                        });
                        if (res?.redirect) {
                            setTimeout(function () {
                                window.location.href = res.redirect;
                            }, 1000);
                        }
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

                        createButton.prop("disabled", false);
                        createButton.html(buttonText);
                        if (res.responseJSON?.status === "session_expired") {
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                });
            });
    });
}
