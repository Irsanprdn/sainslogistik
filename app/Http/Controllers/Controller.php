<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\WBS;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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

        $sql = " SELECT * FROM image WHERE language = 'id' AND menu = 'image' AND status = 'Publish' ORDER BY idx ASC";
        $aboutSlide = DB::select($sql);

        $sql = " SELECT * FROM image WHERE language = 'id' AND menu = 'service' AND status = 'Publish' ORDER BY idx ASC";
        $dataService = DB::select($sql);

        $sql = " SELECT * FROM image WHERE menu = 'linkedin' ORDER BY idx ASC ";
        $dataLinkedin = DB::select($sql);

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'ourservice' and komponen = 'title' ";
        $ourserviceTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'ourservice' and komponen = 'description' ";
        $ourserviceDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'linkedinmedia' and komponen = 'title' ";
        $linkedinmediaTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'linkedinmedia' and komponen = 'description' ";
        $linkedinmediaDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'aboutimage' and komponen = 'title' ";
        $aboutimageTitle = collect(DB::select($sql))->first();


        return view('index', compact('homeTitle', 'homeDescription', 'homeWAlink', 'homeLogo', 'homeVideo', 'footerAddress', 'footerDescription', 'footerLogo', 'footerIGlink', 'footerLIlink', 'ourClient', 'aboutTitle', 'aboutDescription', 'aboutSlide', 'dataService', 'dataLinkedin', 'ourserviceTitle', 'ourserviceDescription', 'linkedinmediaTitle', 'linkedinmediaDescription', 'aboutimageTitle'));
    }

    public function comproLanguage($language)
    {

        if (!in_array($language, ['en', 'id', 'cms_site', 'subscriber'])) {
            return redirect()->route('compro');
        }

        if ($language == 'cms_site') {
            return redirect()->route('login');
        }

        App::setLocale($language);

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'home' and komponen = 'title'  ";
        $homeTitle = collect(DB::select($sql))->first();


        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'home' and komponen = 'description'  ";
        $homeDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'walink'  ";
        $homeWAlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'logo'  ";
        $homeLogo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'home' and komponen = 'video'  ";
        $homeVideo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'logo'  ";
        $footerLogo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'footer' and komponen = 'description'  ";
        $footerDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'address'  ";
        $footerAddress = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'iglink'  ";
        $footerIGlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE IFNULL(isi_komponen,'') <> '' AND menu = 'footer' and komponen = 'lilink'  ";
        $footerLIlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'about' and komponen = 'title'  ";
        $aboutTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'about' and komponen = 'description'  ";
        $aboutDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM client WHERE status = 'publish'  ";
        $ourClient = DB::select($sql);

        $sql = " SELECT * FROM image WHERE status = 'publish' AND language = '$language' AND menu = 'image' AND status = 'Publish'";
        $aboutSlide = DB::select($sql);

        $sql = " SELECT * FROM image WHERE status = 'publish' AND language = '$language' AND menu = 'service' AND status = 'Publish' ORDER BY idx ASC ";
        $dataService = DB::select($sql);

        $sql = " SELECT * FROM image WHERE menu = 'linkedin' ORDER BY idx ASC  ";
        $dataLinkedin = DB::select($sql);

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'ourservice' and komponen = 'title' ";
        $ourserviceTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'ourservice' and komponen = 'description' ";
        $ourserviceDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'linkedinmedia' and komponen = 'title' ";
        $linkedinmediaTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'linkedinmedia' and komponen = 'description' ";
        $linkedinmediaDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = '$language' AND menu = 'aboutimage' and komponen = 'title' ";
        $aboutimageTitle = collect(DB::select($sql))->first();


        return view('index', compact('homeTitle', 'homeDescription', 'homeWAlink', 'homeLogo', 'homeVideo', 'footerAddress', 'footerDescription', 'footerLogo', 'footerIGlink', 'footerLIlink', 'ourClient', 'aboutTitle', 'aboutDescription', 'aboutSlide', 'dataService', 'dataLinkedin', 'ourserviceTitle', 'ourserviceDescription', 'linkedinmediaTitle', 'linkedinmediaDescription', 'aboutimageTitle'));
    }

    public function subscriberMail(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        try {
            $save = DB::insert(" INSERT INTO subscriber (email,created_at) VALUES ('" . $request->email . "', '" . $date . "') ");
        if ($save) {
            return redirect()->route('compro')->with('success', 'Successfully');
        } else {

            return redirect()->route('compro')->with('error', 'Failed');
        }
        } catch (\Throwable $th) {
            return redirect()->route('compro')->with('success', 'Your email already exist');
        }
        
    }
}
