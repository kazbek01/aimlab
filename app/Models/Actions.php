<?php

namespace App\Models;

use App\Http\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Actions extends Model
{
    protected $table = 'actions';
    protected $primaryKey = 'action_id';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
