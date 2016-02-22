<div id="support-upload">
    {!! Html::style('/css/plugins/uploadify/uploadify.css') !!}
    {!! Html::script('/js/plugins/uploadify/jquery.uploadify.min.js') !!}
    <script>
        jQuery.fn.fileUpload = function() {
            function addDel(ele, img, hidden) {
                if (img.siblings('.del-upload')) {
                    img.siblings('.del-upload').remove();
                }
                var del = $('<div></div>').addClass('btn btn-danger btn-sm del-upload').html('<i class="fa fa-remove"></i>删除');
                del.insertAfter(img);
                del.on('click', function() {
                    img.attr('src', '');
                    hidden.val('');
                    $(this).remove();
                    $(ele.attr('save')).show();
                });
            }

            var ele = $(this);
            var img = ele.siblings('img');
            var hidden = ele.siblings('input[type="hidden"]');
            if (hidden.val()) {
                img.attr('src', hidden.val());
                addDel(ele, img, hidden);
            }
            setTimeout(function() {
                ele.uploadify({
                    'formData': {
                        '_token': '{{ csrf_token() }}'
                    },
                    'buttonClass': 'btn btn-primary btn-upload',
                    'fileTypeDesc': 'Image Files',
                    'fileTypeExts': '*.gif; *.jpg; *.png',
                    'buttonText': '<i class="fa fa-upload"></i>上传图片',
                    'fileSizeLimit': '2MB',
                    'swf': '/swf/uploadify.swf',
                    'uploader': '/upload/img',
                    'onUploadSuccess': function(data, response) {
                        response = JSON.parse(response);
                        status = response.status;
                        switch (status) {
                            case '404':
                                alert('没有图片可以上传');
                                break;
                            case '403':
                                alert('格式不允许');
                                break;
                            case '500':
                                alert('文件错误，无法上传');
                                break;
                            case '200':
                                img.attr('src', response.path);
                                hidden.val(response.path);
                                addDel(ele, img, hidden);
                                $(ele.attr('save')).show();
                                break;
                        }
                    }
                });
            }, 0);
        }
        if ($('.uploadify').length > 0) {
            $('.uploadify').fileUpload();
        }
    </script>
    <style>
        .uploadify {
            margin: 10px auto;
        }

        .btn-upload {
            display: block;
            width: 120px;
            margin: 10px auto;
            line-height: 15px !important;
        }

        img.pre-view {
            width: 100%;
        }

        .del-upload {
            display: block;
            width: 90px;
            margin: 10px auto;
            margin-top: 10px;
        }
    </style>
</div>
