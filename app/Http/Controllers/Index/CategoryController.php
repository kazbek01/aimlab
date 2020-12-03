<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {


    }

    public function getProductsByCategory(Request $request,$id)
    {
        $category = Category::where('category_id', $id)
            ->select(
                'category_id',
                'category_name_ru',
                'category_icon',
                'category_image'
            )->first();

        $category_products = Products::leftJoin('product_category','product_category.products_id', '=' , 'products.products_id')
            ->leftJoin('category','category.category_id', '=' , 'product_category.category_id')
            ->where('category.category_id', $id)
            ->where('products.is_show', 1)
            ->select(
                'category.category_id',
                'category.category_name_ru',
                'category.category_icon',
                'category.category_image',
                'products.products_id',
                'products.products_name',
                'products.products_short_desc',
                'products.products_price',
                'products.products_image'
            )
            ->groupBy('products.products_id')
            ->orderBy('products.products_id','desc');

        $category_products = $category_products->paginate(12);


        return view('index.category.category',
            [
                'category_products' => $category_products,
                'category' => $category
            ]);
    }



}
