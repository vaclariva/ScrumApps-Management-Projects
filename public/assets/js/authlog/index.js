$(function () {
    const dtAuthLog = initDatatable({
        tableId: "table-authlog",
        url: urlDatatable,
        columns: [
            {
                name: "DT_RowIndex",
                data: "DT_RowIndex",
                searchable: false,
                orderable: false,
            },
            {
                name: "email",
                data: "email",
            },
            {
                name: "user_agent",
                data: "user_agent",
            },
            {
                name: "os",
                data: "os",
            },
            {
                name: "duration",
                data: "duration",
            },
            {
                name: "last_seen",
                data: "last_seen",
		orderable: false
            },
            {
                name: "login_at",
                data: "login_at",
            },
            {
                name: "logout_at",
                data: "logout_at",
            },
            {
                name: "login_status",
                data: "login_status",
            },
        ],
    });
});
