var $array_form = $('.array-form');
$(function() {
    $array_form.on('click', '.rm-row', function() {
        $(this).closest('.row').remove();
    }).on('click', '.add-row', function() {
        var row = $(this).closest('.array-value').find('.row:first-child').clone();
        row.find('input').val('');
        row.insertBefore($(this).closest('.row'));
    });
});