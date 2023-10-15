<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WBS extends Model
{
    protected $table = "wbs";

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'umur',
        'status',
        'pendidikan',
        'agama',
        'tanggal_masuk',
        'asal',
        'domisili',
        'alamat',
        'hasil_jangkauan',
        'status_pernikahan',
        // 'grup_klasifikasi',
        'klasifikasi',
        'riwayat_rumah_sakit',
        'bukti_riwayat',
        'wisma',
        'lokasi',
        'link_berkas',
        'sumber',
        'foto',
        'keterangan',
        'updated_by',
        'updated_date',
        'is_delete',
    ];
}
