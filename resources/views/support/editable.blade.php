<div id="support-editable">
    {!! Html::style('/css/plugins/editable/bootstrap-editable.css') !!}
    {!! Html::style('/css/plugins/select2/select2.css') !!}
    {!! Html::script('/js/plugins/select2/select2.js') !!}
    {!! Html::script('/js/plugins/editable/moment.min.js') !!}
    {!! Html::script('/js/plugins/editable/bootstrap-editable.min.js') !!}
    <script>
        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.params = function(params) {
            params._token = '{{ csrf_token() }}';
            return params;
        }
        $.fn.editable.defaults.error = function(response) {
            if (response.status > 500) {
                return '服务器错误';
            } else if (response.status > 400) {
                return '修改失败';
            }
        }
    </script>
</div>
