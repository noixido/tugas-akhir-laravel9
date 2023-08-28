<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Dosen extends Model
{
    use HasFactory, Sortable;
    protected $guarded = [];

    public $sortable = [
        'nidn', 'nama_dosen'
    ];

    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'jurusan_id');
    }
}
