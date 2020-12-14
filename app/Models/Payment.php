<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'payment_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
