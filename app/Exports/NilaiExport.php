<?php

namespace App\Exports;

use App\Models\Nilai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class NilaiExport implements FromView
{

    protected $jurusan;
    protected $tanggal;

    function __construct($jurusan, $tanggal)
    {
        $this->jurusan = $jurusan;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        $queryNilai = Nilai::query()
            ->orderBy('created_at', 'desc')
            ->where(function ($q) {
                if ($this->jurusan) {
                    $q->whereHas('daftar_sidang.program_studi', function ($q) {
                        $q->where('id', $this->jurusan);
                    });
                }
                if ($this->tanggal) {
                    $q->whereHas('daftar_sidang.grup', function ($q) {
                        $q->where('tanggal_sidang', 'LIKE', '%' . $this->tanggal . '%');
                    });
                }
            });
        $nilai = $queryNilai->get();

        return view('akademik.dataNilai.nilai-tabel', [
            'nilai' => $nilai,
            'export' => true
        ]);
    }
}
