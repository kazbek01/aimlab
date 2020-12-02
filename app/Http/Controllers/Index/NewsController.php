<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class NewsController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'news');

    }

    public function index(Request $request)
    {
        $news = News::where('is_show', 1)
            ->select(
                'news_id',
                'news_title',
                'news_image',
                'view_count',
                'news_desc'
            )
            ->orderBy('news_id', 'desc');

        $news = $news->paginate(12);


        return view('index.news.news',
            [
                'news' => $news
            ]);
    }

    public function show(Request $request, $id)
    {
        $news = News::where('news_id', $id)
            ->where('is_show', 1)
            ->select(
                'news_id',
                'news_title',
                'news_image',
                'news_desc',
                'view_count',
                'news_text'
            )
            ->first();

        if ($news == null) abort(404);

        $news->increment('view_count');


        return view('index.news.news-detail',
            [
                'news' => $news
            ]);
    }


}
