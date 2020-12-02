<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'project');

    }

    public function index(Request $request)
    {
        $project = Project::where('is_show', 1)
            ->select(
                'project_id',
                'project_name',
                'project_image',
                'project_desc'
            )
            ->orderBy('project_id', 'desc');

        $project = $project->paginate(12);


        return view('index.project.project',
            [
                'project' => $project
            ]);
    }

    public function show(Request $request, $id)
    {
        $project = Project::where('project_id', $id)
            ->where('is_show', 1)
            ->select(
                'project_id',
                'project_name',
                'project_image',
                'project_desc',
                'project_text'
            )
            ->first();



        return view('index.project.project-detail',
            [
                'project' => $project
            ]);
    }


}
