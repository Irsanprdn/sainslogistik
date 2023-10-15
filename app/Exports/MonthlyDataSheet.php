<?php

namespace App\Exports;

use DB;
use App\Models\WBS; // Replace with your data model
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class MonthlyDataSheet implements FromCollection, WithTitle, WithHeadings, WithStyles
{
    protected $year;
    protected $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function collection()
    {
        // Fetch data for the specific month
        $data = WBS::select(
            DB::raw('
            nama,            
            IFNULL(`bsJK`.data_name,jenis_kelamin) as jkNm, 
            umur,           
            IFNULL(`bsStatus`.data_name,status) as statusNm,
            IFNULL(`bsPendidikan`.data_name,pendidikan) as pendidikanNm, 
            IFNULL(`bsAgama`.data_name,agama) as agamaNm,
            tanggal_masuk,                     
            IFNULL(`kotaAsal`.name,asal) as asalNm ,
            IFNULL(`kotaDomisili`.name,domisili) as domisiliNm,
            alamat,
            IFNULL(`bsHJ`.data_name,hasil_jangkauan) as hjNm, 
            IFNULL(`bsSP`.data_name,status_pernikahan) as spNm, 
            klasifikasi,
            foto,            
            lokasi,
            sumber,
            link_berkas,
            riwayat_rumah_sakit, 
            bukti_riwayat,
            wisma
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
            ->whereYear('tanggal_masuk', $this->year)
            ->whereMonth('tanggal_masuk', $this->month)
            ->get();

        $numberedData = $data->map(function ($item, $index) {

            
            return [                
                'No'  => $index + 1,     
                'Nama' => $item->nama,
                'Jenis Kelamin' => $item->jkNm,
                'Umur' => $item->umur,
                'Status' => $item->statusNm,
                'Riwayat Rumah Sakit' => $item->riwayat_rumah_sakit ,
                'Bukti Riwayat' => ($item->riwayat_rumah_sakit  == 'Pernah' ?  ENV('ASSET_URL') .'/uploads/bukti_riwayat_rumah_sakit/'.$item->bukti_riwayat : ''),
                'Pendidikan' => $item->pendidikanNm,
                'Agama' => $item->agamaNm,
                'Tgl Masuk' => $item->tanggal_masuk,
                'Asal' => $item->asalNm,
                'Domisili' => $item->domisiliNm,
                'Detail Alamat' => $item->alamat,
                'Hasil Jangkauan' => $item->hjNm,
                'Status Pernikahan' => $item->spNm,
                'Klasifikasi' => $item->klasifikasi,
                'Foto' => 'https://drive.google.com/file/d/'.$item->foto.'/view?usp=drive_link',
                'Lokasi' => $item->lokasi,
                'Wisma' => $item->wisma,
                'Sumber' => $item->sumber,
                'Link Berkas' => $item->link_berkas,
            ];
        });

        return $numberedData;
    }

    public function title(): string
    {
        return Carbon::create($this->year, $this->month, 1)->format('F Y');
    }

    public function headings(): array
    {
        // Define your column headings here
        return [
            'No',        
            'Nama',
            'Jenis Kelamin',
            'Umur',
            'Status',
            'Riwayat Rumah Sakit',
            'Bukti Riwayat',
            'Pendidikan',
            'Agama',
            'Tgl Masuk',
            'Asal (Kota)',
            'Domisili',
            'Detail Alamat',
            'Hasil Jangkauan',
            'Status Pernikahan',
            'Klasifikasi',
            'Foto',
            'Lokasi',
            'Wisma',
            'Sumber',
            'Link Berkas',
            // 'Update By',
            // 'Update Date'
        ];
    }


    public function styles(Worksheet $sheet)
    {
        // Apply border style to all cells containing data
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Border color
                ],
            ],
        ]);
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
