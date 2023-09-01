<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class DaftarSidang extends Model
{
    use HasFactory, Sortable;
    protected $guarded = [];

    public $sortable = [
        'created_at'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'jurusan_id');
    }

    public function tugas_akhir()
    {
        return $this->belongsTo(TugasAkhir::class, 'tugas_akhir_id');
    }

    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class, 'bimbingan_id');
    }

    public function grup()
    {
        return $this->belongsTo(Grup::class, 'grup_id');
    }










    public function penguji1()
    {
        return $this->belongsTo(Dosen::class, 'penguji_1');
    }
    public function penguji2()
    {
        return $this->belongsTo(Dosen::class, 'penguji_2');
    }
}
