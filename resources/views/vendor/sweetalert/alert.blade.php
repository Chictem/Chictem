<link href="/plugins/sweetalert/css/sweetalert.css" rel="stylesheet">
<script src="/plugins/sweetalert/js/sweetalert.min.js"></script>

@if(Session::has('sweetalert.alert'))
    <script>
        swal({
            text: "{!! Session::get('sweetalert.text') !!}",
            title: "{!! Session::get('sweetalert.title') !!}",
            timer: "{!! Session::get('sweetalert.timer') !!}",
            type: "{!! Session::get('sweetalert.type') !!}",
            showConfirmButton: "{!! Session::get('sweetalert.showConfirmButton') !!}",
            confirmButtonText: "{!! Session::get('sweetalert.confirmButtonText') !!}",
            confirmButtonColor: "#AEDEF4"
        });
    </script>
@endif