<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\About;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class AboutController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'about');

    }
    public function index(Request $request)
    {
        $row = About::orderBy('about_id', 'desc')
            ->select('about.*');

//        dd($row);



        if (isset($request->about_title) && $request->about_title!= '') {
            $row->where(function ($query) use ($request) {
                $query->where('about_title', 'like', '%' . $request->about_title . '%');
            });
        }



        $row = $row->paginate(20);

        return view('admin.about.about', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new About();
        $row->about_image = '/static/img/content/default.jpg';

        return view('admin.about.about-edit', [
            'title' => 'Добавить о компании',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_title' => 'required',
            'about_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.about.about-edit', [
                'title' => 'Добавить о компании',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $about = new About();
        $about->about_title = $request->about_title;
        $about->about_desc = $request->about_desc;
        $about->about_text = $request->about_text;
        $about->about_image = $request->about_image;


        $about->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'about';
        $action->action_text_ru = 'добавил(а) о компании "' . $about->about_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $about->about_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/about');
    }

    public function edit($id)
    {
        $row = About::where('about_id', $id)
            ->select('*')
            ->first();

        return view('admin.about.about-edit', [
            'title' => 'Редактировать данные о компании',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'about_title' => 'required',
            'about_text' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.about.about-edit', [
                'title' => 'Редактировать данные о компании',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $about = About::find($id);

        $about->about_title = $request->about_title;
        $about->about_desc = $request->about_desc;
        $about->about_text = $request->about_text;
        $about->about_image = $request->about_image;



        $about->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'about';
        $action->action_text_ru = 'редактировал(а) данные о компании "' . $about->about_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $about->about_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/about');
    }

    public function destroy($id)
    {
        $about = About::find($id);


        $about->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'about';
        $action->action_text_ru = 'удалил(а) о компании "' . $about->about_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $about = About::find($request->id);
        $about->is_show = $request->is_show;
        $about->save();

        $action = new Actions();
        $action->action_comment = 'about';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - о компании "' . $about->about_title . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - о компании "' . $about->about_title . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $about->about_id;
        $action->save();

        Cache::flush();
    }
}
