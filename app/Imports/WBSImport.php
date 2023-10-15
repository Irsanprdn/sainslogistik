<?php

namespace App\Imports;

use App\Models\WBS;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class WBSImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = auth()->user()->fullname;
        $date = date('Y-m-d H:i:s');

        $dataAgama =  collect(DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000001' "))->keyBy('data_name');

        $dataJK =  collect(DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000002' "))->keyBy('data_name');

        $dataPendidikan =  collect(DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000003' "))->keyBy('data_name');

        $dataHJ =  collect(DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000004' "))->keyBy('data_name');

        $dataSP =  collect(DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000005' "))->keyBy('data_name');

        $dataStatus =  collect(DB::select(" SELECT data_id,data_name FROM basic_data WHERE group_id = '000006' "))->keyBy('data_name');


        $data = [];
        if ($row[0] != 'No' && $row[0] != null && $row[0] != '' &&  $row[1] != null && $row[1] != '') {

            $foto = $row[15];
            if ($foto != '') {
                $foto = str_replace('https://drive.google.com/file/d/', '', $foto);
                $foto = str_replace('/view?usp=drive_link', '', $foto);
                $foto = str_replace('/view?usp=sharing', '', $foto);
            }

            $tglMasuk = "";
            $excelSerialDate = $row[7]; // For example, the serial date value representing 2021-08-21
            // if (preg_match('/^[0-9\-\/]+$/', $row[7])) {
            //     $excelSerialDate = $row[7];
            // } else {
            //     $dateReplace = preg_replace('/[^0-9\-\/]+/', '', $row[7]);
            //     $excelSerialDate = intval($dateReplace);
            // }

            if (is_int($excelSerialDate)) {
                // Convert Excel serial date to Unix timestamp
                $unixTimestamp = ($excelSerialDate - 25569) * 86400;
                // Convert Unix timestamp to a formatted date
                $tglMasuk = date("Y-m-d", $unixTimestamp);
            } else {
                $tglMasukArr = [];
                if (str_contains($row[7], '/')) {
                    $tglMasukArr = explode('/', $row[7]);
                    $tglMasuk = (count($tglMasukArr) == 3 ?  $tglMasukArr[2] . '-' . $tglMasukArr[1] . '-' . $tglMasukArr[0] : date('Y-m-d'));
                }else if (str_contains($row[7], '-')) {
                    $tglMasukArr = explode('-', $row[7]);
                    $tglMasuk = (count($tglMasukArr) == 3 ?  $tglMasukArr[0] . '-' . $tglMasukArr[1] . '-' . $tglMasukArr[2] : date('Y-m-d'));
                }else{
                    $tglMasuk = date('Y-m-d');
                }
            }


            $data = [
                'nama' => $row[1],
                'jenis_kelamin' => $dataJK[$row[2]]->data_id ?? $row[2],
                'umur' => $row[3],
                'status' => $dataStatus[$row[4]]->data_id ?? $row[4],
                'pendidikan' => $dataPendidikan[$row[5]]->data_id ?? $row[5],
                'agama' => $dataAgama[$row[6]]->data_id ?? $row[6],
                'tanggal_masuk' => $tglMasuk,
                'asal' => $row[8],
                'domisili' => $row[9],
                'alamat' => $row[10],
                'hasil_jangkauan' => $dataHJ[$row[11]]->data_id ?? $row[11],
                'status_pernikahan' => $dataSP[$row[12]]->data_id ?? $row[12],
                'klasifikasi' => $row[13],
                'lokasi' => str_replace('Admin ', '', $user),
                'sumber' => 'Import',
                'foto' => $foto,
                'updated_by' => $user,
                'updated_date' => $date,
                'is_delete' => 'N'
            ];
            return new WBS($data);
        }
    }
}
