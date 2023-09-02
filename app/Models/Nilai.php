<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function grup()
    {
        return $this->belongsTo(Grup::class, 'grup_id');
    }

    public function daftar_sidang()
    {
        return $this->belongsTo(DaftarSidang::class, 'daftar_id');
    }
}
