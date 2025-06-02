$(document).ready(function () {
    $('.duplicate-button').on('click', function (e) {
        e.preventDefault();
        const id = $(this).data('id');

        $.ajax({
            url: `/vision-boards/${id}/duplicate`,
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
    });
});
