{!! Html::style(plugins('sweetalert/css/sweetalert.css')) !!}
{!! Html::script(plugins('sweetalert/js/sweetalert.min.js')) !!}

@if(Session::has('sweet_alert'))
    <script>
        swal({
            text: "{!! Session::get('sweet_alert.text') !!}",
            title: "{!! Session::get('sweet_alert.title') !!}",
            timer: "{!! Session::get('sweet_alert.timer') !!}",
            type: "{!! Session::get('sweet_alert.type') !!}",
            showConfirmButton: "{!! Session::get('sweet_alert.showConfirmButton') !!}",
            confirmButtonText: "{!! Session::get('sweet_alert.confirmButtonText') !!}",
            confirmButtonColor: "#AEDEF4"
        });
    </script>
@endif