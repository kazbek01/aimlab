<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class AboutController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'about');

    }


    public function show(Request $request)
    {
        $about = About::select(
            'about_id',
            'about_title',
            'about_image',
            'about_desc',
            'about_text'
        )
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        if ($about == null) abort(404);


        return view('index.about.about-detail',
            [
                'about' => $about
            ]);
    }


}
