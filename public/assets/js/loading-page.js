// public/assets/js/loading-page.js

// Tampilkan loading page
function showPageLoader() {
    const loader = document.querySelector(".page-loader");
    if (loader) {
        loader.classList.remove("hidden");
        KTApp.showPageLoading(); // Optional: Metronic helper
    }
}

// Sembunyikan loading page
function hidePageLoader() {
    const loader = document.querySelector(".page-loader");
    if (loader) {
        KTApp.hidePageLoading(); // Optional: Metronic helper
        loader.classList.add("hidden");
    }
}

// Tampilkan loader saat halaman pertama dimuat
document.addEventListener("DOMContentLoaded", function () {
    showPageLoader();
    // Jangan hide di sini, biarkan loader sampai semua resource selesai
});

window.addEventListener("load", function () {
    hidePageLoader();
});

// Tampilkan loader saat tombol tertentu diklik (opsional)
var button = document.querySelector("#kt_page_loading_basic");
if (button) {
    button.addEventListener("click", function () {
        const dynamicLoader = document.createElement("div");
        dynamicLoader.classList.add("page-loader");
        dynamicLoader.innerHTML = `
            <span class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </span>
        `;
        document.body.appendChild(dynamicLoader);
        showPageLoader();

        setTimeout(() => {
            hidePageLoader();
            dynamicLoader.remove();
        }, 3000);
    });
}

// Opsional: Loading saat klik <a>
document.querySelectorAll("a").forEach(link => {
    link.addEventListener("click", function (e) {
        const href = link.getAttribute("href");

        // Kecualikan link eksternal, anchor, javascript:void(0), dsb.
        if (
            link.target === "_blank" ||
            link.hasAttribute("download") ||
            !href || href.startsWith("#") || href.startsWith("javascript:")
        ) return;

        showPageLoader();
    });
});
