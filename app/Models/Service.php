<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'service_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
