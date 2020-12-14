<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'payment');

    }


    public function show(Request $request)
    {
        $payment = Payment::select(
            'payment_id',
            'payment_title',
            'payment_image',
            'payment_desc',
            'payment_text'
        )
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        if ($payment == null) abort(404);


        return view('index.payment.payment-detail',
            [
                'payment' => $payment
            ]);
    }


}
