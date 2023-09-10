<?php

namespace App\Http\Controllers;

use App\Exports\DaftarSidangExport;
use App\Models\Bimbingan;
use App\Models\DaftarSidang;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\TugasAkhir;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DataPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->has('search')) {
            $data = DaftarSidang::query()
                ->sortable()
                ->orderBy('daftar_sidangs.created_at', 'desc')
                ->orWhere('created_at', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status_pendaftaran', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('mahasiswa', function ($q) use ($request) {
                    $q->where('nim', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('mahasiswa', function ($q) use ($request) {
                    $q->where('nama_mahasiswa', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('program_studi', function ($q) use ($request) {
                    $q->where('jenjang', 'LIKE', '%' . $request->search . '%');
                })
                ->orWhereHas('program_studi', function ($q) use ($request) {
                    $q->where('nama_prodi', 'LIKE', '%' . $request->search . '%');
                })
                ->paginate(10)
                ->onEachSide(2);
            FacadesSession::put('halaman_url', request()->fullUrl());
        } else {
            $data = DaftarSidang::query()
                ->sortable()
                ->orderBy('daftar_sidangs.created_at', 'desc')
                ->paginate(10)
                ->onEachSide(2);
            FacadesSession::put('halaman_url', request()->fullUrl());
        }

        return view('akademik.dataPendaftaran.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $data = DaftarSidang::query()
            ->join('mahasiswas', 'mahasiswas.id', '=', 'daftar_sidangs.mahasiswa_id')
            ->join('program_studis', 'program_studis.id', '=', 'daftar_sidangs.jurusan_id')
            ->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'daftar_sidangs.tugas_akhir_id')
            ->where('daftar_sidangs.mahasiswa_id', $id)
            ->first();
        $create = DaftarSidang::query()
            ->where('mahasiswa_id', $id)
            ->first();
        $ta = TugasAkhir::query()
            ->join('mahasiswas', 'mahasiswas.id', '=', 'tugas_akhirs.mahasiswa_id')
            ->join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->where('mahasiswa_id', $id)
            ->first();
        $bimbinganCount = Bimbingan::query()
            ->where('mahasiswa_id', $id)
            ->where('status_bimbingan', 'diterima')
            ->count();

        return view('akademik.dataPendaftaran.show', compact('data', 'ta', 'bimbinganCount', 'create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $daftar = DaftarSidang::query()
            ->where('mahasiswa_id', $id)
            ->first();

        if ($daftar->pas_foto) {
            unlink('storage/' . $daftar->pas_foto);
        }
        if ($daftar->scan_bukti_spp) {
            unlink('storage/' . $daftar->scan_bukti_spp);
        }
        if ($daftar->scan_ijazah_terakhir) {
            unlink('storage/' . $daftar->scan_ijazah_terakhir);
        }
        if ($daftar->scan_akta_kelahiran) {
            unlink('storage/' . $daftar->scan_akta_kelahiran);
        }
        if ($daftar->scan_kartu_keluarga) {
            unlink('storage/' . $daftar->scan_kartu_keluarga);
        }
        if ($daftar->scan_sertifikat_peka) {
            unlink('storage/' . $daftar->scan_sertifikat_peka);
        }
        if ($daftar->scan_sertifikat_toefl) {
            unlink('storage/' . $daftar->scan_sertifikat_toefl);
        }
        if ($daftar->scan_sertifikat_ujikom_1) {
            unlink('storage/' . $daftar->scan_sertifikat_ujikom_1);
        }
        if ($daftar->scan_sertifikat_ujikom_2) {
            unlink('storage/' . $daftar->scan_sertifikat_ujikom_2);
        }
        if ($daftar->scan_sertifikat_ujikom_3) {
            unlink('storage/' . $daftar->scan_sertifikat_ujikom_3);
        }
        if ($daftar->scan_sertifikat_ujikom_4) {
            unlink('storage/' . $daftar->scan_sertifikat_ujikom_4);
        }
        if ($daftar->scan_sertifikat_ujikom_5) {
            unlink('storage/' . $daftar->scan_sertifikat_ujikom_5);
        }

        $daftar->delete();
        return back();
    }


    public function bimbingan($id)
    {
        $daftar = DaftarSidang::query()
            ->where('mahasiswa_id', $id)
            ->first();
        $ta = TugasAkhir::query()
            ->join('mahasiswas', 'mahasiswas.id', '=', 'tugas_akhirs.mahasiswa_id')
            ->join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->where('mahasiswa_id', $id)
            ->first();
        $data = Bimbingan::query()
            ->join('mahasiswas', 'mahasiswas.id', '=', 'bimbingans.mahasiswa_id')
            ->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'bimbingans.tugas_akhir_id')
            ->where('bimbingans.mahasiswa_id', $id)
            ->orderBy('bimbingans.tanggal_bimbingan', 'desc')
            ->orderBy('bimbingans.created_at', 'desc')
            ->paginate(8);
        return view('akademik.dataPendaftaran.bimbingan', compact('data', 'ta', 'daftar'));
    }

    public function tabel()
    {
        $data = DaftarSidang::query()
            ->sortable()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('akademik.dataPendaftaran.tabel-pendaftaran', compact('data'));
    }
    public function export()
    {
        return Excel::download(new DaftarSidangExport, 'data-pendaftaran-sidang-mahasiswa.xlsx');
    }
}
