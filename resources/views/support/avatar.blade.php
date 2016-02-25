<div id="support-fullavatar">
    {!! Html::script('/js/plugins/fullavatar/swfobject.js') !!}
    {!! Html::script('/js/plugins/fullavatar/fullAvatarEditor.js') !!}
    <script>
        swfobject.addDomLoadEvent(function() {
            var swf = new fullAvatarEditor(
                    "/swf/fullAvatarEditor.swf",
                    "/swf/expressInstall.swf",
                    "avatar-upload", {
                        id: 'swf',
                        upload_url: '/upload/avatar',
                        method: 'post',
                        src_upload: 0,
                        avatar_box_border_width: 0,
                        avatar_sizes: '100*100',
                        avatar_sizes_desc: '100*100像素'
                    }, function(msg) {
                        switch (msg.code) {
                            case 5 :
                                if (msg.type == 0) {
                                    if (path = msg.content.path) {
                                        $('#pre-avatar').attr('src', path);
                                    } else {
                                        alert('保存失败');
                                    }
                                }
                                break;
                        }
                    }
            );
        });
    </script>
    <script>
        $('#save-avatar').on('click', function() {
            $.ajax({
                type: 'POST',
                url: '/manage/user/save-avatar',
                dataType: 'json',
                data: {
                    'image': $('#pre-avatar').attr('src'),
                    '_token': '{{ csrf_token() }}',
                },
                success: function(data) {
                    if (data.code == '1') {
                        alert('保存成功', 'success');
                    } else {
                        alert('保存失败', 'error');
                    }
                },
                error: function() {
                    alert('保存失败', 'error');
                }
            });
        });
    </script>
</div>