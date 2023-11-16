<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Validator;
use GuzzleHttp\Client;
use DOMDocument;
use DOMXPath;

class AdminPanelController extends Controller
{

    //HOME
    public function home()
    {

        $sql = " SELECT * FROM cms WHERE language = 'id' AND  menu = 'home' and komponen = 'title' ORDER BY updated_date DESC ";
        $homeTitle = collect(DB::select($sql))->first();


        $sql = " SELECT * FROM cms WHERE language = 'id' AND  menu = 'home' and komponen = 'description' ORDER BY updated_date DESC ";
        $homeDescription = collect(DB::select($sql))->first();


        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'home' and komponen = 'title' ORDER BY updated_date DESC ";
        $homeTitleen = collect(DB::select($sql))->first();


        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'home' and komponen = 'description' ORDER BY updated_date DESC ";
        $homeDescriptionen = collect(DB::select($sql))->first();


        $sql = " SELECT * FROM cms WHERE menu = 'home' and komponen = 'walink' ORDER BY updated_date DESC ";
        $homeWAlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'home' and komponen = 'logo' ORDER BY updated_date DESC ";
        $homeLogo = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'home' and komponen = 'video' ORDER BY updated_date DESC ";
        $homeVideo = collect(DB::select($sql))->first();


        return view('admin.home', compact('homeTitle', 'homeDescription', 'homeTitleen', 'homeDescriptionen', 'homeWAlink', 'homeLogo', 'homeVideo'));
    }

    public function home_post(Request $req)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');
        $code = 404;
        $text = $req->text ?? '';

        //IF LOGO
        if ($req->komponen == 'logo') {

            $validator = Validator::make($req->all(), [
                'imgFile' => 'image|mimes:jpg,jpeg,png,svg,gif|max:4048',
            ]);

            if ($validator->fails()) {
                return redirect()->route('home')->with('error', 'Format file atau Ukuran file tidak sesuai');
            }

            $fileLoc = "";
            $imgFile = $req->file('imgFile');

            if ($imgFile != '') {
                $fileLoc = 'Logo' . time() . '.' . $imgFile->extension();

                $filePath = public_path('/assets/uploads/logo/');

                $imgFile->move($filePath, $fileLoc);
            } else {
                $fileLoc = "";
            }

            $text = $req->text ?? $fileLoc;
        }
        //LOGO

        //IF IMAGE
        if ($req->komponen == 'image') {

            $validator = Validator::make($req->all(), [
                'imgFile' => 'image|mimes:jpg,jpeg,png,svg,gif|max:4048',
            ]);

            if ($validator->fails()) {
                return redirect()->route('home')->with('error', 'Format file atau Ukuran file tidak sesuai');
            }

            $fileLoc = "";
            $imgFile = $req->file('imgFile');

            if ($imgFile != '') {
                $fileLoc = 'Image' . time() . '.' . $imgFile->extension();

                $filePath = public_path('/assets/uploads/image/');

                $imgFile->move($filePath, $fileLoc);
            } else {
                $fileLoc = "";
            }

            $text = $req->text ?? $fileLoc;
        }
        //IMAGE

        //IF VIDEO
        if ($req->komponen == 'video') {

            $validator = Validator::make($req->all(), [
                'videoFile' => 'mimes:mp4,mov,ogg,3gp,avi,wmv',
            ]);

            if ($validator->fails()) {
                return redirect()->route($req->menu ?? $req->menu[0])->with('error', 'Format file atau Ukuran file tidak sesuai');
            }

            $fileLoc = "";
            $videoFile = $req->file('videoFile');
            if ($videoFile != '') {
                $fileLoc = 'Video' . time() . '.' . $videoFile->extension();

                $filePath = public_path('/assets/uploads/video/');
                $videoFile->move($filePath, $fileLoc);
            } else {
                $fileLoc = "";
            }

            $text = $req->text ?? $fileLoc;
        }
        //VIDEO

