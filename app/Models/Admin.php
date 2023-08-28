<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Admin extends Model
{
    use HasFactory, Sortable;
    protected $guarded = [];

    public $sortable = [
        'nama_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
