/* alert */

function alert(text, kind) {
    if (!kind) {
        $('#normal-alert').find('.alert').addClass('alert-info');
    } else {
        $('#normal-alert').find('.alert').addClass('alert-'+kind);
    }
    $('#normal-alert').find('.alert-content').text(text);
    $('#normal-alert').fadeIn();
    setTimeout(function() {
        $('#normal-alert').slideUp();
    }, 1000);
}

jQuery.fn.extend({
    toggleText: function (a, b){
        var isClicked = false;
        var that = this;
        this.click(function (){
            if (isClicked) { that.text(a); isClicked = false; }
            else { that.text(b); isClicked = true; }
        });
        return this;
    }
});