        if (is_array($req->komponen)) {

            if (count($req->komponen) > 1) {
                for ($i = 0; $i < count($req->komponen); $i++) {
                    $save = DB::insert(" INSERT INTO cms (menu,komponen,language,isi_komponen,updated_by,updated_date) VALUES ('" . $req->menu[$i] . "','" . $req->komponen[$i] . "','" . $req->language[$i] . "','" . $req->text[$i] . "','$user','$date') ON DUPLICATE KEY UPDATE menu = VALUES(menu),komponen = VALUES(komponen),language = VALUES(language),isi_komponen = VALUES(isi_komponen),updated_by = VALUES(updated_by),updated_date = VALUES(updated_date) ");
                }

                if ($save) {
                    return redirect()->route($req->menu[0])->with('success', 'Successfully');
                } else {
                    return redirect()->route($req->menu[0])->with('error', 'Failed');
                }
            }
        }

        $save = DB::insert(" INSERT INTO cms (menu,komponen,language,isi_komponen,updated_by,updated_date) VALUES ('$req->menu','$req->komponen','$req->language','$text','$user','$date') ON DUPLICATE KEY UPDATE menu = VALUES(menu),komponen = VALUES(komponen),isi_komponen = VALUES(isi_komponen),updated_by = VALUES(updated_by),updated_date = VALUES(updated_date) ");


