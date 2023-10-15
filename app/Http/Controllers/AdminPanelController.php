<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Validator;

class AdminPanelController extends Controller
{

    //HOME
    public function home()
    {

        $sql = "SELECT * FROM home WHERE is_delete = 'N' ORDER BY idx ASC";
        $data = DB::select($sql);

        $sql = "SELECT * FROM basic_data WHERE is_delete = 'N' AND  group_id= '999999'  ORDER BY data_id ASC";
        $dataSosmed = DB::select($sql);

        return view('admin.home', compact('data', 'dataSosmed'));
    }

    public function home_edit(Request $req)
    {
        $code = 404;
        $sql = "SELECT * FROM home WHERE is_delete = 'N' AND home_id = '" . $req->id . "' ";
        $data = collect(DB::select($sql))->first();

        $code =  ($data ?  200 : $code);

        return response()->json([
            'code' => $code,
            'data' => $data
        ]);
    }

    public function home_post(Request $req)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');

        $validator = Validator::make($req->all(), [
            'imgFile' => 'image|mimes:jpg,jpeg,png,svg,gif|max:4048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->with('error', 'Format file atau Ukuran file tidak sesuai');
        }

        $slide = "";
        $image = $req->file('imgFile');
        if ($image != '') {

            $slide = time() . '.' . $image->extension();

            $filePath = public_path('/uploads/slider/');
            $img = Image::make($image->path());
            $img->resize(1600, 900, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $slide);
        } else {
            $slide = "";
        }

        if ($req->id == 0) {

            $save = DB::insert(" INSERT INTO home ( slide,idx,status,updated_by,updated_date ) VALUES ( '" . $slide . "', '" . $req->idx . "', '" . $req->status . "', '" . $user . "', '" . $date . "' ) ");
        } else {

            if ($slide == "") {
                $save = DB::update(" UPDATE home SET idx = '" . $req->idx . "',status = '" . $req->status . "',updated_by = '" . $user . "',updated_date = '" . $date . "' WHERE home_id = '" . $req->id . "' ");
            } else {
                $save = DB::update(" UPDATE home SET slide = '" . $slide . "',idx = '" . $req->idx . "',status = '" . $req->status . "',updated_by = '" . $user . "',updated_date = '" . $date . "' WHERE home_id = '" . $req->id . "' ");
            }
        }

        if ($save) {

            return redirect()->route('home')->with('success', 'Data berhasil disimpan');
        } else {

            return redirect()->route('home')->with('error', 'Data gagal disimpan');
        }
    }

    public function home_delete($id)
    {

        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');
        $sqlUpd = DB::update(" UPDATE home SET  is_delete = 'Y', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  is_delete = 'N' AND home_id = '" . $id . "'  ");

        if ($sqlUpd) {
            return redirect()->route('home')->with('success', 'Data berhasil dihapus');
        } else {

            return redirect()->route('home')->with('error', 'Data gagal dihapus');
        }
    }

