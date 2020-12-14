<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Banner;
use App\Models\Category;
use App\Models\News;
use App\Models\Products;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class IndexController extends Controller
{
    public function __construct()
    {
//        $this->middleware('web');
        View::share('menu', 'index');

    }

    public function index(Request $request)
    {
        $banner = Banner::where('is_show', 1)
            ->select(
                'banner_name_ru',
                'banner_website',
                'banner_image'
            )
            ->get();

        $project = Project::where('is_show', 1)
            ->where('is_main', 1)
            ->select(
                'project_id',
                'project_name',
                'project_image',
                'project_desc'
            )
            ->take(3)
            ->get();

        $service = Service::where('is_show', 1)
            ->where('is_main', 1)
            ->select(
                'service_id',
                'service_name',
                'service_image',
                'service_desc'
            )
            ->take(3)
            ->get();

        $products = Products::where('is_show', 1)
            ->where('is_offer', 1)
            ->where('is_show_main', 1)
            ->select(
                'products_id',
                'products_name',
                'products_image',
                'products_short_desc',
                'products_price'
            )
            ->orderBy('products.products_id','desc')
            ->take(4)
            ->get();


        $category_db = new Category();

        $categories = $category_db -> getCategories();

//dd($categories);
        return view('index.index.index',
            [
                'banner' => $banner,
                'project' => $project,
                'service' => $service,
                'products' => $products,
                'categories' => $categories['categories'],
                'subcategories' => $categories['subcategories']
            ]);
    }

    public function search(Request $request)
    {

        $row['search_query'] =$request->search;

        $row['products'] = Products::where('is_show', 1)
             ->where(function ($query) use ($request) {
                 $query->where('products_name','like','%'.$request->search.'%')
                     ->orWhere('products_short_desc','like','%'.$request->search.'%');
             })
            ->select(
                'products_id',
                'products_name',
                'products_short_desc'
            )
            ->take(4)
            ->get();



        $row['project'] = Project::where('is_show', 1)
            ->where(function ($query) use ($request) {
                $query->where('project_name','like','%'.$request->search.'%')
                    ->orWhere('project_desc','like','%'.$request->search.'%');
            })
            ->select(
                'project_id',
                'project_name',
                'project_desc'
            )
            ->take(4)
            ->get();

        $row['service'] = Service::where('is_show', 1)
            ->where(function ($query) use ($request) {
                $query->where('service_name','like','%'.$request->search.'%')
                    ->orWhere('service_name','like','%'.$request->search.'%');
            })
            ->select(
                'service_id',
                'service_name',
                'service_desc'
            )
            ->take(4)
            ->get();

        $row['news'] = News::where('is_show', 1)
            ->where(function ($query) use ($request) {
                $query->where('news_title','like','%'.$request->search.'%')
                    ->orWhere('news_desc','like','%'.$request->search.'%');
            })
            ->select(
                'news_id',
                'news_title',
                'news_desc'
            )
            ->take(4)
            ->get();

        $row['category'] = Category::where('is_show', 1)
            ->where('category_name_ru','like','%'.$request->search.'%')
            ->select(
                'category_id',
                'category_name_ru'
            )
            ->take(4)
            ->get();

        return view('index.search.search-result',
            [
                'row' => $row
            ]);
    }

}
