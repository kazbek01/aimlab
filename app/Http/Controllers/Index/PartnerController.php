<?php

namespace App\Http\Controllers\Index;

use App\Http\Helpers;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class PartnerController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'partner');

    }

    public function index(Request $request)
    {
        $partner = Partner::select(
                'partner_id',
                'partner_title',
                'partner_image',
                'partner_desc'
            )
            ->orderBy('partner_id', 'desc');

        $partner = $partner->paginate(12);


        return view('index.partner.partner',
            [
                'partner' => $partner
            ]);
    }

    public function show(Request $request, $id)
    {
        $partner = Partner::where('partner_id', $id)
            ->select(
                'partner_id',
                'partner_title',
                'partner_image',
                'partner_desc',
                'partner_text'
            )
            ->first();

        if ($partner == null) abort(404);



        return view('index.partner.partner-detail',
            [
                'partner' => $partner
            ]);
    }


}
