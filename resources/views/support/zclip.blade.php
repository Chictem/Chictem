<div id="support-zclip">
    {!! Html::script('/js/plugins/jquery.zclip.min.js') !!}
    <script>
        $(function() {
            $(".zclip").zclip({
                path: '/swf/ZeroClipboard.swf',
                copy: function(){
                    return $($(this).attr('target')).val();
                },
                afterCopy: function(){
                    $('.copy-msg').show().fadeOut(2000);
                }
            });
        });
    </script>
</div>