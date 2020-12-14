<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\OrderInfo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class OrderInfoController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'order_info');

    }


    public function show(Request $request)
    {
        $order_info = OrderInfo::select(
            'order_info_id',
            'order_info_title',
            'order_info_image',
            'order_info_desc',
            'order_info_text'
        )
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        if ($order_info == null) abort(404);


        return view('index.order_info.order_info-detail',
            [
                'order_info' => $order_info
            ]);
    }


}
