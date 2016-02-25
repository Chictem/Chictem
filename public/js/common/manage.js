var $array_form = $('.array-form');
$(function(){
    $array_form.on('click', '.rm-row', function() {
       $(this).closest('.row').remove();
    });
});