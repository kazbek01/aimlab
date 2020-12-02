@extends('admin.layout.layout')
@section('css')
    <link rel="stylesheet" href="/admin/assets/plugins/select2/dist/css/select2.css">
    <link href="/admin/assets/plugins/icheck/skins/all.css" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">
                    {{ $title }}
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/category" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down">
                    Назад</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-block">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if($row->category_id > 0)
                            <form action="/admin/category/{{$row->category_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/category" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="category_id" value="{{ $row->category_id }}">
                                        <input type="hidden"
                                               value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif"
                                               name="parent_id">
                                        <input type="hidden" class="image-name" name="category_image"
                                               value="{{ $row->category_image }}"/>

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Название категории</label>
                                                <input value="{{ $row->category_name_ru }}" type="text"
                                                       class="form-control" name="category_name_ru"
                                                       placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Иконка</label>
                                                <textarea class="form-control"
                                                          name="category_icon">{{ $row->category_icon }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Порядковый номер сортировки</label>
                                                <input value="{{ $row->sort_num }}" type="text" class="form-control"
                                                       name="sort_num" placeholder="">
                                            </div>
{{--                                            <div class="form-group">--}}
{{--                                                <label>Родительская категория</label>--}}
{{--                                                <select name="parent_id" data-placeholder="Выберите"--}}
{{--                                                        class="form-control">--}}
{{--                                                    <option>Выберите (Нет родителя)</option>--}}
{{--                                                    @foreach($category_list as $item)--}}
{{--                                                        <option @if($item->category_id == $row->parent_id) selected--}}
{{--                                                                @endif value="{{$item->category_id}}">{{$item->category_name_ru}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="box box-primary upload-form image-form-1" style="padding: 30px; text-align: center">
                        <p>Основная фотка</p>
                        <div style="padding: 20px; border: 1px solid #c2e2f0">
                            <img class="image-src" src="{{ $row->category_image }}" style="width: 100%; "/>
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
    <script src="/admin/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script>

        $(".select2").select2();

    </script>

@endsection



