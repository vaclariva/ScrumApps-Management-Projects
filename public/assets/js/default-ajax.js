$(".tbr_main_form").on("submit", function (e) {
    e.preventDefault();
    typeof customBeforeSendDefaultAjax == "function"
        ? customBeforeSendDefaultAjax()
        : null;
    var formEl = $(this);
    var submitButton = $(this).find("button[type=submit]");
    var submitButtonHtml = submitButton.html();
    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            submitButton.attr("disabled", "disabled");
            submitButton.html(
                `Memproses <span class="spinner-border spinner-border-sm text-white ms-2" role="status" aria-hidden="true"></span>`
            );
        },
        success: async function (res) {
            if (!formEl.attr("data-no-toast-success")) {
                showSuccessToast({ message: res?.message ?? "Success" });
            }

            invokeCallback({formEl: formEl, callback: "data-success-callback"})

            if (res?.redirect) {
                setTimeout(function () {
                    window.location.href = res.redirect;
                }, 1000);
            }
            submitButton.removeAttr("disabled");
            submitButton.html(submitButtonHtml);
        },
        error: function (xhr, status, error) {
            if (typeof xhr.responseJSON?.errors === "object") {
                errorList = xhr.responseJSON?.errors;
                if (!formEl.attr("data-no-toast-error")) {
                    showErrorToast({
                        message: xhr.responseJSON?.errors,
                        isMessageObject: true,
                    });
                }
            } else {
                errorList = xhr.responseJSON?.message;
                if (!formEl.attr("data-no-toast-error")) {
                    showErrorToast({
                        message: xhr.responseJSON?.message,
                        isMessageObject: false,
                    });
                }
            }

            let messageError = typeof errorList === "object"
                ? generateErrorList(errorList)
                : errorList;

            invokeCallback({ formEl: formEl, callback: "data-error-callback", param: messageError});

            submitButton.removeAttr("disabled");
            submitButton.html(submitButtonHtml);

            if (xhr.responseJSON?.status === "session_expired") {
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }

            if (xhr.responseJSON?.redirect) {
                setTimeout(function () {
                    window.location.href = xhr.responseJSON?.redirect;
                }, 1000);
            }
        },
        complete: function () {
            invokeCallback({ formEl: formEl, callback: "data-complete-callback" });
        },
    });
});

function invokeCallback({formEl, callback, param = null}){
   if (
       formEl.attr(callback) &&
       typeof window[formEl.attr(callback)] == "function"
   ) {
       window[formEl.attr(callback)](param);
   }
}
