$(document).ready(function () {
    const iconList = [
        "ki-duotone ki-graph-3", "ki-duotone ki-abstract-33", "ki-duotone ki-star",
        "ki-duotone ki-book-open", "ki-duotone ki-bulb", "ki-duotone ki-briefcase"
    ];

    $('.icon-picker-group').each(function () {
        const group = $(this);
        const grid = group.find('.icon-picker-grid');
        const search = group.find('.icon-picker-search');
        const hiddenInput = group.find('.icon-picker-input');
        const selectedIcon = group.find('.selected-icon');

        function renderIcons(filter = "") {
            grid.empty();
            const filteredIcons = iconList.filter(icon => icon.includes(filter.toLowerCase()));
            $.each(filteredIcons, function (_, iconClass) {
                const btn = $(`<button type="button" class="btn btn-light btn-icon"></button>`);
                btn.html(`<i class="${iconClass} text-gray-500 fs-2"><span class="path1"></span><span class="path2"></span></i>`);
                btn.on('click', function () {
                    selectedIcon.attr('class', `${iconClass} text-gray-500 fs-1 selected-icon`);
                    hiddenInput.val(iconClass);
                });
                grid.append(btn);
            });
        }

        renderIcons();

        search.on('input', function () {
            renderIcons($(this).val());
        });
    });
});
