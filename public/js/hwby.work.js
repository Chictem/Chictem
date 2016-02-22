$(function() {
    function adjustVideo() {
        var width = $('#work-video').width();
        $('#work-video embed,video,iframe').css({
            'width': width + 'px',
            'height': width * 9 / 16 + 'px',
        })
    }

    $('#select-platform input').on('change', function() {
        $.ajax({
            type: 'POST',
            url: '/work/get-publish-link',
            data: {
                '_token': $('input[name = "_token"]').val(),
                'id': $('input[name = "work_id"]').val(),
                'platform': $('input:checked').val(),
            },
            success: function(data) {
                $('#work-video').html(data);
                adjustVideo();
            },
            error: function(error) {
                alert(error);
            }
        });
    });
    $('#select-platform input:eq(0)').trigger('click');
    adjustVideo();
    $(window).resize(function() {
        adjustVideo();
    });
});