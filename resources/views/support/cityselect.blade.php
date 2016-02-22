<div id="support.cityselect">
    {!! Html::script('/js/jquery.cityselect.js') !!}
    <script>
        $(function() {
            if ($('.city-select').length > 0) {
                $('.city-select').citySelect({
                    prov: '{{ $user->province }}',
                    city: '{{ $user->city }}',
                    dist: '{{ $user->district }}',
                    nodata: "none",
                });
            }
        });
    </script>
</div>