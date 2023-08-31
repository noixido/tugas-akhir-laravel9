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

    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'jurusan_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function tugas_akhir()
    {
        return $this->belongsTo(TugasAkhir::class, 'tugas_akhir_id');
    }
}
