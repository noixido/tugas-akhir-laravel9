<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class StaffProdi extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [];

    public $sortable = [
        'nama_staffprodi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function program_studi()
    {
        return $this->belongsTo(ProgramStudi::class, 'jurusan_id');
    }
}
