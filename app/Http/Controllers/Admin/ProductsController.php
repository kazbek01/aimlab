<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'products');

        $category_list = Category::orderBy('sort_num','asc')->get();
        View::share('category_list', $category_list);
    }

    public function index(Request $request)
    {
        $row = Products::orderBy('products.sort_num','asc');

        if(isset($request->active))
            $row->where('products.is_show',$request->active);
        else $row->where('products.is_show','1');

        if($request->products_name != '')
            $row->where('products_name','like','%' .$request->products_name .'%');


        $row = $row->paginate(20);

        return  view('admin.products.products',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Products();
        
        return  view('admin.products.products-edit', [
            'title' => 'Добавить товар',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'products_name' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return  view('admin.products.products-edit', [
                'title' => 'Добавить товар',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

//        dd($request->category_list);

        $products = new Products();
        $products->products_name = $request->products_name;
        $products->products_short_desc = $request->products_short_desc;
        $products->products_desc = $request->products_desc;
        $products->products_spec_offer = $request->products_spec_offer;
        $products->products_image= $request->products_image;
        $products->products_price = $request->products_price;
        $products->products_price_second = $request->products_price_second;
        $products->products_price_old = $request->products_price_old;
        $products->price_detail_first = $request->price_detail_first;
        $products->price_detail_second = $request->price_detail_second;
        $products->is_show_main = $request->is_show_main;
        $products->is_offer = $request->is_offer;
        $products->sort_num = $request->sort_num?:100;
        $products->save();



//        if(isset($request->image_list)){
//            foreach($request->image_list as $key => $item){
//                $image = new ProductImage();
//                $image->image_url = $item;
//                $image->products_id = $products->products_id;
//                $image->is_main = $request->is_main[$key];
//                $image->save();
//
//            }
//
//        }



        if(isset($request->category_list)){
            foreach($request->category_list as $val){
                $product_category = new ProductCategory();
                $product_category->products_id = $products->products_id;
                $product_category->category_id = $val;
                $product_category->save();
            }
        }
        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'products';
        $action->action_text_ru = 'добавил(а) товар "' .$products->products_name .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $products->products_id;
        $action->save();

        return redirect('/admin/products');
    }

    public function edit($id)
    {
        $row = Products::find($id);
        if($row == null) abort(404);

//        $images = ProductImage::where('products_id',$id)->get();

        return  view('admin.products.products-edit', [
            'title' => 'Редактировать данные товара',
            'row' => $row
        ]);

    }

    public function show(Request $request,$id){

    }

    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'products_name' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return  view('admin.products.products-edit', [
                'title' => 'Редактировать данные товара',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $products = Products::find($id);

        $products->products_name = $request->products_name;
        $products->products_short_desc = $request->products_short_desc;
        $products->products_desc = $request->products_desc;
        $products->products_spec_offer = $request->products_spec_offer;
        $products->products_image= $request->products_image;
        $products->products_price = $request->products_price;
        $products->products_price_second = $request->products_price_second;
        $products->products_price_old = $request->products_price_old;
        $products->price_detail_first = $request->price_detail_first;
        $products->price_detail_second = $request->price_detail_second;
        $products->is_show_main = $request->is_show_main;
        $products->is_offer = $request->is_offer;
        $products->sort_num = $request->sort_num?:100;
        $products->sort_num = $request->sort_num?:100;

        $products->save();

//        $image_delete = ProductImage::where('products_id',$products->products_id)->delete();
//
//        if(isset($request->image_list)){
//            foreach($request->image_list as $key => $item){
//                $image = new ProductImage();
//                $image->image_url = $item;
//                $image->products_id = $products->products_id;
//                $image->is_main = $request->is_main[$key];
//                $image->save();
//
//            }
//
//        }

        ProductCategory::where('products_id',$products->products_id)->delete();

        if(isset($request->category_list)){
            foreach($request->category_list as $val){
                $product_category = new ProductCategory();
                $product_category->products_id = $products->products_id;
                $product_category->category_id = $val;
                $product_category->save();
            }
        }

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'products';
        $action->action_text_ru = 'редактировал(а) товар "' .$products->products_name .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $products->products_id;
        $action->save();

        return redirect('/admin/products');
    }

    public function destroy($id)
    {
        $products = Products::find($id);

        $products->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'products';
        $action->action_text_ru = 'удалил(а) товар "' .$products->products_name .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

    }

    public function getImageList(Request $request){
        $image[0]['image_url'] = $request->image_url;
        $image[0]['is_main'] = 0;

        return  view('admin.products.image-loop',[
            'image' => $image,
            'is_ajax' => 1,
        ]);
    }

    public function changeIsShow(Request $request){
        $products = Products::find($request->id);
        $products->is_show = $request->is_show;
        $products->save();

        $action = new Actions();
        $action->action_comment = 'products';

        if($request->is_show == 1){
            $action->action_text_ru = 'отметил(а) как активное - товар "' .$products->products_name .'"';
            $action->action_code_id = 5;
        }
        else {
            $action->action_text_ru = 'отметил(а) как неактивное - товар "' .$products->products_name .'"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $products->products_id;
        $action->save();

    }

}
