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
                <a href="/admin/contact" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> Назад</a>
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
                        @if($row->contact_id > 0)
                            <form action="/admin/contact/{{$row->contact_id}}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @else
                            <form action="/admin/contact" method="POST">
                                @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="contact_id" value="{{ $row->contact_id }}">

                                <div class="box-body">


                                    <div class="card-block">
                                        <div class="form-group">
                                            <label>Телефон</label>
                                            <input value="{{ $row->phone }}" type="text" class="form-control" name="phone" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Whatsapp</label>
                                            <input value="{{ $row->whatsapp }}" type="text" class="form-control" name="whatsapp" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input value="{{ $row->email }}" type="text" class="form-control" name="email" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label>Факс</label>
                                            <input value="{{ $row->fax }}" type="text" class="form-control" name="fax" placeholder="">
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



