<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class ProgramStudi extends Model
{
    use HasFactory, Sortable;

    // protected $fillable = [
    //     'kode_prodi', 'jenjang', 'nama_prodi', 'konsentrasi'
    // ];
    protected $guarded = [];
    public $sortable = [
        'kode_prodi', 'jenjang', 'nama_prodi', 'konsentrasi'
    ];


    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function staff_prodi()
    {
        return $this->hasMany(StaffProdi::class);
    }

    public function daftar_sidang()
    {
        return $this->hasMany(DaftarSidang::class);
    }
}
