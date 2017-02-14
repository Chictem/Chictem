@extends('voyager::master')

@section('css')
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/media/media.css"/>
    <link rel="stylesheet" type="text/css" href="{{ config('voyager.assets_path') }}/js/select2/select2.min.css">
    <link rel="stylesheet" href="{{ config('voyager.assets_path') }}/css/media/dropzone.css"/>
@stop

@section('content')

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="admin-section-title">
                    <h3><i class="voyager-images"></i>
                        {{ trans('admin.media.name') }}
                    </h3>
                </div>
                <div class="clear"></div>

                <div id="filemanager">

                    <div id="toolbar">
                        <div class="btn-group offset-right">
                            <button type="button" class="btn btn-primary" id="upload"><i class="voyager-upload"></i>
                                {{ trans('common.button.upload') }}
                            </button>
                            <button type="button" class="btn btn-primary" id="new_folder"
                                    onclick="jQuery('#new_folder_modal').modal('show');"><i class="voyager-folder"></i>
                                {{ trans('admin.media.button.add_folder') }}
                            </button>
                        </div>
                        <button type="button" class="btn btn-default" id="refresh"><i class="voyager-refresh"></i>
                        </button>
                        <div class="btn-group offset-right">
                            <button type="button" class="btn btn-default" id="move"><i class="voyager-move"></i>
                                {{ trans('common.button.move') }}
                            </button>
                            <button type="button" class="btn btn-default" id="rename"><i class="voyager-character"></i>
                                {{ trans('common.button.rename') }}
                            </button>
                            <button type="button" class="btn btn-default" id="delete"><i class="voyager-trash"></i>
                                {{ trans('common.button.delete') }}
                            </button>
                        </div>
                    </div>

                    <div id="uploadPreview" style="display:none;"></div>

                    <div id="uploadProgress" class="progress active progress-striped">
                        <div class="progress-bar progress-bar-success" style="width: 0"></div>
                    </div>

                    <div id="content">


                        <div class="breadcrumb-container">
                            <ol class="breadcrumb filemanager">
                                <li data-folder="/" data-index="0"><span class="arrow"></span><strong>
                                        {{ trans('admin.media.name') }}
                                    </strong></li>
                                <template v-for="folder in folders">
                                    <li data-folder="@{{folder}}" data-index="@{{ $index+1 }}"><span
                                                class="arrow"></span>@{{ folder }}</li>
                                </template>
                            </ol>

                            <div class="toggle"><span>{{ trans('common.button.close') }}</span><i
                                        class="voyager-double-right"></i></div>
                        </div>
                        <div class="flex">

                            <div id="left">

                                <ul id="files">

                                    <li v-for="file in files.items">
                                        <div class="file_link" data-folder="@{{file.name}}" data-index="@{{ $index }}">
                                            <div class="link_icon">
                                                <template v-if="file.type.includes('image')">
                                                    <div class="img_icon"
                                                         style="background-size: cover; background-image: url(@{{ encodeURI(file.path) }}); background-repeat:no-repeat; background-position:center center;display:inline-block; width:100%; height:100%;"></div>
                                                </template>
                                                <template v-if="file.type.includes('video')">
                                                    <i class="icon voyager-video"></i>
                                                </template>
                                                <template v-if="file.type.includes('audio')">
                                                    <i class="icon voyager-music"></i>
                                                </template>
                                                <template v-if="file.type == 'folder'">
                                                    <i class="icon voyager-folder"></i>
                                                </template>
                                                <template
                                                        v-if="file.type != 'folder' && !file.type.includes('image') && !file.type.includes('video') && !file.type.includes('audio')">
                                                    <i class="icon voyager-file-text"></i>
                                                </template>

                                            </div>
                                            <div class="details @{{ file.type }}"><h4>@{{ file.name }}</h4>
                                                <small>
                                                    <template v-if="file.type == 'folder'">
                                                    <!--span class="num_items">@{{ file.items }} file(s)</span-->
                                                    </template>
                                                    <template v-else>
                                                        <span class="file_size">@{{ file.size }}</span>
                                                    </template>
                                                </small>
                                            </div>
                                        </div>
                                    </li>

                                </ul>

                                <div id="file_loader">
                                    @php $admin_loader_img = Voyager::setting('admin_loader', ''); @endphp
                                    @if($admin_loader_img == '')
                                        <img src="{{ config('voyager.assets_path') . '/images/logo-icon.png' }}"
                                             alt="Voyager Loader">
                                    @else
                                        <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader">
                                    @endif
                                    <p>{{ trans('admin.media.message.loading') }}</p>
                                </div>

                                <div id="no_files">
                                    <h3><i class="voyager-meh"></i>{{ trans('admin.media.message.empty') }}</h3>
                                </div>

                            </div>

                            <div id="right">
                                <div class="right_none_selected">
                                    <i class="voyager-cursor"></i>
                                    <p>{{ trans('admin.media.message.unselected') }}</p>
                                </div>
                                <div class="right_details">
                                    <div class="detail_img @{{ selected_file.type }}">
                                        <template v-if="selected_file.type.includes('image')">
                                            <img src="@{{ selected_file.path }}"/>
                                        </template>
                                        <template v-if="selected_file.type.includes('video')">
                                            <video width="100%" height="auto" controls>
                                                <source src="@{{selected_file.path}}" type="video/mp4">
                                                <source src="@{{selected_file.path}}" type="video/ogg">
                                                <source src="@{{selected_file.path}}" type="video/webm">
                                                {{ trans('admin.media.message.unsupported') }}
                                            </video>
                                        </template>
                                        <template v-if="selected_file.type.includes('audio')">
                                            <audio controls style="width:100%; margin-top:5px;">
                                                <source src="@{{selected_file.path}}" type="audio/ogg">
                                                <source src="@{{selected_file.path}}" type="audio/mpeg">
                                                {{ trans('admin.media.message.unsupported') }}
                                            </audio>
                                        </template>
                                        <template v-if="selected_file.type == 'folder'">
                                            <i class="voyager-folder"></i>
                                        </template>
                                        <template
                                                v-if="selected_file.type != 'folder' && !selected_file.type.includes('audio') && !selected_file.type.includes('video') && !selected_file.type.includes('image')">
                                            <i class="voyager-file-text-o"></i>
                                        </template>

                                    </div>
                                    <div class="detail_info @{{selected_file.type}}">
                                        <span>
                                            <h4>{{ trans('admin.media.button.title') }}</h4>
                                            <p>@{{selected_file.name}}</p>
                                        </span>
                                        <span>
                                            <h4>{{ trans('admin.media.button.type') }}</h4>
                                            <p>@{{selected_file.type}}</p>
                                        </span>
                                        <template v-if="selected_file.type != 'folder'">
                                            <span>
                                                <h4>{{ trans('admin.media.button.size') }}</h4>
                                                <p>
                                                    <span class="selected_file_count">@{{ selected_file.items }}
                                                        item(s)</span>
                                                    <span class="selected_file_size">@{{selected_file.size}}</span>
                                                </p>
                                            </span>
                                            <span>
                                                <h4>{{ trans('admin.media.button.url') }}</h4>
                                                <p>
                                                    <a href="@{{ selected_file.path }}" target="_blank">{{ trans('common.button.click') }}
                                                    </a>
                                                </p>
                                            </span>
                                            <span>
                                                <h4>{{ trans('admin.media.button.updated_at') }}</h4>
                                                <p>@{{selected_file.last_modified}}</p>
                                            </span>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nothingfound">
                            <div class="nofiles"></div>
                            <span>{{ trans('admin.media.message.empty') }}</span>
                        </div>

                    </div>

                    <!-- Move File Modal -->
                    <div class="modal fade modal-warning" id="move_file_modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i
                                                class="voyager-move"></i>{{ trans('common.button.move') }}</h4>
                                </div>

                                <div class="modal-body">
                                    <h4>{{ trans('admin.media.button.destination') }}</h4>
                                    <select id="move_folder_dropdown">
                                        <template v-if="folders.length">
                                            <option value="/../">../</option>
                                        </template>
                                        <template v-for="dir in directories">
                                            <option value="@{{ dir }}">@{{ dir }}</option>
                                        </template>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal">{{ trans('common.button.cancel') }}</button>
                                    <button type="button" class="btn btn-warning"
                                            id="move_btn">{{ trans('common.button.move') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Move File Modal -->

                    <!-- Rename File Modal -->
                    <div class="modal fade modal-warning" id="rename_file_modal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><i
                                                class="voyager-character"></i>{{ trans('common.button.rename') }}</h4>
                                </div>

                                <div class="modal-body">
                                    <h4>{{ trans('common.button.add') }}</h4>
                                    <input id="new_filename" class="form-control" type="text"
                                           value="@{{selected_file.name}}">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default"
                                            data-dismiss="modal">{{ trans('common.button.cancel') }}</button>
                                    <button type="button" class="btn btn-warning"
                                            id="rename_btn">{{ trans('common.button.rename') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Move File Modal -->

                </div><!-- #filemanager -->

                <!-- New Folder Modal -->
                <div class="modal fade modal-info" id="new_folder_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><i class="voyager-folder"></i>{{ trans('common.button.add') }}
                                </h4>
                            </div>

                            <div class="modal-body">
                                <input name="new_folder_name" id="new_folder_name" placeholder="{{ trans('admin.media.message.new_folder') }}"
                                       class="form-control" value=""/>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">{{ trans('common.button.cancel') }}</button>
                                <button type="button" class="btn btn-info"
                                        id="new_folder_submit">{{ trans('common.button.add') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End New Folder Modal -->

                <!-- Delete File Modal -->
                <div class="modal fade modal-danger" id="confirm_delete_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><i class="voyager-warning"></i>
                                    {{ trans('admin.media.message.confirm') }}
                                </h4>
                            </div>

                            <div class="modal-body">
                                <h4>{!! trans('admin.media.message.delete', ['name' => '<span class="confirm_delete_name"></span>']) !!}</h4>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal">{{ trans('common.button.cancel') }}</button>
                                <button type="button" class="btn btn-danger"
                                        id="confirm_delete">{{ trans('common.button.delete') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Delete File Modal -->

                <div id="dropzone"></div>
                <!-- Delete File Modal -->
                <div class="modal fade" id="upload_files_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                        aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><i class="voyager-warning"></i>
                                {{ trans('admin.media.message.drag_upload') }}
                                </h4>
                            </div>

                            <div class="modal-body">

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">{{ trans('common.button.confirm') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Delete File Modal -->


            </div><!-- .row -->
        </div><!-- .col-md-12 -->
    </div><!-- .page-content container-fluid -->


    <input type="hidden" id="storage_path" value="{{ storage_path() }}">


    <!-- Include our script files -->
    <script src="{{ config('voyager.assets_path') }}/js/select2/select2.min.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/media/dropzone.js"></script>
    <script src="{{ config('voyager.assets_path') }}/js/media/media.js"></script>
    <script type="text/javascript">
        var media = new VoyagerMedia({
            baseUrl: "{{ route('voyager.dashboard') }}"
        });
        $(function() {
            media.init();
        });
    </script>
@stop
