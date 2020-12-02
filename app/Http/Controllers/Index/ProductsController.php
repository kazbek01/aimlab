<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Products;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class ProductsController extends Controller
{
    public function __construct()
    {


    }
    

    public function show(Request $request, $id)
    {
        $products = Products::leftJoin('product_category','product_category.products_id', '=' , 'products.products_id')
            ->leftJoin('category','category.category_id', '=' , 'product_category.category_id')
            ->where('products.products_id', $id)
            ->where('products.is_show', 1)
            ->select(
                'products.products_id',
                'products.products_name',
                'products.products_image',
                'products.products_desc',
                'products.products_price',
                'category.category_id',
                'category.category_name_ru'
            )
            ->first();



        return view('index.category.cart',
            [
                'products' => $products
            ]);
    }


}
