$(function () {
    activeSidebarTree({ id: "#sidebar-developments" });
});

"use strict";

// Class definition
var KTJKanbanDemoColor = function() {
    // Private functions
    var exampleColor = function() {
        var kanban = new jKanban({
            element: '#kt_docs_jkanban_color',
            gutter: '0',
            widthBoard: '370px',
            boards: [{
                    'id': '_todo',
                    'title': 'To Do',
                    'class': 'primary',
                    'item': [{
                            'title': '<span class="fw-bold">You can drag me too</span>',
                        },
                        {
                            'title': '<span class="fw-bold">Buy Milk</span>',
                        }
                    ]
                }, {
                    'id': '_inprocess',
                    'title': 'In Process',
                    'class': 'warning',
                    'item': [{
                            'title': '<span class="fw-bold">You can drag me too</span>',
                            'class': 'light-warning',
                        },
                        {
                            'title': '<span class="fw-bold">Buy Milk</span>',
                            'class': 'light-warning',
                        }
                    ]
                }, {
                    'id': '_working',
                    'title': 'Working',
                    'class': 'info',
                    'item': [{
                            'title': '<span class="fw-bold">Do Something!</span>',
                            'class': 'light-info',
                        },
                        {
                            'title': '<span class="fw-bold">Run?</span>',
                            'class': 'light-info',
                        }
                    ]
                }, {
                    'id': '_done',
                    'title': 'Done',
                    'class': 'success',
                    'item': [{
                            'title': '<span class="fw-bold">All right</span>',
                            'class': 'light-success',
                        },
                        {
                            'title': '<span class="fw-bold">Ok!</span>',
                            'class': 'light-success',
                        }
                    ]
                }
            ]
        });
    }

    return {
        // Public Functions
        init: function() {
            exampleColor();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTJKanbanDemoColor.init();
});
