<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $primaryKey = 'product_category_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
