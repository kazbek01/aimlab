<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ProductImage extends Model
{
    protected $table = 'product_image';
    protected $primaryKey = 'product_image_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
