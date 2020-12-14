<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class OrderInfo extends Model
{
    protected $table = 'order_info';
    protected $primaryKey = 'order_info_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
