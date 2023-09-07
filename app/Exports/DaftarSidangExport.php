<?php

namespace App\Exports;

use App\Models\DaftarSidang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DaftarSidangExport implements FromView
{
    public function view(): View
    {
        return view('akademik.dataPendaftaran.tabel-pendaftaran', [
            'data' => DaftarSidang::query()
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}
