<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\Payment;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'payment');

    }
    public function index(Request $request)
    {
        $row = Payment::orderBy('payment_id', 'desc')
            ->select('payment.*');

//        dd($row);



        if (isset($request->payment_title) && $request->payment_title!= '') {
            $row->where(function ($query) use ($request) {
                $query->where('payment_title', 'like', '%' . $request->payment_title . '%');
            });
        }



        $row = $row->paginate(20);

        return view('admin.payment.payment', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Payment();
        $row->payment_image = '/static/img/content/default.jpg';

        return view('admin.payment.payment-edit', [
            'title' => 'Добавить cпособы оплаты',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_title' => 'required',
            'payment_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.payment.payment-edit', [
                'title' => 'Добавить cпособы оплаты',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $payment = new Payment();
        $payment->payment_title = $request->payment_title;
        $payment->payment_desc = $request->payment_desc;
        $payment->payment_text = $request->payment_text;
        $payment->payment_image = $request->payment_image;


        $payment->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'payment';
        $action->action_text_ru = 'добавил(а) cпособы оплаты "' . $payment->payment_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $payment->payment_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/payment');
    }

    public function edit($id)
    {
        $row = Payment::where('payment_id', $id)
            ->select('*')
            ->first();

        return view('admin.payment.payment-edit', [
            'title' => 'Редактировать данные cпособы оплаты',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment_title' => 'required',
            'payment_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.payment.payment-edit', [
                'title' => 'Редактировать данные cпособы оплаты',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $payment = Payment::find($id);

        $payment->payment_title = $request->payment_title;
        $payment->payment_desc = $request->payment_desc;
        $payment->payment_text = $request->payment_text;
        $payment->payment_image = $request->payment_image;



        $payment->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'payment';
        $action->action_text_ru = 'редактировал(а) данные cпособы оплаты "' . $payment->payment_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $payment->payment_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/payment');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);


        $payment->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'payment';
        $action->action_text_ru = 'удалил(а) cпособы оплаты "' . $payment->payment_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $payment = Payment::find($request->id);
        $payment->is_show = $request->is_show;
        $payment->save();

        $action = new Actions();
        $action->action_comment = 'payment';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - cпособы оплаты "' . $payment->payment_title . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - cпособы оплаты "' . $payment->payment_title . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $payment->payment_id;
        $action->save();

        Cache::flush();
    }
}
