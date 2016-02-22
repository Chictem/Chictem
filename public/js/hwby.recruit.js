/**
 * Created by CQC on 2015/12/21.
 */
$(function() {

    if ($('#recruit-img').length > 0) {
        $('#recruit-img').fileUpload();
    }

    if ($('.tags-panel').length > 0) {
        $('.tags-panel').find('ul li a').first().trigger('click');
    }

    $('#recruit-actor .tags-panel .tab-pane a').on('click', function() {
        tag_id = $(this).attr('for');
        tag_name = $(this).text();
        console.log(tag_name);
        actor_panel = $($('#add-actor-template').html());
        actor_panel.find('.hidden-tag-id').val(tag_id);
        actor_panel.find('label[for="tag_name"]').text(tag_name);
        actor_panel.appendTo('#add-actor-form');
    });

    /* add or edit actors of recruit */
    $('#recruit-actor').on('click', '.save', function() {
        panel = $(this).parents('.actor-panel');
        $.ajax({
            type: 'POST',
            url: '/actor/' + $('#add-actor-form').attr('for') + '/store',
            dataType: 'json',
            data: {
                'id': panel.find('input[name="id"]').val(),
                'name': panel.find('input[name="name"]').val(),
                'brief': panel.find('input[name="brief"]').val(),
                'detail': panel.find('textarea[name="detail"]').val(),
                'salary': panel.find('input[name="salary"]').val(),
                'reward': panel.find('input[name="reward"]').val(),
                'tag_id': panel.find('input[name="tag_id"]').val(),
                '_token': $('input[name="_token"]').val(),
            },
            success: function(data) {
                if (data.code == '1') {
                    alert('保存成功', 'success');
                } else {
                    alert('保存失败', 'danger');
                }
            },
            error: function() {
                alert('保存失败!', 'danger');
            }
        });
    });

    /* delete actors of recruit */
    $('#recruit-actor').on('click', '.del', function() {
        panel = $(this).parents('.actor-panel');
        $.ajax({
            type: 'POST',
            url: '/actor/' + $('#add-actor-form').attr('for') + '/delete',
            dataType: 'json',
            data: {
                'id': panel.find('input[name="id"]').val(),
                '_token': $('input[name="_token"]').val(),
            },
            success: function(data) {
                if (data.code == '1') {
                    panel.remove();
                } else {
                    alert('删除失败', 'danger');
                }
            },
            error: function() {
                alert('请求失败!', 'danger');
            }
        });
    });
    /*
    $('#recruit-show').on('click', '.join-btn', function() {
        btn = $(this);
        $.ajax({
            type: 'POST',
            url: '/actor/joinActor',
            dataType: 'json',
            data: {
                'actor_id': $(this).attr('for'),
                '_token': $('input[name="_token"]').val(),
            },
            success: function(data) {
                console.log(data);
                if (data == '1') {
                    btn.text('已加入').attr('disabled', 'true');
                }
            }
        });
    });
    */
});