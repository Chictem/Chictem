<li class="dd-item hidden" data-id="" data-icon="" data-name="" data-link="" id="item-template">
    <div class="dd-handle">
        <span class="label label-primary"></span>
        <span class="handle-name"></span>
        <span class="handle-link"></span>
        <span class="pull-right drop-down"><i class="fa fa-chevron-down"></i></span>
    </div>
    <div class="option-panel none">
        <form role="form" class="form-inline form-group-sm">
            <input type="text" placeholder="请输入图标" class="form-control edit-icon" value="">
            <input type="text" placeholder="请输入名称" class="form-control edit-name" value="">
            <input type="text" placeholder="请输入链接" class="form-control edit-link" value="">
            <button class="btn btn-primary btn-xs change-dd-list" type="button">修改
            </button>
            <button class="btn btn-danger btn-xs del-dd-list" type="button">删除
            </button>
            <button class="btn btn-primary btn-xs up-dd-list" type="button">收起
            </button>
        </form>
    </div>
</li>
<form role="form" class="form-inline m-t-sm">
    <div class="form-group form-group-sm">
        <label class="sr-only">图标</label>
        {!! Form::text('_icon', null, ['class' => 'form-control', 'placeholder' => '请输入图标']) !!}
    </div>
    <div class="form-group form-group-sm">
        <label class="sr-only">名称</label>
        {!! Form::text('_name', null, ['class' => 'form-control', 'placeholder' => '请输入名称']) !!}
    </div>
    <div class="form-group form-group-sm">
        <label class="sr-only">链接</label>
        {!! Form::text('_link', null, ['class' => 'form-control', 'placeholder' => '请输入链接']) !!}
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-xs add-dd-list" type="button">添加</button>
    </div>
</form>