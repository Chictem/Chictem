var $array_form = $('.array-form');
var $option_form = $('.option-form');
$(function() {
    $array_form.on('click', '.rm-row', function() {
        $(this).closest('.row').remove();
    }).on('click', '.add-row', function() {
        var row = $(this).closest('.array-value').find('.row:first-child').clone();
        row.find('input').val('');
        row.insertBefore($(this).closest('.row'));
    }).on('click', '.delete-item', function() {
        var $delete_btn = $(this);
        swalert('确认要删除吗?', '删除后无法恢复', 'warning', function() {
            location.href = $delete_btn.attr('target');
        });
    });
    $option_form.on('click', '.delete-item', function() {
        var $delete_btn = $(this);
        swalert('确认要删除吗?', '删除后无法恢复', 'warning', function() {
            location.href = $delete_btn.attr('target');
        });
    });
    if ($(".i-checks").length > 0) {
        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",})
    }
});