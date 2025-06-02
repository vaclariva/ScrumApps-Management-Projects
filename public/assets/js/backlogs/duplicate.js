function duplicateBacklog(id) {
    event.preventDefault(); // mencegah default action dari link

    $.ajax({
        url: `/backlogs/${id}/duplicate`,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
        },
    });
}
