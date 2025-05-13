function activeSidebar({ id }) {
    $(id).addClass("active");
}

function activeSidebarTree({ id }) {
    let parentAccordion = $(id).closest(".menu-item.menu-accordion");

    parentAccordion.addClass("show");
    let treeRoad = parentAccordion.find(".tbr_tree--road");
    let heightRoad = $(id).find(".menu-tree")[0].style.height;
    setTimeout(() => {
        treeRoad.css("height", heightRoad).addClass("active");
    }, 1000);
    setTimeout(() => {
        $(id).addClass("active");
    }, 1300);
}

$(function () {
    const sidebarMenuAccordion = $(
        "#kt_app_sidebar_menu .menu-item.menu-accordion"
    );

    sidebarMenuAccordion.each((index, el) => {
        const menuTrees = $(el).find(".menu-item .menu-tree");
        /* 22px, 63px, 105px */
        let initHeight = 22;
        menuTrees.each((index, el) => {
            $(el).css("height", initHeight + "px");
            initHeight += 40;
        });
    });
});
