/**
 * Show a success toast message with the given message.
 *
 * @param {string} message - The message to display in the toast
 * @return {void}
 */
function showSuccessToast({ message }) {
    toastr.options = {
        closeButton: true,
        closeHtml: `<button><svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.1203 19.0446C18.9095 19.2542 18.6244 19.3718 18.3271 19.3718C18.0299 19.3718 17.7448 19.2542 17.534 19.0446L7.92652 9.54964C7.82108 9.44506 7.73738 9.32063 7.68027 9.18354C7.62316 9.04645 7.59375 8.89941 7.59375 8.75089C7.59375 8.60238 7.62316 8.45533 7.68027 8.31824C7.73738 8.18115 7.82108 8.05673 7.92652 7.95214C8.13731 7.74261 8.42244 7.625 8.71965 7.625C9.01686 7.625 9.30199 7.74261 9.51277 7.95214L19.1203 17.4471C19.2257 17.5517 19.3094 17.6762 19.3665 17.8132C19.4236 17.9503 19.453 18.0974 19.453 18.2459C19.453 18.3944 19.4236 18.5414 19.3665 18.6785C19.3094 18.8156 19.2257 18.9401 19.1203 19.0446Z" fill="white"/>
                        <path opacity="0.3" d="M9.51381 19.1247C9.29898 19.3426 9.00643 19.4661 8.70051 19.4682C8.39459 19.4703 8.10037 19.3508 7.88256 19.136C7.66475 18.9212 7.5412 18.6286 7.53909 18.3227C7.53698 18.0168 7.65648 17.7226 7.87131 17.5047L17.4788 7.87475C17.6936 7.65694 17.9862 7.53339 18.2921 7.53128C18.598 7.52917 18.8922 7.64867 19.1101 7.8635C19.3279 8.07832 19.4514 8.37087 19.4535 8.67679C19.4556 8.98271 19.3361 9.27694 19.1213 9.49475L9.51381 19.1247Z" fill="white"/>
                        </svg>
                    </button>`,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toastr-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    toastr.success(message, "Berhasil");
}

/**
 * Show an error message using toastr.
 *
 * @param {string | object} message - The error message to display, or an object
 * containing error messages.
 * @param {boolean} isMessageObject - Indicates if the message is an object.
 */
function showErrorToast({ message, isMessageObject = false }) {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toastr-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "8000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    if (isMessageObject) {
        errorList = generateErrorList(message);
        toastr.error(errorList, "Gagal");
    } else {
        toastr.error(message, "Gagal");
    }
}

function generateErrorList(message) {
    let errorList = "";
    $.each(message, function (key, value) {
        if (value.length > 1) {
            $.each(value, function (key, value) {
                errorList += value + "<br/>";
            });
        } else {
            errorList += value + "<br/>";
        }
    });
    return errorList;
}
