@extends('admin.layout.layout')
@section('css')
    <link rel="stylesheet" href="/admin/assets/plugins/select2/dist/css/select2.css">
    <link href="/admin/assets/plugins/icheck/skins/all.css" rel="stylesheet">
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0" >
                    {{ $title }}
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/products" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> Назад</a>
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
                        @if($row->products_id > 0)
                            <form action="/admin/products/{{$row->products_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/products" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="products_id" value="{{ $row->products_id }}">
                                        <input type="hidden" value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif" name="parent_id">
                                        <input type="hidden" class="image-name"  name="products_image" value="{{ $row->products_image }}"/>

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>Название</label>
                                                <input value="{{ $row->products_name }}" type="text" class="form-control" name="products_name" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Краткое описание</label>
                                                <textarea  class="form-control" name="products_short_desc">{{ $row->products_short_desc }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Полное описание</label>
                                                <textarea  class="form-control ckeditor" name="products_desc">{{ $row->products_desc }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Специальные  уведомления (Скидки,акции)</label>
                                                <textarea  class="form-control" name="products_spec_offer">{{ $row->products_spec_offer }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Категория товара</label>
                                                @include('admin.products.category-list')
                                            </div>
                                            <div class="form-group">
                                                <label>Отобразить на главной странице</label>
                                                <div class="form-flex">
                                                    <label class="radio-container">
                                                        Да
                                                        <input type="radio" name="is_show_main" @if ($row->is_show_main == 1 ) checked @endif value="1" >
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="radio-container">
                                                        Нет
                                                        <input type="radio" name="is_show_main" @if ($row->is_show_main == 0 ) checked @endif value="0">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Добавить в специальные предложения</label>
                                                <div class="form-flex">
                                                    <label class="radio-container">
                                                        Да
                                                        <input type="radio" name="is_offer" @if ($row->is_offer == 1 ) checked @endif value="1" >
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="radio-container">
                                                        Нет
                                                        <input type="radio" name="is_offer" @if ($row->is_offer == 0 ) checked @endif value="0">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <div class="form-group">
                                                    <label>Цена 1</label>
                                                    <input value="{{ $row->products_price }}" type="text" class="form-control" name="products_price" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Детали цены 1</label>
                                                    <textarea  class="form-control" name="price_detail_first">{{ $row->price_detail_first }}</textarea>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <div class="form-group">
                                                    <label>Цена 2</label>
                                                    <input value="{{ $row->products_price_second }}" type="text" class="form-control" name="products_price_second" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Детали цены 2</label>
                                                    <textarea  class="form-control" name="price_detail_second">{{ $row->price_detail_second }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Старая цена</label>
                                                <input value="{{ $row->products_price_old }}" type="text" class="form-control" name="products_price_old" placeholder="">
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-block">
                        <div class="box box-primary upload-form image-form-1" style="padding: 30px; text-align: center">
                            <p>Основная фотка</p>
                            <div style="padding: 20px; border: 1px solid #c2e2f0">
                                <img class="image-src" src="{{ $row->products_image }}" style="width: 100%; "/>
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

        $('.nav-main-img').click(function () {
            $('.image-form-2').hide();
            $('.image-form-1').show();
        });
        $('.nav-gallery-img').click(function () {
            $('.image-form-2').show();
            $('.image-form-1').hide();
        });

        function showImagesUpload(){
            $('.upload-form').fadeOut(0);
            $('.image-form-2').fadeIn(0);
        }

        function getImageList(image_url){
            $.ajax({
                type: 'GET',
                url: "/admin/products/image",
                data:{
                    image_url: image_url
                },
                success: function(data){
                    $('#photo_content').prepend(data);
                }
            });
        }

    </script>

@endsection

