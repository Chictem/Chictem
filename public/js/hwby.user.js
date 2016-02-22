$(function() {
    if ($('#user-info .info-block').length > 0) {
        $('#user-info .info-block').on('click', '.edit-btn', function() {
            info_block = $(this).parents('.info-block');
            info_block.find('.edit-form').show();
            info_block.find('.show-form').hide();
        });
    }
    if ($('#edu-info').length > 0) {
        $('#edu-info').on('click', '.fa-remove', function() {
            $(this).parent().remove();
        });
        $('#edu-info').on('click', '.fa-plus', function() {
            $('<div class="form-group">' +
                '<input class="form-control inline span3" name="education[school][]" type="text">\n' +
                '<input class="form-control inline span3" name="education[date][]" type="text">\n' +
                '<i class="fa-remove"></i>' +
                '</div>').appendTo($('#edu-info .edu-inputs'));
        });
    }
    if ($('#work-info').length > 0) {
        $('#work-info').on('click', '.icon-remove', function() {
            $(this).parent().remove();
        });
        $('#work-info').on('click', '.icon-plus', function() {
            $('<div class="form-group">' +
                '<input class="form-control inline span3" name="work[company][]" type="text">\n' +
                '<input class="form-control inline span3" name="work[job][]" type="text">\n' +
                '<i class="icon-remove"></i>' +
                '</div>').appendTo($('#work-info .work-inputs'));
        });
    }
    $('#user-show').on('click', '#follow-user', function() {
        btn = $(this);
        $.ajax({
            type: 'POST',
            url: '/user/follow',
            dataType: 'json',
            data: {
                '_token': $('input[name="_token"]').val(),
                'id': btn.attr('user'),
            },
            success: function(data) {
                if (data.code == '1') {
                    alert('关注成功', 'success');
                    btn.attr('id', 'unfollow-user').text('取消关注');
                } else {
                    alert('关注失败', 'danger');
                }
            },
            error: function() {
                alert('关注失败', 'danger');
            }
        });
    });
    $('#user-show').on('click', '#unfollow-user', function() {
        btn = $(this);
        $.ajax({
            type: 'POST',
            url: '/user/un-follow',
            dataType: 'json',
            data: {
                '_token': $('input[name="_token"]').val(),
                'id': btn.attr('user'),
            },
            success: function(data) {
                if (data.code == '1') {
                    alert('取消关注成功', 'success');
                    btn.attr('id', 'follow-user').text('关注TA');
                } else {
                    alert('取消关注失败', 'danger');
                }
            },
            error: function() {
                alert('取消关注失败', 'danger');
            }
        });
    });
    $('#manage-user')
        .on('click', '#add-edu-info', function() {
            function createTR(kind, location, year) {
                tr = $('<tr>');
                $('<td>').text(kind).appendTo(tr);
                $('<td>').text(location).appendTo(tr);
                $('<td>').text(year).appendTo(tr);
                $('<input>').attr({'type': 'hidden', 'value': kind, 'name': 'education[kind][]'}).appendTo(tr);
                $('<input>').attr({'type': 'hidden', 'value': location, 'name': 'education[location][]'}).appendTo(tr);
                $('<input>').attr({'type': 'hidden', 'value': year, 'name': 'education[year][]'}).appendTo(tr);
                $('<td><div class="btn btn-danger btn-xs pull-right remove-info"> <i class="fa fa-remove"></i>删除 </div></td>').appendTo(tr);
                return tr;
            }

            if (!$('#education_location').val()) {
                $('#education_location').css('border', '1px solid red');
            } else {
                tr = createTR($('#education_kind').val(), $('#education_location').val(), $('#education_year').val());
                tr.insertBefore('#edu-table tbody tr:last-child');
                $('#education_location').val('');
            }
        })
        .on('click', '#add-work-info', function() {
            function createTR(company, start_year, start_month, end_year, end_month) {
                tr = $('<tr>');
                start = start_year + '.' + start_month;
                end = end_year + '.' + end_month;
                if (isNaN(end_year)) end = end_year;
                $('<td>').text(company).appendTo(tr);
                $('<td>').text(start).appendTo(tr);
                $('<td>').text(end).appendTo(tr);
                $('<input>').attr({'type': 'hidden', 'value': company, 'name': 'work[company][]'}).appendTo(tr);
                $('<input>').attr({
                    'type': 'hidden',
                    'value': start,
                    'name': 'work[start][]'
                }).appendTo(tr);
                $('<input>').attr({
                    'type': 'hidden',
                    'value': end,
                    'name': 'work[end][]'
                }).appendTo(tr);
                $('<td><div class="btn btn-danger btn-xs pull-right remove-info"> <i class="fa fa-remove"></i>删除 </div></td>').appendTo(tr);
                return tr;
            }

            if (!$('#work_company').val()) {
                $('#work_company').css('border', '1px solid red');
            } else {
                tr = createTR($('#work_company').val(), $('#work_start').val(), $('#work_start_month').val(), $('#work_end').val(), $('#work_end_month').val());
                tr.insertBefore('#work-table tbody tr:last-child');
                $('#work_company').val('');
            }
        })
        .on('click', '.remove-info', function() {
            $(this).parents('tr').remove();
        })
        .on('click', '.edit-btn', function() {
            $(this).hide();
            console.log($(this).parents('.ibox'));
            $(this).parents('.ibox').find('.edit').show();
        })
        .on('click', '#location-info.editable-click', function() {
            $(this).hide().siblings('span').hide();
            $(this).siblings('div').show();
        })
        .on('click', '#submit-address', function() {
            prov = $('select[name="province"]').val();
            city = $('select[name="city"]').val();
            dis = $('select[name="district"]').val();
            loc = $('input[name="location"]').val();
            address = prov + city + (dis ? dis : '') + loc;
            $.ajax({
                type: 'POST',
                url: '/manage/user/update-address',
                dataType: 'json',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    'province': prov,
                    'city': city,
                    'district': dis,
                    'location': loc,
                },
                success: function(data) {
                    if (data.code == '1') {
                        $('#location-info').text(address).show().siblings('div').hide();
                    } else {
                        alert('修改失败', 'error');
                    }
                },
                error: function() {
                    alert('修改', 'error');
                }
            });
        });
});