@extends('admin.layout.layout')

@section('content')

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block menu-tab">
                    <a href="/admin/review" class="@if(!isset($request->active) || $request->active == '1') active-page @endif">Прочитанные комментарии</a>
                </h3>
                <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block menu-tab second-tab" >
                    <a href="/admin/review?active=0" class="@if($request->active == '0') active-page @endif">Непрочитанные комментарии</a>
                </h3>
                <div class="clear-float"></div>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/review/create" class="btn waves-effect waves-light btn-danger pull-right"> Добавить</a>
            </div>
        </div>

        <div class="row white-bg">
            <div style="text-align: left" class="form-group col-md-6" >

                @if($request->active == '0')

                    <h4 class="box-title box-edit-click">
                        <a href="javascript:void(0)" onclick="isShowEnabledAll('review')">Отметить как прочитанные</a>
                    </h4>

                @else

                    <h4 class="box-title box-edit-click">
                        <a href="javascript:void(0)" onclick="isShowDisabledAll('review')">Отметить как непрочитанные</a>
                    </h4>

                @endif

            </div>
            <div style="text-align: right" class="form-group col-md-6" >
                <h4 class="box-title box-delete-click">
                    <a href="javascript:void(0)" onclick="deleteAll('review')">Удалить отмеченные</a>
                </h4>
            </div>

            <div class="col-md-12">
                <div class="box-body">
                    <table id="review_datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th style="width: 30px">№</th>
                            <th>Аватар </th>
                            <th>Автор </th>
                            <th>Отзыв </th>
                            <th>Товар </th>
                            <th>IP </th>
                            <th>Дата</th>
                            <th></th>
                            <th class="no-sort" style="width: 0px; text-align: center; padding-right: 16px; padding-left: 14px;" >
                                <input onclick="selectAllCheckbox(this)" style="font-size: 15px" type="checkbox" value="1"/>
                            </th>
                        </tr>
                        </thead>

                        <tbody>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <form>
                                     <input value="{{$request->review}}" type="hidden" class="form-control" name="review" placeholder="">
                                     <input value="{{$request->user_name}}" type="text" class="form-control" name="user_name" placeholder="">
                                     <input value="{{$request->products_name}}" type="hidden" class="form-control" name="products_name" placeholder="">
                                     <input value="{{$request->lesson_name}}" type="hidden" class="form-control" name="lesson_name" placeholder="">
                                     <input value="{{$request->ip}}" type="hidden" class="form-control" name="ip" placeholder="">
                                     <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->review}}" type="text" class="form-control" name="review" placeholder="">
                                    <input value="{{$request->user_name}}" type="hidden" class="form-control" name="user_name" placeholder="">
                                    <input value="{{$request->products_name}}" type="hidden" class="form-control" name="products_name" placeholder="">
                                    <input value="{{$request->lesson_name}}" type="hidden" class="form-control" name="lesson_name" placeholder="">
                                    <input value="{{$request->ip}}" type="hidden" class="form-control" name="ip" placeholder="">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td></td>
                            <td>
                                <form>
                                    <input value="{{$request->review}}" type="hidden" class="form-control" name="review" placeholder="">
                                    <input value="{{$request->user_name}}" type="hidden" class="form-control" name="user_name" placeholder="">
                                    <input value="{{$request->products_name}}" type="text" class="form-control" name="products_name" placeholder="">
                                    <input value="{{$request->lesson_name}}" type="hidden" class="form-control" name="lesson_name" placeholder="">
                                    <input value="{{$request->ip}}" type="hidden" class="form-control" name="ip" placeholder="">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td>
                                <form>
                                    <input value="{{$request->review}}" type="hidden" class="form-control" name="review" placeholder="">
                                    <input value="{{$request->user_name}}" type="hidden" class="form-control" name="user_name" placeholder="">
                                    <input value="{{$request->products_name}}" type="hidden" class="form-control" name="products_name" placeholder="">
                                    <input value="{{$request->lesson_name}}" type="text" class="form-control" name="lesson_name" placeholder="">
                                    <input value="{{$request->ip}}" type="hidden" class="form-control" name="ip" placeholder="">
                                    <input type="hidden" value="@if(!isset($request->active)){{'1'}}@else{{$request->active}}@endif" name="active"/>
                                </form>
                            </td>
                            <td></td>
                            <td></td>

                        </tr>

                        @foreach($row as $key => $val)

                            <tr>
                                <td> {{ $key + 1 }}</td>
                                <td>
                                    <div class="object-image">
                                        <a class="fancybox" href="{{$val->avatar}}">
                                            <img src="{{$val->avatar}}">
                                        </a>
                                    </div>
                                    <div class="clear-float"></div>
                                </td>
                                <td>
                                    {{ $val['user_name']}}
                                    <div><strong>{{ $val['email']}}</strong></div>
                                    <div>{{ $val['phone']}}</div>
                                </td>
                                <td>
                                    {{ $val['review_text']}}
                                </td>
                            
                                <td>
                                    <a target="_blank" href="{{ $val['products_url_ru']}}">
                                        {{ $val['products_name_ru']}}
                                    </a>
                                </td>
                                <td>
                                    {{ $val['ip']}}
                                </td>
                                <td>
                                    {{ $val['date']}}
                                </td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0)" onclick="delItem(this,'{{ $val->review_id }}','review')">
                                        <i class="mdi mdi-delete" style="font-size: 20px; color: red;"></i>
                                    </a>
                                </td>

                                <td style="text-align: center;">
                                    <input class="select-all" style="font-size: 15px" type="checkbox" value="{{$val->review_id}}"/>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                    <div style="text-align: center">
                        {{ $row->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <link href="/custom/fancybox/jquery.fancybox.css" type="text/css" rel="stylesheet">
    <script src="/custom/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>

    <script>
        $('a.fancybox').fancybox({
            padding: 10
        });
    </script>
@endsection