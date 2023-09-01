<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'jurusan_id');
    }

    public function daftar_sidang()
    {
        return $this->hasMany(DaftarSidang::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
