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

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'home' and komponen = 'title' ";
        $homeTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'home' and komponen = 'description' ";
        $homeDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'walink' ";
        $homeWAlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'logo' ";
        $homeLogo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'video' ";
        $homeVideo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'logo' ";
        $footerLogo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'footer' and komponen = 'description' ";
        $footerDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'address' ";
        $footerAddress = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'iglink' ";
        $footerIGlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'lilink' ";
        $footerLIlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM client WHERE status = 'publish' ";
        $ourClient = DB::select($sql);

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'about' and komponen = 'title' ";
        $aboutTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'about' and komponen = 'description' ";
        $aboutDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM image WHERE language = 'id' AND menu = 'image' ";
        $aboutSlide = DB::select($sql);

        $sql = " SELECT * FROM image WHERE language = 'id' AND menu = 'service' ";
        $dataService = DB::select($sql);

        return view('index', compact('homeTitle', 'homeDescription', 'homeWAlink', 'homeLogo', 'homeVideo', 'footerAddress', 'footerDescription', 'footerLogo', 'footerIGlink', 'footerLIlink', 'ourClient', 'aboutTitle', 'aboutDescription', 'aboutSlide', 'dataService'));
    }

    public function comproLanguage($language)
    {

        if ($language == 'cms_site') {
            return redirect()->route('login');
        }

        if ($language == 'en' || $language == 'id') {

            $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'home' and komponen = 'title' ORDER BY updated_date DESC ";
            $homeTitle = collect(DB::select($sql))->first();


            $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'home' and komponen = 'description' ORDER BY updated_date DESC ";
            $homeDescription = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'walink' ORDER BY updated_date DESC ";
            $homeWAlink = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'logo' ORDER BY updated_date DESC ";
            $homeLogo = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'video' ORDER BY updated_date DESC ";
            $homeVideo = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'logo' ORDER BY updated_date DESC ";
            $footerLogo = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'footer' and komponen = 'description' ORDER BY updated_date DESC ";
            $footerDescription = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'address' ORDER BY updated_date DESC ";
            $footerAddress = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'iglink' ORDER BY updated_date DESC ";
            $footerIGlink = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'lilink' ORDER BY updated_date DESC ";
            $footerLIlink = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'about' and komponen = 'title' ORDER BY updated_date DESC ";
            $aboutTitle = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'about' and komponen = 'description' ORDER BY updated_date DESC ";
            $aboutDescription = collect(DB::select($sql))->first();

            $sql = " SELECT * FROM client WHERE status = 'publish' ORDER BY updated_date DESC ";
            $ourClient = DB::select($sql);

            $sql = " SELECT * FROM image WHERE status = 'publish' AND language = '$language' AND menu = 'image' ORDER BY updated_date,language DESC ";
            $aboutSlide = DB::select($sql);

            $sql = " SELECT * FROM image WHERE status = 'publish' AND language = '$language' AND menu = 'service' ORDER BY updated_date,language DESC ";
            $dataService = DB::select($sql);

            return view('index', compact('homeTitle', 'homeDescription', 'homeWAlink', 'homeLogo', 'homeVideo', 'footerAddress', 'footerDescription', 'footerLogo', 'footerIGlink', 'footerLIlink', 'ourClient', 'aboutTitle', 'aboutDescription', 'aboutSlide', 'dataService'));
        }else{
            return redirect()->route('compro');
        }
    }
}
