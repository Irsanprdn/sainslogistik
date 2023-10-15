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

        $sql = " SELECT * FROM home WHERE is_delete = 'N' AND status = 'Publish' ORDER BY idx ASC ";
        $dataHome = DB::select($sql);

        $dataStatus = DB::select(" SELECT * FROM basic_data WHERE is_delete = 'N' AND group_id = '000006' ORDER BY data_name ASC ");

        $dataHJ = DB::select(" SELECT * FROM basic_data WHERE is_delete = 'N' AND group_id = '000004' ORDER BY data_id DESC ");

        $dataSocmed = DB::select(" SELECT * FROM basic_data WHERE is_delete = 'N' AND group_id = '999999' AND data_id IN ('000001','000002','000003') ORDER BY data_id ASC  ");

        $dataSocmed2 = DB::select(" SELECT * FROM basic_data WHERE is_delete = 'N' AND group_id = '999999' AND data_id > '000004' ORDER BY data_id ASC  ");

        $dataSocmedWA = DB::select(" SELECT * FROM basic_data WHERE is_delete = 'N' AND group_id = '999999'
        AND data_name = 'Whatsapp Link' ORDER BY data_id ASC ");

        $sql = "SELECT * FROM about WHERE is_delete = 'N' AND about_id = '1' ";
        $data1 = collect(DB::select($sql))->first();

        $sql = "SELECT * FROM about WHERE is_delete = 'N' AND about_id = '2' ";
        $data2 = collect(DB::select($sql))->first();
        
        $sql = "SELECT * FROM activity WHERE is_delete = 'N' ORDER BY idx ASC";
        $dataActivity = DB::select($sql);

        $sql = "SELECT * FROM contact WHERE is_delete = 'N' ORDER BY contact_id ASC";
        $dataContact = DB::select($sql);

        return view('index', compact('dataHome', 'dataStatus', 'dataHJ', 'dataSocmed', 'dataSocmedWA', 'data1', 'data2', 'dataActivity', 'dataSocmed2', 'dataContact'));
    }


    public function autoNumber($id)
    {
        $id = (int)$id + 1;
        return sprintf("%06s", $id);
    }
}
