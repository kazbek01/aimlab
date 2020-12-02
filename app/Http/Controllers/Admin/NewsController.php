<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\News;
use App\Models\Degree;
use App\Models\Category;
use App\Models\NewsRubric;
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

class NewsController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'news');

    }

    public function index(Request $request)
    {
        $row = News::orderBy('news_id', 'desc')
            ->select('news.*');

//        dd($row);

        if (isset($request->active))
            $row->where('news.is_show', $request->active);
        else $row->where('news.is_show', '1');


        if (isset($request->news_title) && $request->news_title!= '') {
            $row->where(function ($query) use ($request) {
                $query->where('news_title', 'like', '%' . $request->news_title . '%');
            });
        }



        $row = $row->paginate(20);

        return view('admin.news.news', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new News();
        $row->news_image = '/static/img/content/default.jpg';

        return view('admin.news.news-edit', [
            'title' => 'Добавить новость',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_title' => 'required',
            'news_desc' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.news.news-edit', [
                'title' => 'Добавить новость',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $news = new News();
        $news->news_title = $request->news_title;
        $news->news_desc = $request->news_desc;
        $news->news_text = $request->news_text;
        $news->news_image = $request->news_image;
        $news->is_show = 1;


        $news->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'news';
        $action->action_text_ru = 'добавил(а) новость "' . $news->news_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $news->news_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/news');
    }

    public function edit($id)
    {
        $row = News::where('news_id', $id)
            ->select('*')
            ->first();

        return view('admin.news.news-edit', [
            'title' => 'Редактировать данные новости',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'news_title' => 'required',
            'news_desc' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.news.news-edit', [
                'title' => 'Редактировать данные новости',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $news = News::find($id);

        $news->news_title = $request->news_title;
        $news->news_desc = $request->news_desc;
        $news->news_text = $request->news_text;
        $news->news_image = $request->news_image;
        $news->is_show = 1;


        $news->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'news';
        $action->action_text_ru = 'редактировал(а) данные новости "' . $news->news_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $news->news_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/news');
    }

    public function destroy($id)
    {
        $news = News::find($id);


        $news->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'news';
        $action->action_text_ru = 'удалил(а) новость "' . $news->news_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $news = News::find($request->id);
        $news->is_show = $request->is_show;
        $news->save();

        $action = new Actions();
        $action->action_comment = 'news';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - новость "' . $news->news_title . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - новость "' . $news->news_title . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $news->news_id;
        $action->save();

        Cache::flush();
    }
}
