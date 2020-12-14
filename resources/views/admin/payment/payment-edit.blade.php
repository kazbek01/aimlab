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
                <a href="/admin/payment" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> Назад</a>
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
                        @if($row->payment_id > 0)
                            <form action="/admin/payment/{{$row->payment_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                            <form action="/admin/payment" method="POST">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="payment_id" value="{{ $row->payment_id }}">
                                <input type="hidden" class="image-name" id="payment_image" name="payment_image" value="{{ $row->payment_image }}"/>

                                <div class="box-body">


                                    <div class="card-block">
                                        <div class="form-group">
                                            <label>Способы оплаты</label>
                                            <input value="{{ $row->payment_title }}" type="text" class="form-control" name="payment_title" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Краткое описание</label>
                                            <textarea name="payment_desc" class=" form-control"><?=$row->payment_desc?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Полное описание</label>
                                            <textarea name="payment_text" class="ckeditor form-control text_editor"><?=$row->payment_text?></textarea>
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
                            <p>Изображение</p>
                            <div style="padding: 20px; border: 1px solid #c2e2f0">
                                <img class="image-src" src="{{ $row->payment_image }}" style="width: 100%; "/>
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



