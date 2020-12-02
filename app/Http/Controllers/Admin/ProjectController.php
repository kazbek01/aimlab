<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\Project;
use App\Models\Degree;
use App\Models\Category;
use App\Models\ProjectRubric;
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

class ProjectController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'project');

    }

    public function index(Request $request)
    {
        $row = Project::orderBy('project_id', 'desc')
            ->select('project.*');

//        dd($row);

        if (isset($request->active))
            $row->where('project.is_show', $request->active);
        else $row->where('project.is_show', '1');


        if (isset($request->project_name) && $request->project_name!= '') {
            $row->where(function ($query) use ($request) {
                $query->where('project_name', 'like', '%' . $request->project_name . '%');
            });
        }



        $row = $row->paginate(20);

        return view('admin.project.project', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Project();
        $row->project_image = '/static/img/content/default.jpg';

        return view('admin.project.project-edit', [
            'title' => 'Добавить проект',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'project_desc' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.project.project-edit', [
                'title' => 'Добавить проект',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $project = new Project();
        $project->project_name = $request->project_name;
        $project->project_desc = $request->project_desc;
        $project->project_text = $request->project_text;
        $project->project_image = $request->project_image;
        $project->is_main = $request->is_main;
        $project->is_show = 1;


        $project->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'project';
        $action->action_text_ru = 'добавил(а) проект "' . $project->project_name . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $project->project_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/project');
    }

    public function edit($id)
    {
        $row = Project::where('project_id', $id)
            ->select('*')
            ->first();

        return view('admin.project.project-edit', [
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
            'project_name' => 'required',
            'project_desc' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.project.project-edit', [
                'title' => 'Редактировать данные проекта',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $project = Project::find($id);

        $project->project_name = $request->project_name;
        $project->project_desc = $request->project_desc;
        $project->project_text = $request->project_text;
        $project->project_image = $request->project_image;
        $project->is_main = $request->is_main;
        $project->is_show = 1;


        $project->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'project';
        $action->action_text_ru = 'редактировал(а) данные проекта "' . $project->project_name . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $project->project_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/project');
    }

    public function destroy($id)
    {
        $project = Project::find($id);


        $project->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'project';
        $action->action_text_ru = 'удалил(а) проект "' . $project->project_name . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $project = Project::find($request->id);
        $project->is_show = $request->is_show;
        $project->save();

        $action = new Actions();
        $action->action_comment = 'project';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - проект "' . $project->project_name . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - проект "' . $project->project_name . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $project->project_id;
        $action->save();

        Cache::flush();
    }
}
