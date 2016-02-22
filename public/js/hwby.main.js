$(function() {
    if ($('.datepicker').length > 0) {
        $('.datepicker').datepicker();
    }
    if ($(".i-checks").length > 0) {
        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",})
    }
});