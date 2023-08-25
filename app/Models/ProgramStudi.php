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
}
