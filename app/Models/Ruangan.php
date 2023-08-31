<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Kyslik\ColumnSortable\Sortable;

class Ruangan extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [];

    public $sortable = [
        'lantai', 'ruangan'
    ];
}
