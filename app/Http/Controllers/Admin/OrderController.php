<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Comment;
use App\Models\News;
use App\Models\Faculty;
use App\Models\Order;
use App\Models\Rubric;
use App\Models\Products;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'order');

//        $products = Products::orderBy('products_name','asc')->select('products_id','products_name')->get();
//        View::share('products', $products);
    }

    public function index(Request $request)
    {
        $row = Order::orderBy('created_at', 'desc')
            ->select(
                'order_id',
                'user_name',
                'user_email',
                'order_text',
                DB::raw('DATE_FORMAT(created_at,"%d.%m.%Y %H:%i") as date'));

        if (isset($request->active))
            $row->where('order.is_show', $request->active);
        else $row->where('order.is_show', '1');

        if (isset($request->user_name) && $request->user_name != '') {
            $row->where(function ($query) use ($request) {
                $query->where('user_name', 'like', '%' . $request->user_name . '%');
            });
        }


        if (isset($request->order_text) && $request->order_text != '') {
            $row->where(function ($query) use ($request) {
                $query->where('order_text', 'like', '%' . $request->order_text . '%');
            });
        }


        $row = $row->paginate(20);

        return view('admin.order.order', [
            'row' => $row,
            'request' => $request
        ]);
    }


    public function edit($id)
    {
        $row = Order::find($id);

        $users = Users::orderBy('name', 'asc')->select('user_id', 'name')->get();
        View::share('users', $users);

        return view('admin.order.order-edit', [
            'title' => 'Редактировать данные заявки',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {
        $row = Order::where('order_id', $id)
            ->select(
                'order_id',
                'user_name',
                'user_email',
                'order_text',
                DB::raw('DATE_FORMAT(created_at,"%d.%m.%Y %H:%i") as date'))
            ->first();

        return view('admin.order.order-edit', [
            'row' => $row
        ]);
    }


    public function destroy($id)
    {
        $comment = Order::find($id);

        $comment->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'comment';
        $action->action_text_ru = 'удалил(а) заявку "' . $comment->order_text . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();
    }

    public function changeIsShow(Request $request)
    {
        $comment = Order::find($request->id);
        $comment->is_show = $request->is_show;
        $comment->save();

        $action = new Actions();
        $action->action_comment = 'comment';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - заявку "' . $comment->comment_text . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - заявку "' . $comment->comment_text . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $comment->comment_id;
        $action->save();

        Cache::flush();
    }

}
