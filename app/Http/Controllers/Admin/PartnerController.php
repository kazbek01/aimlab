<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\Partner;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class PartnerController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'partner');

    }
    public function index(Request $request)
    {
        $row = Partner::orderBy('partner_id', 'desc')
            ->select('partner.*');

//        dd($row);



        if (isset($request->partner_title) && $request->partner_title!= '') {
            $row->where(function ($query) use ($request) {
                $query->where('partner_title', 'like', '%' . $request->partner_title . '%');
            });
        }



        $row = $row->paginate(20);

        return view('admin.partner.partner', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Partner();
        $row->partner_image = '/static/img/content/default.jpg';

        return view('admin.partner.partner-edit', [
            'title' => 'Добавить партнера',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'partner_title' => 'required',
            'partner_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.partner.partner-edit', [
                'title' => 'Добавить партнера',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $partner = new Partner();
        $partner->partner_title = $request->partner_title;
        $partner->partner_desc = $request->partner_desc;
        $partner->partner_text = $request->partner_text;
        $partner->partner_image = $request->partner_image;


        $partner->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'partner';
        $action->action_text_ru = 'добавил(а) партнера "' . $partner->partner_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $partner->partner_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/partner');
    }

    public function edit($id)
    {
        $row = Partner::where('partner_id', $id)
            ->select('*')
            ->first();

        return view('admin.partner.partner-edit', [
            'title' => 'Редактировать данные партнера',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'partner_title' => 'required',
            'partner_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.partner.partner-edit', [
                'title' => 'Редактировать данные партнера',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $partner = Partner::find($id);

        $partner->partner_title = $request->partner_title;
        $partner->partner_desc = $request->partner_desc;
        $partner->partner_text = $request->partner_text;
        $partner->partner_image = $request->partner_image;



        $partner->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'partner';
        $action->action_text_ru = 'редактировал(а) данные партнера "' . $partner->partner_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $partner->partner_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/partner');
    }

    public function destroy($id)
    {
        $partner = Partner::find($id);


        $partner->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'partner';
        $action->action_text_ru = 'удалил(а) партнера "' . $partner->partner_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $partner = Partner::find($request->id);
        $partner->is_show = $request->is_show;
        $partner->save();

        $action = new Actions();
        $action->action_comment = 'partner';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - партнера "' . $partner->partner_title . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - партнера "' . $partner->partner_title . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $partner->partner_id;
        $action->save();

        Cache::flush();
    }
}
