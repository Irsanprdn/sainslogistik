<?php

namespace App\Exports;

use App\Models\WBS; // Replace with your data model
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WBSExport implements WithMultipleSheets
{

    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function sheets(): array
    {
        $sheets = [];

        // Fetch unique months from the data
        $data = WBS::selectRaw('YEAR(tanggal_masuk) year, MONTH(tanggal_masuk) month')
        ->whereYear('tanggal_masuk', $this->year)
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->get();

        foreach ($data as $row) {
            $sheets[] = new MonthlyDataSheet($row->year, $row->month);
        }

        return $sheets;
    }
}
