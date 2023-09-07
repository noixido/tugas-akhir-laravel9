<?php

namespace App\Exports;

use App\Models\Nilai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class NilaiExport implements FromView
{
    public function view(): View
    {
        // return Nilai::query()
        //     ->join('daftar_sidangs', 'daftar_sidangs.id', '=', 'nilais.daftar_id');
        return view('akademik.dataNilai.nilai-tabel', [
            'nilai' => Nilai::query()
                ->orderBy('created_at', 'desc')
                ->get(),
            'export' => true
        ]);
    }
}
