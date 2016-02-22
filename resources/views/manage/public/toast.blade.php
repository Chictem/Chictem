<div id="toast">
    {!! Html::style('/css/plugins/toastr/toastr.min.css') !!}
    {!! Html::script('/js/plugins/toastr/toastr.min.js') !!}
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        function alert(msg, kind) {
            kind = kind ? kind : 'info';
            toastr[kind](msg);
        }
    </script>
    @if(Session::has('flash_notification.message'))
        @define $kind = Session::get('flash_notification.level')
        @define $kind = $kind == 'danger'?'error':$kind
        <script>
            alert('{!! Session::get('flash_notification.message') !!}', '{{ $kind }}');
        </script>
    @endif
    @if (count($errors) > 0)
        @define $error_text = '<ul>'
        @foreach ($errors->all() as $error)
            @define $error_text.= ('<li>'.$error.'</li>')
        @endforeach
            @define $error_text .= '</ul>'
        <script>
            alert('{!! $error_text !!}', 'error');
        </script>
    @endif
</div>