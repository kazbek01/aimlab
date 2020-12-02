@extends('admin.layout.layout')

@section('css')
    <link href="/admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="/admin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
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
                <a href="/admin/review" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> Назад</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-block">
                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif
                        @if($row->review_id > 0)
                            <form action="/admin/review/{{$row->review_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                                    <form action="/admin/review" method="POST">
                                        @endif
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="review_id" value="{{ $row->review_id }}">
                                        <input type="hidden" value="@if(isset($_GET['parent_id'])){{$_GET['parent_id']}}@endif" name="parent_id">

                                        <input type="hidden" class="image-name" id="review_image" name="review_image" value="{{ $row->review_image }}"/>
                                        <input type="hidden" class="image-name2" id="review_image2" name="review_icon" value="{{ $row->review_icon }}"/>

                                        <div class="box-body">

                                            <div class="card-block">
                                                <div class="form-group">
                                                    <label>Отзыв</label>
                                                    <textarea name="review_text" class=" form-control "><?=$row->review_text?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Рейтинг</label>
                                                    <select name="rating" class="form-control" >

                                                        @for($i = 1; $i <= 5; $i++)

                                                            <option @if($row->rating == $i) selected="selected" @endif value="{{$i}}">{{$i}}</option>

                                                        @endfor

                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Пользователь</label>
                                                    <select name="user_id" data-placeholder="Выберите" class="form-control select2">
                                                        <option></option>
                                                        @foreach($users as $item)
                                                            <option @if($item->user_id == $row->user_id) selected @endif value="{{$item->user_id}}">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Предмет</label>
                                                    <select name="subject_id" data-placeholder="Выберите" class="form-control select2">
                                                        <option @if("" == $row->subject_id) selected @endif value="Нет предмета">Нет предмета</option>
                                                        @foreach($subjects as $item)
                                                            <option @if($item->subject_id == $row->subject_id) selected @endif value="{{$item->subject_id}}">{{$item->subject_name_ru}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Отображать на главной странице</label>
                                                    <select name="is_show_main" data-placeholder="Выберите" class="form-control">
                                                        <option @if($row->is_show_main == 0) selected @endif value="0">Нет</option>
                                                        <option @if($row->is_show_main == 1) selected @endif value="1">Да</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Порядковый номер сортировки для главной страницы</label>
                                                    <input value="{{ $row->sort_num }}" type="text" class="form-control" name="sort_num" placeholder="">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Сохранить</button>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection


@section('js')

    <script src="/admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <script src="/admin/assets/plugins/moment/moment.js"></script>
    <script src="/admin/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/admin/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script>
        $('.mydatepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
    </script>

    <script src="/admin/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script>

        $(".select2").select2();

    </script>

@endsection

