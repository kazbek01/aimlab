<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'category');
    }

    public function index(Request $request)
    {
        $row = Category::orderBy('category.sort_num','asc');

        if(isset($request->active))
            $row->where('category.is_show',$request->active);
        else $row->where('category.is_show','1');

        if($request->category_name_ru != '')
            $row->where('category_name_ru','like','%' .$request->category_name_ru .'%');

        if(isset($request->parent_id))
            $row->where('parent_id',$request->parent_id);
        else
            $row->where('parent_id',0);
        
        $row = $row->paginate(20);

        return  view('admin.category.category',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Category();

        $category_list = Category::orderBy('sort_num','asc')->get();
        
        return  view('admin.category.category-edit', [
            'title' => 'Добавить категорию',
            'row' => $row,
            'category_list' => $category_list
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name_ru' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return  view('admin.category.category-edit', [
                'title' => 'Добавить категорию',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $category = new Category();
        $category->category_name_ru = $request->category_name_ru;
        $category->category_name_en =  $request->category_name_ru;
        $category->category_name_kz = $request->category_name_ru;
        $category->category_icon = $request->category_icon;
        $category->category_image = $request->category_image;
//        $category->parent_id = $request->parent_id;

        $url = '';
        if($request->parent_id != '') {
            $url = '?parent_id=' .$request->parent_id;
            $category->parent_id = $request->parent_id;
        }

        if(isset($request->category_list)){
            foreach($request->category_list as $val){
                $category->parent_id = $val;
            }
        }

        $category->sort_num = $request->sort_num?$request->sort_num:100;
        $category->save();




        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'category';
        $action->action_text_ru = 'добавил(а) категорию "' .$category->category_name_ru .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $category->category_id;
        $action->save();

        return redirect('/admin/category'.$url);
    }

    public function edit($id)
    {
        $row = Category::find($id);
        $category_list = Category::orderBy('sort_num','asc')->get();

        if($row == null) abort(404);

        return  view('admin.category.category-edit', [
            'title' => 'Редактировать данные категории',
            'row' => $row,
            'category_list' => $category_list
        ]);
    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'category_name_ru' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.category.category-edit', [
                'title' => 'Редактировать данные категории',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $category = Category::find($id);
        $category->category_name_ru = $request->category_name_ru;
        $category->category_name_en = $request->category_name_ru;
        $category->category_name_kz = $request->category_name_ru;
        $category->category_icon = $request->category_icon;
        $category->category_image = $request->category_image;

        $url = '';
        if($request->parent_id != '') {
            $url = '?parent_id=' .$request->parent_id;
            $category->parent_id = $request->parent_id;
        }

        $category->sort_num = $request->sort_num?$request->sort_num:100;
        $category->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'category';
        $action->action_text_ru = 'редактировал(а) категорию "' .$category->category_name_ru .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $category->category_id;
        $action->save();

        return redirect('/admin/category'.$url);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'category';
        $action->action_text_ru = 'удалил(а) категорию "' .$category->category_name_ru .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

    }

    public function changeIsShow(Request $request){
        $category = Category::find($request->id);
        $category->is_show = $request->is_show;
        $category->save();

        $action = new Actions();
        $action->action_comment = 'category';

        if($request->is_show == 1){
            $action->action_text_ru = 'отметил(а) как активное - категорию "' .$category->category_name_ru .'"';
            $action->action_code_id = 5;
        }
        else {
            $action->action_text_ru = 'отметил(а) как неактивное - категорию "' .$category->category_name_ru .'"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $category->category_id;
        $action->save();

    }

}
