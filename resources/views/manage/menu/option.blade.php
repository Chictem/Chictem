<div class="option-panel none">
    <form role="form" class="form-inline form-group-sm">
        <input type="text" placeholder="请输入图标"
               class="form-control form-control-sm edit-icon"
               value="{{ $icon }}">
        <input type="text" placeholder="请输入名称"
               class="form-control edit-name"
               value="{{ $name }}">
        <input type="text" placeholder="请输入链接"
               class="form-control edit-link"
               value="{{ $link }}">
        <button class="btn btn-primary btn-xs change-dd-list"
                type="button">修改
        </button>
        <button class="btn btn-danger btn-xs del-dd-list"
                type="button">删除
        </button>
        <button class="btn btn-primary btn-xs up-dd-list"
                type="button">收起</i>
        </button>
    </form>
</div>