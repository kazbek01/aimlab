@extends('admin.layout.layout')

@section('content')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0" >
                    {{ $title }}
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/project" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> Назад</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-block">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if($row->project_id > 0)
                            <form action="/admin/project/{{$row->project_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                            <form action="/admin/project" method="POST">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="project_id" value="{{ $row->project_id }}">
                                <input type="hidden" class="image-name" id="project_image" name="project_image" value="{{ $row->project_image }}"/>

                                <div class="box-body">


                                    <div class="card-block">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input value="{{ $row->project_name }}" type="text" class="form-control" name="project_name" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Краткое описание проекта</label>
                                            <textarea name="project_desc" class=" form-control"><?=$row->project_desc?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Полное описание проекта</label>
                                            <textarea name="project_text" class="ckeditor form-control text_editor"><?=$row->project_text?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Отображать на главной странице</label>
                                            <select name="is_main" data-placeholder="Выберите" class="form-control">
                                                <option @if($row->is_main == 0) selected @endif value="0">Нет</option>
                                                <option @if($row->is_main == 1) selected @endif value="1">Да</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>
                                <div class="box-footer" style="padding-top: 20px">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div class="box box-primary" style="padding: 30px; text-align: center">
                            <p>Изображение проекта</p>
                            <div style="padding: 20px; border: 1px solid #c2e2f0">
                                <img class="image-src" src="{{ $row->project_image }}" style="width: 100%; "/>
                            </div>
                            <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                            <form id="image_form" enctype="multipart/form-data" method="post" class="image-form">
                                <i class="fa fa-plus"></i>
                                <input id="avatar-file" type="file" onchange="uploadImage()" name="image"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="/admin/assets/plugins/moment/moment.js"></script>
    <script src="/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="/admin/assets/plugins/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js" type="text/javascript"></script>

    <script>

        $('#date-format').bootstrapMaterialDatePicker({ format: 'DD.MM.YYYY HH:mm' });


    </script>

@endsection



