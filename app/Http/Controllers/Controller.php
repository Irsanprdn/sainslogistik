<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\WBS;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function compro()
    {

        $sql = " SELECT * FROM cms WHERE menu = 'home' and komponen = 'title' ";
        $homeTitle = collect(DB::select($sql))->first();


        $sql = " SELECT * FROM cms WHERE menu = 'home' and komponen = 'description' ";
        $homeDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'home' and komponen = 'walink' ";
        $homeWAlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'home' and komponen = 'logo' ";
        $homeLogo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'home' and komponen = 'video' ";
        $homeVideo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'logo' ";
        $footerLogo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'description' ";
        $footerDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'address' ";
        $footerAddress = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'iglink' ";
        $footerIGlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'lilink' ";
        $footerLIlink = collect(DB::select($sql))->first();


        return view('index', compact('homeTitle', 'homeDescription', 'homeWAlink', 'homeLogo', 'homeVideo', 'footerAddress', 'footerDescription','footerLogo','footerIGlink', 'footerLIlink' ));
    }


    public function autoNumber($id)
    {
        $id = (int)$id + 1;
        return sprintf("%06s", $id);
    }
}
