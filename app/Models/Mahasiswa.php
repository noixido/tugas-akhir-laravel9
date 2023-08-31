<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Mahasiswa extends Model
{
    use HasFactory, Sortable;
    // protected $fillable = [
    //     'user_id',
    //     'nim',
    //     'angkatan',
    //     'program_studi_id',
    //     'email',
    //     'tempat_lahir',
    //     'tanggal_lahir',
    //     'no_telepon',
    //     'judul_tugas_akhir',
    //     'pembimbing'
    // ];
    protected $guarded = [];
    public $sortable = [
        'nama_mahasiswa', 'nim', 'angkatan', 'jurusan_id', 'email', 'telepon'
    ];

    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'jurusan_id');
    }

    public function daftar_sidang()
    {
        return $this->hasMany(DaftarSidang::class);
    }

    public function tugas_akhir()
    {
        return $this->hasMany(TugasAkhir::class);
    }
}
