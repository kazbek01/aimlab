<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class ServiceController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'service');

    }

    public function index(Request $request)
    {
        $service = Service::where('is_show', 1)
            ->select(
                'service_id',
                'service_name',
                'service_image',
                'service_desc'
            )
            ->orderBy('service_id', 'desc');

        $service = $service->paginate(12);


        return view('index.service.service',
            [
                'service' => $service
            ]);
    }

    public function show(Request $request, $id)
    {
        $service = Service::where('service_id', $id)
            ->where('is_show', 1)
            ->select(
                'service_id',
                'service_name',
                'service_image',
                'service_desc',
                'service_text'
            )
            ->first();



        return view('index.service.service-detail',
            [
                'service' => $service
            ]);
    }


}
