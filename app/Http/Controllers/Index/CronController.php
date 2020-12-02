<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use Illuminate\Support\Facades\Cache;
use App\Models\Policy;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Unisender\ApiWrapper\UnisenderApi;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Cookie;



class CronController extends Controller
{

    public function clearCache()
    {
        Cache::flush();
    }


}
