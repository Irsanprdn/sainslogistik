<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\WBSImport;
use App\Models\WBS;
use Maatwebsite\Excel\Facades\Excel;
use Image;
use Validator;
use App\Exports\WBSExport;
use App\Exports\WBSExportStatus;

class WBSController extends Controller
{

    public function wbs_data()
    {
        $data = WBS::select(
            DB::raw('nomor_panti, nama,
            jenis_kelamin,
            umur,
            status,
            pendidikan,
            tanggal_masuk,
            agama,
            asal,
            domisili,
            alamat,
            hasil_jangkauan,
            status_pernikahan,
            klasifikasi,
            lokasi,
            sumber,
            link_berkas,
            foto,
            wbs.updated_by,
            wbs.updated_date,
            wbs.is_delete,
            riwayat_rumah_sakit, 
            bukti_riwayat,
            wisma,
            IFNULL(`bsAgama`.data_name,agama) as agamaNm,
            IFNULL(`bsJK`.data_name,jenis_kelamin) as jkNm, 
            IFNULL(`bsPendidikan`.data_name,pendidikan) as pendidikanNm, 
            IFNULL(`bsHJ`.data_name,hasil_jangkauan) as hjNm, 
            IFNULL(`bsSP`.data_name,status_pernikahan) as spNm, 
            IFNULL(`bsStatus`.data_name,status) as statusNm,
            IFNULL(`kotaAsal`.name,asal) as asalNm ,
            IFNULL(`kotaDomisili`.name,domisili) as domisiliNm   
            ')

        )
            ->leftJoin('basic_data as bsAgama', function ($join1) {
                $join1->on('bsAgama.group_id', '=', DB::raw("'000001'"));
                $join1->on('wbs.agama', '=', 'bsAgama.data_id');
            })
            ->leftJoin('basic_data as bsJK', function ($join2) {
                $join2->on('bsJK.group_id', '=', DB::raw("'000002'"));
                $join2->on('wbs.jenis_kelamin', '=', 'bsJK.data_id');
            })
            ->leftJoin('basic_data as bsPendidikan', function ($join3) {
                $join3->on('bsPendidikan.group_id', '=', DB::raw("'000003'"));
                $join3->on('wbs.pendidikan', '=', 'bsPendidikan.data_id');
            })
            ->leftJoin('basic_data as bsHJ', function ($join4) {
                $join4->on('bsHJ.group_id', '=', DB::raw("'000004'"));
                $join4->on('wbs.hasil_jangkauan', '=', 'bsHJ.data_id');
            })
            ->leftJoin('basic_data as bsSP', function ($join5) {
                $join5->on('bsSP.group_id', '=', DB::raw("'000005'"));
                $join5->on('wbs.status_pernikahan', '=', 'bsSP.data_id');
            })
            ->leftJoin('basic_data as bsStatus', function ($join6) {
                $join6->on('bsStatus.group_id', '=', DB::raw("'000006'"));
                $join6->on('wbs.status', '=', 'bsStatus.data_id');
            })
            ->leftJoin('regencies as kotaAsal', function ($join6) {
                $join6->on('wbs.asal', '=', 'kotaAsal.id');
            })
            ->leftJoin('regencies as kotaDomisili', function ($join6) {
                $join6->on('wbs.domisili', '=', 'kotaDomisili.id');
            })
            ->where('wbs.is_delete', 'N')->orderBy('tanggal_masuk', 'DESC')->get();

        $dataStatus =  DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000006' ");

        return view('admin.wbs_data', compact('data', 'dataStatus'));
    }

    public function wbs_data_export(Request $req)
    {
        if ( isset($req->status) ) {
            if ( $req->status == '' ) {
                return redirect()->route('wbs_data')->with('error', 'Filter tidak boleh kosong');
            }
            return Excel::download(new WBSExportStatus($req->status), 'status_data.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }else{
            if ( $req->year == '' || $req->status == '') {
                return redirect()->route('wbs_data')->with('error', 'Filter tidak boleh kosong');
            }
            return Excel::download(new WBSExport($req->year ?? date('Y')), 'monthly_data.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
    }

    public function wbs_data_input($id)
    {
        $dataAgama =  DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000001' ");

        $dataJK =  DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000002' ");

        $dataPendidikan =  DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000003' ");

        $dataHJ =  DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000004' ");

        $dataSP =  DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000005' ");

        $dataStatus =  DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000006' ");

        $dataKota =  DB::select(" SELECT id,name FROM regencies ");

        $data = "";

        if ($id > 0) {
            $data = WBS::where('wbs.is_delete', 'N')->where('wbs.nomor_panti', $id)->first();
        }

        return view('admin.wbs_data.create', compact('dataAgama', 'dataJK', 'dataPendidikan', 'dataHJ', 'dataSP', 'dataStatus', 'id', 'dataKota', 'data'));
    }

    public function wbs_data_post(Request $req, $id)
    {
        $input = $req->all();
        $validator = Validator::make($req->all(), [
            'imgFile' => 'image|mimes:jpg,jpeg,png,svg,gif|max:4048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('wbs')->with('error', 'Format file atau Ukuran file tidak sesuai');
        }

        $validator2 = Validator::make($req->all(), [
            'buktiRiwayat' => 'image|mimes:jpg,jpeg,png,svg,gif,pdf|max:5048',
        ]);

        if ($validator2->fails()) {
            return redirect()->route('wbs')->with('error', 'Format file atau Ukuran file tidak sesuai');
        }

        $image = $req->file('imgFile');
        if ($image != '') {

            $input['foto'] = 'WBS' . time() . '.' . $image->extension();

            $filePath = public_path('/uploads/foto_WBS/');
            $img = Image::make($image->path());
            $img->resize(720,1080, function ($const) {
                $const->aspectRatio();
            })->save($filePath . '/' . $input['foto']);
        } else {
            $input['foto'] = "";
        }

        $buktiRiwayat = $req->file('buktiRiwayat');
        if ($buktiRiwayat != '') {
            $input['bukti_riwayat'] = 'BUKTI_RIWAYAT_RUMAH_SAKIT' . time() . '.' . $buktiRiwayat->extension();

            $filePath = public_path('/uploads/bukti_riwayat_rumah_sakit/');
            
            $buktiRiwayat->move($filePath, $input['bukti_riwayat']);
        }else{
            $input['bukti_riwayat'] = "";
        }

        $input['sumber']  = "Input";
        $input['updated_date'] = date('Y-m-d H:i:s');

        if ($id == 0) { //create
            $save = WBS::create($input);
        } else { //update
            if ($input['foto'] == '') {
                unset($input['foto']);
            }

            if ($input['bukti_riwayat'] == '') {
                unset($input['bukti_riwayat']);
            }

            if ($input['asal'] == '') {
                unset($input['asal']);
            }

            if ($input['domisili'] == '') {
                unset($input['domisili']);
            }

            if ($input['_token'] != '') {
                unset($input['_token']);
            }

            unset($input['imgFile']);
            unset($input['buktiRiwayat']);

            $save = WBS::where("nomor_panti", $id)->update($input);
        }

        if ($save) {
            return redirect()->route('wbs_data')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('wbs_data')->with('error', 'Data gagal disimpan');
        }
    }

    public function wbs_search(Request $req)
    {
        $val = $req->val ?? '';
        $hj = $req->hj ?? '';
        $status = $req->status ?? '';
        $data = "";
        $code = 500;

        $data = WBS::select(
            DB::raw('nomor_panti, nama, jenis_kelamin, umur, status, pendidikan, tanggal_masuk, agama, asal, domisili, alamat, hasil_jangkauan, status_pernikahan, klasifikasi, lokasi, sumber, foto, wbs.updated_by, wbs.updated_date, wbs.is_delete,
            IFNULL(`bsAgama`.data_name,agama) as agamaNm,
            IFNULL(`bsJK`.data_name,jenis_kelamin) as jkNm,
            IFNULL(`bsPendidikan`.data_name,pendidikan) as pendidikanNm,
            IFNULL(`bsHJ`.data_name,hasil_jangkauan) as hjNm,
            IFNULL(`bsSP`.data_name,status_pernikahan) as spNm,
            IFNULL(`bsStatus`.data_name,status) as statusNm,
            keterangan,
            IFNULL(`kotaAsal`.name,asal) as asalNm ,
            IFNULL(`kotaDomisili`.name,domisili) as domisiliNm   
            ')
        )
            ->leftJoin('basic_data as bsAgama', function ($join1) {
                $join1->on('bsAgama.group_id', '=', DB::raw("'000001'"));
                $join1->on('wbs.agama', '=', 'bsAgama.data_id');
            })
            ->leftJoin('basic_data as bsJK', function ($join2) {
                $join2->on('bsJK.group_id', '=', DB::raw("'000002'"));
                $join2->on('wbs.jenis_kelamin', '=', 'bsJK.data_id');
            })
            ->leftJoin('basic_data as bsPendidikan', function ($join3) {
                $join3->on('bsPendidikan.group_id', '=', DB::raw("'000003'"));
                $join3->on('wbs.pendidikan', '=', 'bsPendidikan.data_id');
            })
            ->leftJoin('basic_data as bsHJ', function ($join4) {
                $join4->on('bsHJ.group_id', '=', DB::raw("'000004'"));
                $join4->on('wbs.hasil_jangkauan', '=', 'bsHJ.data_id');
            })
            ->leftJoin('basic_data as bsSP', function ($join5) {
                $join5->on('bsSP.group_id', '=', DB::raw("'000005'"));
                $join5->on('wbs.status_pernikahan', '=', 'bsSP.data_id');
            })
            ->leftJoin('basic_data as bsStatus', function ($join6) {
                $join6->on('bsStatus.group_id', '=', DB::raw("'000006'"));
                $join6->on('wbs.status', '=', 'bsStatus.data_id');
            })
            ->leftJoin('regencies as kotaAsal', function ($join6) {
                $join6->on('wbs.asal', '=', 'kotaAsal.id');
            })
            ->leftJoin('regencies as kotaDomisili', function ($join6) {
                $join6->on('wbs.domisili', '=', 'kotaDomisili.id');
            })
            ->where('wbs.is_delete', 'N')
            ->whereRaw(" CONCAT_WS('-', nama, jenis_kelamin, umur, status, pendidikan, agama, tanggal_masuk, asal, domisili, alamat, hasil_jangkauan, status_pernikahan, klasifikasi, lokasi) LIKE '%" . $val . "%' ");
        if ($hj != '') {
            $data = $data->whereRaw(" `bsHJ`.data_name = '" . $hj . "' ");
        }

        if ($status != '') {
            // $data = $data->where('bsStatus.data_name', $status);
            $data = $data->whereRaw(" `bsStatus`.data_name = '" . $status . "' ");
        }

        $data = $data->get();

        $code =  (count($data) > 0 ?  200 : $code);

        return response()->json([
            'data' => $data,
            'code' => $code
        ]);
    }


    public function wbs_data_import(Request $req)
    {
        // menangkap file excel
        $file = $req->file('importData');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('public/uploads/file_WBS', $nama_file);

        // import data
        $importAct = Excel::import(new WBSImport(), public_path('/uploads/file_WBS/' . $nama_file));

        if ($importAct) {
            return redirect()->route('wbs_data')->with('success', 'Data berhasil diimport');
        } else {
            return redirect()->route('wbs_data')->with('error', 'Data gagal diimport');
        }
    }

    public function wbs_data_delete($id)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');
        $sqlUpd = DB::update(" UPDATE wbs SET  is_delete = 'Y', updated_by = '" . $user . "', updated_date =  '" . $date . "' WHERE  is_delete = 'N' AND nomor_panti = '" . $id . "'  ");

        if ($sqlUpd) {

            return redirect()->route('wbs_data')->with('success', 'Data berhasil dihapus');
        } else {

            return redirect()->route('wbs_data')->with('error', 'Data gagal dihapus');
        }
    }
}
