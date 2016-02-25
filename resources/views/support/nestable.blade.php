<div id="support-nestable">
    {!! Html::script('/js/plugins/nestable/jquery.nestable.js') !!}
    <script>
        jQuery.fn.dragMenu = function() {
            var ele = $(this);
            var updateOutput = function(e) {
                setTimeout(function() {
                    var list = e.length ? e : $(e.target), output = list.data("output");
                    if (output) {
                        $(output).val(JSON.stringify(list.nestable("serialize")));
                    }
                }, 300);
            };

            function validate(data, callback) {
                $.each(data, function(key, value) {
                    var e = $('input[name="' + value + '"]');
                    if (!e.val()) {
                        e.addClass('error-input');
                        return -1;
                    }
                    if (key == data.length - 1) {
                        $('.error-input').removeClass('error-input');
                        callback();
                    }
                });
            }

            function updateItem(dd_item, icon, name, link) {
                var id = $('.dd-item').last().data('id') ? $('.dd-item').last().data('id') + 1 : $('.dd-item').size() + 1;
                dd_item.attr({'data-id': id, 'data-icon': icon, 'data-name': name, 'data-link': link})
                        .data({'id': id, 'icon': icon, 'name': name, 'link': link});
                dd_item.find('.label').first().html('<i class="fa fa-' + icon + '"></i>')
                dd_item.find('.handle-name').first().html(name);
                dd_item.find('.handle-link').first().html(link);
                dd_item.find('.edit-icon').first().val(icon);
                dd_item.find('.edit-name').first().val(name);
                dd_item.find('.edit-link').first().val(link);
            }

            ele.nestable({
                group: 1,
                maxDepth: 2,
            }).on("change", updateOutput);
            updateOutput(ele.data("output", '#menu-output'));
            ele.siblings('form').on('click', '.add-dd-list', function() {
                validate(['icon', 'name', 'link'], function() {
                    var dd_item = $('#item-template').clone().removeClass('hidden').attr('id', '');
                    var icon = $('input[name="icon"]').val();
                    var name = $('input[name="name"]').val();
                    var link = $('input[name="link"]').val();
                    updateItem(dd_item, icon, name, link);
                    dd_item.appendTo(ele.children('ol'));
                    ele.trigger('change');
                });
            });
            ele.on('mouseenter', '.drop-down', function() {
                $(this).parents('.dd-handle').siblings('.option-panel').slideDown();
            }).on('click', '.change-dd-list', function() {
                var dd_item = $(this).closest('.dd-item');
                var icon = $(this).siblings('.edit-icon').val();
                var name = $(this).siblings('.edit-name').val();
                var link = $(this).siblings('.edit-link').val();
                updateItem(dd_item, icon, name, link);
                ele.trigger('change');
            }).on('click', '.del-dd-list', function() {
                $(this).closest('.dd-item').remove();
                ele.trigger('change');
            }).on('click', '.up-dd-list', function() {
                $(this).closest('.dd-item').find('.option-panel').slideUp();
            });
        }
        $('.drag-menu').dragMenu();
    </script>
    <style>
        .option-panel {
            border: 1px dashed #e7eaec;
            background: #f3f3f4;
            padding: 10px;
            margin-top: -9px;
        }
    </style>
</div>