    public function home_socmed_post(Request $req)
    {

        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');
        $sqlUpd = true;

        $input = $req->all();

        foreach ($input as $key => $value) {

            $sqlUpd = DB::update(" UPDATE basic_data SET  note = '" . $value . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  is_delete = 'N' AND group_id = '999999' AND  data_id = '" . $key . "' ");
            if (!$sqlUpd) {
                $sqlUpd = false;
            }
        }

        if ($sqlUpd) {
            return redirect()->route('home')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('home')->with('error', 'Data gagal diubah');
        }
    }


    //ABOUT
    public function about()
    {

        $sql = "SELECT * FROM about WHERE is_delete = 'N' AND about_id = '1' ";
        $data1 = collect(DB::select($sql))->first();

        $sql = "SELECT * FROM about WHERE is_delete = 'N' AND about_id = '2' ";
        $data2 = collect(DB::select($sql))->first();

        return view('admin.about_us', compact('data1', 'data2'));
    }

    public function about_post(Request $req)
    {

        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');

        $validator = Validator::make($req->all(), [
            'imgFile' => 'image|mimes:jpg,jpeg,png,svg,gif|max:4048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->with('error', 'Format file atau Ukuran file tidak sesuai');
        }

        $so = "";
        $image = $req->file('imgFile');
        if ($image != '') {

            $so = time() . '.' . $image->extension();

            $filePath = public_path('/uploads/so/');
            $img = Image::make($image->path());
            $img->resize(1600, 900, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $so);
        } else {
            $so = "";
        }

        if ($req->title1 != '') {
            $sqlUpd = DB::update(" UPDATE about SET  title = '" . $req->title1 . "',  description = '" . $req->description1 . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  is_delete = 'N' AND about_id = '1' ");
        }
        if ($req->title2) {
            if ($so == '') {
                $sqlUpd = DB::update(" UPDATE about SET  title = '" . $req->title2 . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  is_delete = 'N' AND about_id = '2' ");
            } else {
                $sqlUpd = DB::update(" UPDATE about SET  title = '" . $req->title2 . "',  description = '" . $so . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  is_delete = 'N' AND about_id = '2' ");
            }
        }

        if ($sqlUpd) {
            return redirect()->route('about')->with('success', 'Data berhasil dihapus');
        } else {

            return redirect()->route('about')->with('error', 'Data gagal dihapus');
        }
    }


    // ACTIVITY
    public function activity()
    {

        $sql = "SELECT * FROM activity WHERE is_delete = 'N' ORDER BY idx ASC";
        $data = DB::select($sql);

        return view('admin.activity', compact('data'));
    }

    public function activity_edit(Request $req)
    {
        $code = 404;
        $sql = "SELECT * FROM activity WHERE is_delete = 'N' AND activity_id = '" . $req->id . "' ";
        $data = collect(DB::select($sql))->first();

        $code =  ($data ?  200 : $code);

        return response()->json([
            'code' => $code,
            'data' => $data
        ]);
    }

    public function activity_post(Request $req)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');

        $validator = Validator::make($req->all(), [
            'imgFile' => 'image|mimes:jpg,jpeg,png,svg,gif|max:4048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('activity')->with('error', 'Format file atau Ukuran file tidak sesuai');
        }

        $slide = "";
        $image = $req->file('imgFile');
        if ($image != '') {

            $slide = time() . '.' . $image->extension();

            $filePath = public_path('/uploads/activity/');
            $img = Image::make($image->path());
            $img->resize(500, 500, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $slide);
        } else {
            $slide = "";
        }

        if ($req->id == 0) {

            $save = DB::insert(" INSERT INTO activity ( image,idx,status,updated_by,updated_date ) VALUES ( '" . $slide . "', '" . $req->idx . "', '" . $req->status . "', '" . $user . "', '" . $date . "' ) ");
        } else {

            if ($slide == "") {
                $save = DB::update(" UPDATE activity SET idx = '" . $req->idx . "',status = '" . $req->status . "',updated_by = '" . $user . "',updated_date = '" . $date . "' WHERE activity_id = '" . $req->id . "' ");
            } else {
                $save = DB::update(" UPDATE activity SET image = '" . $slide . "',idx = '" . $req->idx . "',status = '" . $req->status . "',updated_by = '" . $user . "',updated_date = '" . $date . "' WHERE activity_id = '" . $req->id . "' ");
            }
        }

        if ($save) {

            return redirect()->route('activity')->with('success', 'Data berhasil disimpan');
        } else {

            return redirect()->route('activity')->with('error', 'Data gagal disimpan');
        }
    }

    public function activity_delete($id)
    {

        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');
        $sqlUpd = DB::update(" UPDATE activity SET  is_delete = 'Y', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  is_delete = 'N' AND activity_id = '" . $id . "'  ");

        if ($sqlUpd) {
            return redirect()->route('activity')->with('success', 'Data berhasil dihapus');
        } else {

            return redirect()->route('activity')->with('error', 'Data gagal dihapus');
        }
    }


    //CONTACT
    public function contact()
    {

        $sql = "SELECT * FROM contact WHERE is_delete = 'N' ORDER BY contact_id ASC";
        $data = DB::select($sql);

        return view('admin.contact', compact('data'));
    }

    public function contact_post(Request $req)
    {
        // dd($req);
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');
        $sqlUpdAll = true;

        for ($i = 0; $i < count($req->name); $i++) {

            $query = " UPDATE contact SET  name = ?,  link_name = ?, updated_by = ?, updated_date =  ? WHERE is_delete = 'N' AND  contact_id = ?  ";

            $params = [$req->name[$i], $req->link_name[$i], $user, $date, $req->contact_id[$i]];

            $sqlUpd = DB::update($query, $params);

            if (!$sqlUpd) {
                $sqlUpdAll = false;
            }
        }

        if ($sqlUpdAll) {
            return redirect()->route('contact')->with('success', 'Data berhasil diubah');
        } else {

            return redirect()->route('contact')->with('error', 'Data gagal diubah');
        }
    }


    //MASTER DATA
    public function master_data()
    {
        // AND group_id < 900000
        $sql = "SELECT * FROM basic_data WHERE is_delete = 'N'  ORDER BY group_id,data_id DESC";
        $data = DB::select($sql);

        $sqListGroup = "SELECT group_id,group_name FROM basic_data WHERE is_delete = 'N' GROUP BY group_id,group_name ";
        $dataListGroup = DB::select($sqListGroup);

        return view('admin.master_data', compact('data', 'dataListGroup'));
    }

    public function master_data_edit(Request $req)
    {
        $data = "";
        $code = 404;

        $sql = "SELECT * FROM basic_data WHERE is_delete = 'N' AND group_id = '" . $req->groupId . "' AND data_id = '" . $req->dataId . "' ";
        $data = DB::select($sql);

        $code =  ($data ?  200 : $code);

        return response()->json([
            'data' => $data,
            'code' => $code
        ]);
    }

    public function master_data_post(Request $req)
    {
        $groupId =  "";
        $groupName =  "";
        $dataId =  "";

        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');


        if ($req->groupId != '') {

            $sqlUpd = DB::update(" UPDATE basic_data SET  group_id = '" . $req->groupId . "',  data_name = '" . $req->data . "', note = '" . $req->note . "', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE is_delete = 'N' AND  group_id = '" . $req->groupId . "' AND data_id = '" . $req->dataId . "' ");

            if ($sqlUpd) {
                return redirect()->route('master_data')->with('success', 'Data berhasil diubah');
            } else {

                return redirect()->route('master_data')->with('error', 'Data gagal diubah');
            }
        }


        if ($req->grup == 'another') {
            $dataLastGroup = collect(DB::select(" SELECT group_id FROM basic_data WHERE is_delete = 'N' GROUP BY group_id ORDER BY group_id DESC "))->first();
            $groupId = $dataLastGroup->group_id ?? '';
            $groupId = ($groupId == '' ? '000001' : (new Controller)->autoNumber($groupId));
            $groupName =  $req->newGroup;

            $dataId =  "000001";
        } else {

            $grupArr = explode('!', $req->grup);
            $groupId =  $grupArr[0];
            $groupName =  $grupArr[1];

            $dataLastBasic = collect(DB::select(" SELECT data_id FROM basic_data WHERE is_delete = 'N' AND group_id = '" . $groupId . "' GROUP BY data_id ORDER BY data_id DESC "))->first();
            $dataId = $dataLastBasic->data_id ?? '';
            $dataId = ($dataId == '' ? '000001' : (new Controller)->autoNumber($dataId));
        }



        $sqlIns = DB::insert(" INSERT INTO basic_data ( group_id, group_name, data_id, data_name, note, updated_by, updated_date ) VALUES ('" . $groupId . "', '" . $groupName . "' , '" . $dataId . "', '" . $req->data . "', '" . $req->note . "', '" . $user . "', '" . $date . "' ) ");

        if ($sqlIns) {

            return redirect()->route('master_data')->with('success', 'Data berhasil disimpan');
        } else {

            return redirect()->route('master_data')->with('error', 'Data gagal disimpan');
        }
    }

    public function master_data_delete($groupId, $dataId)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');
        $sqlUpd = DB::update(" UPDATE basic_data SET  is_delete = 'Y', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  is_delete = 'N' AND group_id = '" . $groupId . "' AND data_id = '" . $dataId . "' ");

        if ($sqlUpd) {

            return redirect()->route('master_data')->with('success', 'Data berhasil dihapus');
        } else {

            return redirect()->route('master_data')->with('error', 'Data gagal dihapus');
        }
    }
}
