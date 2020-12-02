<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Menu;

use App\Models\Order;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use View;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Cookie;


class OrderController extends Controller
{

    public function __construct()
    {
        View::share('menu', 'contact');

    }
    public function index(Request $request)
    {

        return  view('index.index.contact');
    }

    public function addOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_email' => 'required|email',
            'order_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            $result['error'] = $error[0];
            $result['status'] = false;
            return response()->json($result);

        }
        

        $order = new Order();
        $order->user_name = $request->user_name;
        $order->user_email = $request->user_email;
        $order->order_text = $request->order_text;
        $order->is_show = 0;

        try {
            $order->save();


        } catch (\Exception $ex) {
            $result['error'] = 'Ошибка базы данных' . $ex;
            $result['error_code'] = 500;
            $result['status'] = false;
            return response()->json($result);
        }

        $result['message'] = 'Спасибо за Вашу заявку';
        $result['status'] = true;

        return response()->json($result);

    }


}
