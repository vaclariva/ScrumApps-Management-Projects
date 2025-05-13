$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
  },
  error: function (xhr, status, error) {
    if (xhr.status === 0) {
      alert(
        "No internet connection or the request was blocked. Please check your connection."
      );
    }
  },
});
