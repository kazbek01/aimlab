<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Delivery extends Model
{
    protected $table = 'delivery';
    protected $primaryKey = 'delivery_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
