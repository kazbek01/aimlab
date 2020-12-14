<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\Delivery;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class DeliveryController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'delivery');

    }
    public function index(Request $request)
    {
        $row = Delivery::orderBy('delivery_id', 'desc')
            ->select('delivery.*');

//        dd($row);



        if (isset($request->delivery_title) && $request->delivery_title!= '') {
            $row->where(function ($query) use ($request) {
                $query->where('delivery_title', 'like', '%' . $request->delivery_title . '%');
            });
        }



        $row = $row->paginate(20);

        return view('admin.delivery.delivery', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Delivery();
        $row->delivery_image = '/static/img/content/default.jpg';

        return view('admin.delivery.delivery-edit', [
            'title' => 'Добавить условия доставки',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_title' => 'required',
            'delivery_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.delivery.delivery-edit', [
                'title' => 'Добавить условия доставки',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $delivery = new Delivery();
        $delivery->delivery_title = $request->delivery_title;
        $delivery->delivery_desc = $request->delivery_desc;
        $delivery->delivery_text = $request->delivery_text;
        $delivery->delivery_image = $request->delivery_image;


        $delivery->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'delivery';
        $action->action_text_ru = 'добавил(а) условия доставки "' . $delivery->delivery_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $delivery->delivery_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/delivery');
    }

    public function edit($id)
    {
        $row = Delivery::where('delivery_id', $id)
            ->select('*')
            ->first();

        return view('admin.delivery.delivery-edit', [
            'title' => 'Редактировать данные условия доставки',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'delivery_title' => 'required',
            'delivery_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.delivery.delivery-edit', [
                'title' => 'Редактировать данные условия доставки',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $delivery = Delivery::find($id);

        $delivery->delivery_title = $request->delivery_title;
        $delivery->delivery_desc = $request->delivery_desc;
        $delivery->delivery_text = $request->delivery_text;
        $delivery->delivery_image = $request->delivery_image;



        $delivery->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'delivery';
        $action->action_text_ru = 'редактировал(а) данные условия доставки "' . $delivery->delivery_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $delivery->delivery_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/delivery');
    }

    public function destroy($id)
    {
        $delivery = Delivery::find($id);


        $delivery->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'delivery';
        $action->action_text_ru = 'удалил(а) условия доставки "' . $delivery->delivery_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $delivery = Delivery::find($request->id);
        $delivery->is_show = $request->is_show;
        $delivery->save();

        $action = new Actions();
        $action->action_comment = 'delivery';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - условия доставки "' . $delivery->delivery_title . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - условия доставки "' . $delivery->delivery_title . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $delivery->delivery_id;
        $action->save();

        Cache::flush();
    }
}
