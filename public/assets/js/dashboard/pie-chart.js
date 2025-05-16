$(document).ready(function () {
    var chartElement = $("#kt_amcharts_3");

    var totalProjects = parseInt(chartElement.data("total-projects"));
    var holdProjects = parseInt(chartElement.data("hold-projects"));
    var inProgressProjects = parseInt(chartElement.data("in-progress-projects"));
    var doneProjects = parseInt(chartElement.data("done-projects"));
    var lateProjects = parseInt(chartElement.data("late-projects"));

    var projectData = [
        { category: "HOLD", value: holdProjects },
        { category: "IN PROGRESS", value: inProgressProjects },
        { category: "DONE", value: doneProjects },
        { category: "LATE", value: lateProjects }
    ];

    am5.ready(function () {
        var root = am5.Root.new("kt_amcharts_3");

        root.setThemes([am5themes_Animated.new(root)]);

            var title = root.container.children.push(
            am5.Label.new(root, {
                text: "Pie Chart Proyek",
                fontSize: 20,
                fontWeight: "700",
                x: 15,
                y: 15,
                centerY: 0,
                centerX: 0,
                fill: am5.color(0x000000)
            })
        );

        var chart = root.container.children.push(am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        }));

        var series = chart.series.push(am5percent.PieSeries.new(root, {
            alignLabels: true,
            calculateAggregates: true,
            valueField: "value",
            categoryField: "category"
        }));

        series.slices.template.setAll({
            strokeWidth: 3,
            stroke: am5.color(0xffffff)
        });

        var colors = {
            "HOLD": am5.color("#c0c0c0"),
            "IN PROGRESS": am5.color("#ff7c00"),
            "DONE": am5.color("#00ff5f"),
            "LATE": am5.color("#ff0000")
        };

        series.slices.template.adapters.add("fill", function (fill, target) {
            var category = target.dataItem.dataContext.category;
            return colors[category] || fill;
        });

        series.data.setAll(projectData);

        var legend = chart.children.push(am5.Legend.new(root, {
            centerX: am5.p50,
            x: am5.p50,
            marginTop: 15,
            marginBottom: 15
        }));

        legend.data.setAll(series.dataItems);

        series.appear(1000, 100);
    });
});
