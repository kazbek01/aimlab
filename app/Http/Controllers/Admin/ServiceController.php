<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\Service;
use App\Models\Degree;
use App\Models\Category;
use App\Models\ServiceRubric;
use App\Models\Rubric;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class ServiceController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'service');

    }

    public function index(Request $request)
    {
        $row = Service::orderBy('service_id', 'desc')
            ->select('service.*');

//        dd($row);

        if (isset($request->active))
            $row->where('service.is_show', $request->active);
        else $row->where('service.is_show', '1');


        if (isset($request->service_name) && $request->service_name!= '') {
            $row->where(function ($query) use ($request) {
                $query->where('service_name', 'like', '%' . $request->service_name . '%');
            });
        }



        $row = $row->paginate(20);

        return view('admin.service.service', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Service();
        $row->service_image = '/static/img/content/default.jpg';

        return view('admin.service.service-edit', [
            'title' => 'Добавить проект',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'service_desc' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.service.service-edit', [
                'title' => 'Добавить проект',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $service = new Service();
        $service->service_name = $request->service_name;
        $service->service_desc = $request->service_desc;
        $service->service_text = $request->service_text;
        $service->service_image = $request->service_image;
        $service->is_main = $request->is_main;
        $service->is_show = 1;


        $service->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'service';
        $action->action_text_ru = 'добавил(а) проект "' . $service->service_name . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $service->service_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/service');
    }

    public function edit($id)
    {
        $row = Service::where('service_id', $id)
            ->select('*')
            ->first();

        return view('admin.service.service-edit', [
            'title' => 'Редактировать данные проекта',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'service_desc' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.service.service-edit', [
                'title' => 'Редактировать данные проекта',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $service = Service::find($id);

        $service->service_name = $request->service_name;
        $service->service_desc = $request->service_desc;
        $service->service_text = $request->service_text;
        $service->service_image = $request->service_image;
        $service->is_main = $request->is_main;
        $service->is_show = 1;


        $service->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'service';
        $action->action_text_ru = 'редактировал(а) данные проекта "' . $service->service_name . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $service->service_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/service');
    }

    public function destroy($id)
    {
        $service = Service::find($id);


        $service->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'service';
        $action->action_text_ru = 'удалил(а) проект "' . $service->service_name . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $service = Service::find($request->id);
        $service->is_show = $request->is_show;
        $service->save();

        $action = new Actions();
        $action->action_comment = 'service';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - проект "' . $service->service_name . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - проект "' . $service->service_name . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $service->service_id;
        $action->save();

        Cache::flush();
    }
}
