<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public static function getCategories(){

        $categories = Category::where('is_show', '1')
                ->where('parent_id', 0)
                ->orWhereNull('parent_id')
                ->select(
                    'category_name_ru',
                    'category_id',
                    'category_icon',
                    'category_image'
                )
                ->orderBy('sort_num', 'asc')
                ->orderBy('category_name_ru' , 'asc')
                ->get();

        $subcategories = array();

        foreach($categories as $item) {
            $subcategories [$item->category_id] = Category::where('is_show', '1')
                    ->where('parent_id', $item->category_id)
                    ->select(
                        'category_name_ru',
                        'category_id',
                        'parent_id',
                        'category_icon',
                        'category_image'
                    )
                    ->orderBy('sort_num', 'asc')
                    ->orderBy('category_name_ru', 'asc')
                    ->get();
        }

        $result['categories'] = $categories;
        $result['subcategories'] = $subcategories;

        return $result;
    }
}
