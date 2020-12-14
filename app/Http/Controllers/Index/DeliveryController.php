<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class DeliveryController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'delivery');

    }


    public function show(Request $request)
    {
        $delivery = Delivery::select(
            'delivery_id',
            'delivery_title',
            'delivery_image',
            'delivery_desc',
            'delivery_text'
        )
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        if ($delivery == null) abort(404);


        return view('index.delivery.delivery-detail',
            [
                'delivery' => $delivery
            ]);
    }


}
