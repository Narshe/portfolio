(window).$ = require('jquery');
require("font-awesome-webpack");
require('bootstrap-datepicker');

$(function() {

    $('#add').on('click', function() {

        let $files = $('.file>input');
        let $element = $('<input>', {
            class: 'form-control file' + $files.length,
            name: 'files[]',
            type: 'file'
        });


        if ($("input[type='file']").length > 0) {
            $("input[type='file']:last").after($element)
        } else {
            $(".file .file-buttons").after($element)
        }


    });

    $('#remove').on('click', function(e) {

        if ($("input[type='file']").length > 1) {
            $("input[type='file']:last").remove();
        }
    });

    $('input.date').datepicker({
        format: "yyyy-mm-dd",
        language: "fr",
        orientation: "bottom auto"
    });
});
