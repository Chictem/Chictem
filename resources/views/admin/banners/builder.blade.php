@extends('voyager::master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/css/nestable.css">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>{{ trans('admin.banner_builder.name') }}({{ $banner->name }})
        <div class="btn btn-success add_item"><i class="voyager-plus"></i> {{ trans('common.button.add') }}</div>
    </h1>

@stop

@section('page_header_actions')

@stop

@section('content')

    <div class="page-content container-fluid" id="banner-items">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">

                    <div class="panel-heading">
                        <p class="panel-title" style="color:#777">
                            {{ trans('admin.banner_builder.message.arrange') }}
                        </p>
                    </div>

                    <div class="panel-body" style="padding:30px;">

                        <div class="dd">
                            <?= Banner::display($banner->name, 'admin'); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i>
                        {{ trans('common.alert.delete', ['name' => trans('common.model.banner_item')]) }}
                    </h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.banners.item.destroy', ['banner' => $banner->id, 'id' => '__id']) }}"
                          id="delete_form"
                          method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ trans('common.button.confirm') }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                        {{ trans('common.button.cancel') }}
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal modal-success fade" tabindex="-1" id="add_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i> Create a New Banner Item</h4>
                </div>
                <form action="{{ route('voyager.banners.item.add', ['banner' => $banner->id]) }}"
                      method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="title">名称</label>
                        <input type="text" class="form-control" name="title" placeholder="名称"><br>
                        <label for="description">描述</label>
                        <input type="text" class="form-control" name="description" placeholder="描述"><br>
                        <label for="url">链接</label>
                        <input type="text" class="form-control" name="url" placeholder="链接"><br>
                        <label for="image">上传图片</label>
                        <input type="file" name="image"><br>
                        <label for="image">图片链接，会覆盖上传图片</label>
                        <input type="text" name="image_url" class="form-control"><br>
                        <input type="hidden" name="banner_id" value="{{ $banner->id }}">
                    </div>
                    {{ csrf_field() }}

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success pull-right" value="Add New Item">
                        <button type="button" class="btn btn-default pull-right"
                                data-dismiss="modal">{{ trans('common.button.cancel') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal modal-info fade" tabindex="-1" id="edit_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-edit"></i> Edit Banner Item</h4>
                </div>
                <form action="{{ route('voyager.banners.item.update', ['banner' => $banner->id]) }}" id="edit_form"
                      method="POST" enctype="multipart/form-data">
                    {{ method_field("PUT") }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <label for="title">名称</label>
                        <input type="text" class="form-control" id="edit_title" name="title" placeholder="名称"><br>
                        <label for="description">描述</label>
                        <input type="text" class="form-control" id="edit_description" name="description"
                               placeholder="描述"><br>
                        <label for="url">链接</label>
                        <input type="text" class="form-control" id="edit_url" name="url" placeholder="URL"><br>
                        <img src="" style="max-width: 300px; " id="pre_image">
                        <label for="image">上传图片</label>
                        <input type="file" name="image"><br>
                        <label for="image">图片链接，会覆盖上传图片</label>
                        <input type="text" name="image_url" id="edit_image_url" class="form-control"><br>
                        <input type="hidden" name="id" id="edit_id" value="">
                    </div>

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success pull-right delete-confirm" value="Update">
                        <button type="button" class="btn btn-default pull-right"
                                data-dismiss="modal">{{ trans('common.button.cancel') }}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop

@section('javascript')

    <script type="text/javascript" src="{{ config('voyager.assets_path') }}/js/jquery.nestable.js"></script>
    <script>
        $(document).ready(function() {
            $('.dd').nestable({maxDepth: 1});
            $('.item_actions').on('click', '.delete', function(e) {
                id = $(e.currentTarget).data('id');
                $('#delete_form')[0].action = $('#delete_form')[0].action.replace("__id", id);
                $('#delete_modal').modal('show');
            });

            $('.item_actions').on('click', '.edit', function(e) {
                id = $(e.currentTarget).data('id');
                $('#edit_title').val($(e.currentTarget).data('title'));
                $('#edit_url').val($(e.currentTarget).data('url'));
                $('#edit_description').val($(e.currentTarget).data('description'));
                $('#pre_image').attr('src', $(e.currentTarget).data('image'));
                $('#edit_image_url').val($(e.currentTarget).data('image_url'));
                $('#edit_id').val(id);
                $('#edit_modal').modal('show');
            });

            $('.add_item').click(function() {
                $('#add_modal').modal('show');
            });

            $('.dd').on('change', function(e) {
                $.post('{{ route('voyager.banners.order',['banner' => $banner->id]) }}', {
                    order: JSON.stringify($('.dd').nestable('serialize')),
                    _token: '{{ csrf_token() }}'
                }, function(data) {
                    toastr.success("Successfully updated banner order.");
                });

            });

        });
    </script>
    <style>

        .dd-dragel .dd-item {
            width: 100%;
        }

        .dd-dragel .dd-item .dd-handle {
            height: 200px;
        }

        .dd-dragel .dd-item .dd-handle .thumb {
            max-width: 90%;
            max-height: 90%;
        }

        #pre_image {
            display: block !important;
        }

    </style>
@stop
