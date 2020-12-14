<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\OrderInfo;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class OrderInfoController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'order_info');

    }
    public function index(Request $request)
    {
        $row = OrderInfo::orderBy('order_info_id', 'desc')
            ->select('order_info.*');

//        dd($row);



        if (isset($request->order_info_title) && $request->order_info_title!= '') {
            $row->where(function ($query) use ($request) {
                $query->where('order_info_title', 'like', '%' . $request->order_info_title . '%');
            });
        }



        $row = $row->paginate(20);

        return view('admin.order_info.order_info', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new OrderInfo();
        $row->order_info_image = '/static/img/content/default.jpg';

        return view('admin.order_info.order_info-edit', [
            'title' => 'Добавить как заказать',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_info_title' => 'required',
            'order_info_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.order_info.order_info-edit', [
                'title' => 'Добавить как заказать',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $order_info = new OrderInfo();
        $order_info->order_info_title = $request->order_info_title;
        $order_info->order_info_desc = $request->order_info_desc;
        $order_info->order_info_text = $request->order_info_text;
        $order_info->order_info_image = $request->order_info_image;


        $order_info->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'order_info';
        $action->action_text_ru = 'добавил(а) как заказать "' . $order_info->order_info_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $order_info->order_info_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/order_info');
    }

    public function edit($id)
    {
        $row = OrderInfo::where('order_info_id', $id)
            ->select('*')
            ->first();

        return view('admin.order_info.order_info-edit', [
            'title' => 'Редактировать данные как заказать',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'order_info_title' => 'required',
            'order_info_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.order_info.order_info-edit', [
                'title' => 'Редактировать данные как заказать',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $order_info = OrderInfo::find($id);

        $order_info->order_info_title = $request->order_info_title;
        $order_info->order_info_desc = $request->order_info_desc;
        $order_info->order_info_text = $request->order_info_text;
        $order_info->order_info_image = $request->order_info_image;



        $order_info->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'order_info';
        $action->action_text_ru = 'редактировал(а) данные как заказать "' . $order_info->order_info_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $order_info->order_info_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/order_info');
    }

    public function destroy($id)
    {
        $order_info = OrderInfo::find($id);


        $order_info->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'order_info';
        $action->action_text_ru = 'удалил(а) как заказать "' . $order_info->order_info_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $order_info = OrderInfo::find($request->id);
        $order_info->is_show = $request->is_show;
        $order_info->save();

        $action = new Actions();
        $action->action_comment = 'order_info';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - как заказать "' . $order_info->order_info_title . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - как заказать "' . $order_info->order_info_title . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $order_info->order_info_id;
        $action->save();

        Cache::flush();
    }
}