        if ($req->komponen == 'walink' ||  $req->komponen == 'logo' ||  $req->komponen == 'image' || $req->komponen == 'video') {
            if ($save) {
                return redirect()->route($req->menu)->with('success', 'Successfully');
            } else {
                return redirect()->route($req->menu)->with('error', 'Failed');
            }
        } else {
            $code =  ($save ?  200 : $code);

            return response()->json([
                'code' => $code
            ]);
        }
    }

    //END HOME

    //FOOTER
    public function footer()
    {

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'logo' ORDER BY updated_date DESC ";
        $footerLogo = collect(DB::select($sql))->first();   

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'image' ORDER BY updated_date DESC ";
        $footerImage = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'address' ORDER BY updated_date DESC ";
        $footerAddress = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'iglink' ORDER BY updated_date DESC ";
        $footerIGlink = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE menu = 'footer' and komponen = 'lilink' ORDER BY updated_date DESC ";
        $footerLIlink = collect(DB::select($sql))->first();

        return view('admin.footer', compact('footerAddress','footerImage', 'footerLogo', 'footerIGlink', 'footerLIlink'));
    }

    public function service()
    {

        $sqlId = " SELECT * FROM image WHERE menu = 'service' AND language = 'ID' ORDER BY idx ASC ";
        $dataId = DB::select($sqlId);

        $sqlEn = " SELECT * FROM image WHERE menu = 'service' AND language = 'EN' ORDER BY idx ASC ";
        $dataEn = DB::select($sqlEn);

        return view('admin.service', compact('dataId', 'dataEn'));
    }

    public function about()
    {

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'about' and komponen = 'title' ";
        $aboutTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'about' and komponen = 'description' ";
        $aboutDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'about' and komponen = 'title' ";
        $aboutTitleEN = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'about' and komponen = 'description' ";
        $aboutDescriptionEN = collect(DB::select($sql))->first();

        return view('admin.about', compact('aboutTitle', 'aboutDescription', 'aboutTitleEN', 'aboutDescriptionEN'));
    }

    public function ourservice()
    {

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'ourservice' and komponen = 'title' ";
        $ourserviceTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'ourservice' and komponen = 'description' ";
        $ourserviceDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'ourservice' and komponen = 'title' ";
        $ourserviceTitleEN = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'ourservice' and komponen = 'description' ";
        $ourserviceDescriptionEN = collect(DB::select($sql))->first();

        return view('admin.ourservice', compact('ourserviceTitle', 'ourserviceDescription', 'ourserviceTitleEN', 'ourserviceDescriptionEN'));
    }

    public function linkedinmedia()
    {

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'linkedinmedia' and komponen = 'title' ";
        $linkedinmediaTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'linkedinmedia' and komponen = 'description' ";
        $linkedinmediaDescription = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'linkedinmedia' and komponen = 'title' ";
        $linkedinmediaTitleEN = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'linkedinmedia' and komponen = 'description' ";
        $linkedinmediaDescriptionEN = collect(DB::select($sql))->first();

        return view('admin.linkedinmedia', compact('linkedinmediaTitle', 'linkedinmediaDescription', 'linkedinmediaTitleEN', 'linkedinmediaDescriptionEN'));
    }

    public function image()
    {

        $sql = " SELECT * FROM cms WHERE language = 'id' AND menu = 'aboutimage' and komponen = 'title' ";
        $aboutimageTitle = collect(DB::select($sql))->first();

        $sql = " SELECT * FROM cms WHERE language = 'en' AND menu = 'aboutimage' and komponen = 'title' ";
        $aboutimageTitleEN = collect(DB::select($sql))->first();

        $sqlId = " SELECT * FROM image WHERE menu = 'image' AND language = 'ID' ORDER BY idx ASC ";
        $dataId = DB::select($sqlId);

        $sqlEn = " SELECT * FROM image WHERE menu = 'image' AND language = 'EN' ORDER BY idx ASC ";
        $dataEn = DB::select($sqlEn);


        return view('admin.image', compact('dataId', 'dataEn', 'aboutimageTitle', 'aboutimageTitleEN'));
    }

    public function image_post(Request $req)
    {

        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');

        $validator = Validator::make($req->all(), [
            'imgFile' => 'image|mimes:jpg,jpeg,png,svg,gif|max:4048',
        ]);

        if ($validator->fails()) {
            return redirect()->route($req->menu)->with('error', 'Format file atau Ukuran file tidak sesuai');
        }

        $image = "";
        $imgFile = $req->file('imgFile');

        if ($imgFile != '') {
            $image = 'Image' . time() . '.' . $imgFile->extension();

            $filePath = public_path('/assets/uploads/image/');

            $imgFile->move($filePath, $image);
        } else {
            $image = "";
        }

        if ($req->image_id != '') {
            if ($image != '') {
                $sqlUpd = DB::update(" UPDATE image SET  image_title = '" . $req->image_title . "', image = '" . $image . "', status = '" . $req->status . "', language = '" . $req->language . "',  menu = '" . $req->menu . "', image_description = '" . $req->image_description . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  image_id = '" . $req->image_id . "' ");
            } else {
                $sqlUpd = DB::update(" UPDATE image SET  image_title = '" . $req->image_title . "',  status = '" . $req->status . "', language = '" . $req->language . "',  menu = '" . $req->menu . "', image_description = '" . $req->image_description . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  image_id = '" . $req->image_id . "' ");
            }
            if ($sqlUpd) {
                return redirect()->route($req->menu)->with('success', 'Successfully');
            } else {

                return redirect()->route($req->menu)->with('error', 'Failed');
            }
        }



        $sqlIns = DB::insert(" INSERT INTO image (  image_title, image, status, language,menu, image_description,  updated_by, updated_date ) VALUES ( '" . $req->image_title . "' , '" . $image . "', '" . $req->status . "', '" . $req->language . "','" . $req->menu . "' , '" . $req->image_description . "' , '" . $user . "', '" . $date . "' ) ");

        if ($sqlIns) {
            return redirect()->route($req->menu)->with('success', 'Successfully');
        } else {

            return redirect()->route($req->menu)->with('error', 'Failed');
        }
    }

    public function image_order(Request $req)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');
        $code = 404;
        $countData = count($req->roworder);

        for ($i = 0; $i < $countData; $i++) {
            $roworderArr = explode('-', $req->roworder[$i]);
            $id = $roworderArr[0];
            $idx = $roworderArr[1];
            $sqlUpd = DB::update(" UPDATE image SET  idx = '" . $idx . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  image_id = '" . $id . "' AND language = '".$req->lang."' ");
        }

        $code =  ($sqlUpd ?  200 : $code);

        return response()->json([
            'code' => $code
        ]);
    }

    public function image_delete($image_id, $menu)
    {

        $sqlDel = DB::update(" DELETE FROM image WHERE image_id = '" . $image_id . "' ");

        if ($sqlDel) {

            return redirect()->route($menu)->with('success', 'Successfully');
        } else {

            return redirect()->route($menu)->with('error', 'Failed');
        }
    }

    //MASTER DATA
    public function linkedin()
    {
        $sql = " SELECT * FROM image WHERE menu = 'linkedin' ORDER BY updated_date,language DESC ";
        $data = DB::select($sql);

        return view('admin.linkedin', compact('data'));
    }

    public function linkedin_post(Request $req)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');


        $sqlIns = DB::insert(" INSERT INTO image (  image_title, embed, status, menu,   updated_by, updated_date ) VALUES ( '" . $req->image_title . "' ,'" . $req->urlEmbed . "' ,  'Publish', '" . $req->menu . "' , '" . $user . "', '" . $date . "' ) ");


        if ($sqlIns) {
            $this->scrapping($req->urlEmbed, $req->image_title);
            return redirect()->route('linkedin')->with('success', 'Successfully');
        } else {
            return redirect()->route('linkedin')->with('error', 'Failed');
        }
    }


    public function scrapping($url, $title)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');


        $client = new Client();

        $response = $client->request('GET', $url);
        $html = (string) $response->getBody();

        // Use DOMDocument to parse the HTML
        $dom = new DOMDocument();
        @$dom->loadHTML($html); // Use '@' to suppress warnings for invalid HTML

        $xpath = new DOMXPath($dom);

        // Get elements with the class "example-class"
        $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' attributed-text-segment-list__content ')]");

        $matchingElements = "";

        foreach ($elements as $element) {
            $matchingElements .= $element->nodeValue;
        }

        // Get elements with the class "example-class"
        $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' lazy-load ')]");

        $matchingElementsImg = "";

        foreach ($elements as $element) {
            $matchingElementsImg .= $element->getAttribute('data-delayed-url');
        }


        DB::update(" UPDATE image SET  image = '" . $matchingElementsImg . "',  image_description = '" . $matchingElements . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  image_title = '" . $title . "' ");

    }


    //MASTER DATA
    public function client()
    {
        $sql = "SELECT * FROM client  ORDER BY client_id DESC ";
        $data = DB::select($sql);

        return view('admin.client', compact('data'));
    }

    public function client_post(Request $req)
    {

        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');

        $validator = Validator::make($req->all(), [
            'imgFile' => 'image|mimes:jpg,jpeg,png,svg,gif|max:4048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('client')->with('error', 'Format file atau Ukuran file tidak sesuai');
        }

        $clientLogo = "";
        $imgFile = $req->file('imgFile');

        if ($imgFile != '') {
            $clientLogo = 'Client' . time() . '.' . $imgFile->extension();

            $filePath = public_path('/assets/uploads/clients/');

            $imgFile->move($filePath, $clientLogo);
        } else {
            $clientLogo = "";
        }

        if ($req->client_id != '') {
            if ($clientLogo != '') {
                $sqlUpd = DB::update(" UPDATE client SET  client_id = '" . $req->client_id . "',  client_name = '" . $req->client_name . "', client_logo = '" . $clientLogo . "', status = '" . $req->status . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  client_id = '" . $req->client_id . "' ");
            } else {
                $sqlUpd = DB::update(" UPDATE client SET  client_id = '" . $req->client_id . "',  client_name = '" . $req->client_name . "',  status = '" . $req->status . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  client_id = '" . $req->client_id . "' ");
            }
            if ($sqlUpd) {
                return redirect()->route('client')->with('success', 'Successfully');
            } else {

                return redirect()->route('client')->with('error', 'Failed');
            }
        }


        $sqlIns = DB::insert(" INSERT INTO client (  client_name, client_logo, status,  updated_by, updated_date ) VALUES ( '" . $req->client_name . "' , '" . $clientLogo . "', '" . $req->status . "','" . $user . "', '" . $date . "' ) ");

        if ($sqlIns) {
            return redirect()->route('client')->with('success', 'Successfully');
        } else {

            return redirect()->route('client')->with('error', 'Failed');
        }
    }

    public function client_delete($client_id)
    {

        $sqlDel = DB::update(" DELETE FROM client WHERE client_id = '" . $client_id . "' ");

        if ($sqlDel) {

            return redirect()->route('client')->with('success', 'Successfully');
        } else {

            return redirect()->route('client')->with('error', 'Failed');
        }
    }

    public function subscriber(){

        $sql = " SELECT * FROM subscriber ";
        $data = DB::select($sql);

        return view('admin.subscriber', compact('data'));

    }

    public function subscriber_delete($email)
    {

        $sqlDel = DB::update(" DELETE FROM subscriber WHERE email = '" . $email . "' ");

        if ($sqlDel) {

            return redirect()->route('subscriber')->with('success', 'Successfully');
        } else {

            return redirect()->route('subscriber')->with('error', 'Failed');
        }
    }
}
