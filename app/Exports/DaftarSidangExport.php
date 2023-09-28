<?php

namespace App\Exports;

use App\Models\DaftarSidang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DaftarSidangExport implements FromView
{
    protected $jurusan;
    protected $angkatan;
    protected $dari;
    protected $sampai;

    function __construct($jurusan, $angkatan, $dari, $sampai)
    {
        $this->jurusan = $jurusan;
        $this->angkatan = $angkatan;
        $this->dari = $dari;
        $this->sampai = $sampai;
    }
    public function view(): View
    {
        $dataQuery = DaftarSidang::query()
            ->sortable()
            ->orderBy('created_at', 'desc')
            ->where(function ($q) {
                if ($this->jurusan) {
                    $q->whereHas('program_studi', function ($q) {
                        $q->where('id', $this->jurusan);
                    });
                }
                if ($this->angkatan) {
                    $q->whereHas('mahasiswa', function ($q) {
                        $q->where('angkatan', $this->angkatan);
                    });
                }
                if ($this->dari) {
                    $q->whereDate('created_at', '>=', $this->dari);
                }
                if ($this->sampai) {
                    $q->whereDate('created_at', '<=', $this->sampai);
                }
            });

        $data = $dataQuery->get();
        return view('akademik.dataPendaftaran.tabel-pendaftaran', [
            'data' => $data,
        ]);
    }
}
