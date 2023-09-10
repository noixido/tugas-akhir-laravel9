<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Grup;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FinalJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $periode = Grup::query()
            ->select('periode_ke')
            ->orderBy('periode_ke', 'asc')
            ->orderBy('yudisium_ke', 'asc')
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'belum dilengkapi')
            ->groupBy('periode_ke')
            ->get();
        $yudisium = Grup::query()
            ->select('yudisium_ke')
            ->orderBy('periode_ke', 'asc')
            ->orderBy('yudisium_ke', 'asc')
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'belum dilengkapi')
            ->groupBy('yudisium_ke')
            ->get();
        $tahun = Grup::query()
            ->select('tahun_akademik')
            ->orderBy('tahun_akademik', 'asc')
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'belum dilengkapi')
            ->groupBy('tahun_akademik')
            ->get();
        $prodi = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();
        $grupQuery = Grup::query()
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'belum dilengkapi')
            ->orderBy('tanggal_sidang', 'desc')
            ->where(function ($q) use ($request) {
                if ($request->periode) {
                    $q->where('periode_ke', $request->periode);
                }
                if ($request->yudisium) {
                    $q->where('yudisium_ke', $request->yudisium);
                }
                if ($request->tahun) {
                    $q->where('tahun_akademik', $request->tahun);
                }
                if ($request->jurusan) {
                    $q->whereHas('daftar_sidang.program_studi', function ($q) use ($request) {
                        $q->where('id', $request->jurusan);
                    });
                }
                if ($request->tanggal) {
                    $q->where('tanggal_sidang', $request->tanggal);
                }
            });
        $grup = $grupQuery->paginate(10)
            ->onEachSide(2);
        Session::put('halaman_url', request()->fullUrl());
        return view('akademik.dataJadwal.final', compact('grup', 'periode', 'yudisium', 'tahun', 'prodi'));
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
        $grup = Grup::query()
            ->where('id', $id)
            ->first();
        $daftar = DaftarSidang::query()
            ->orderBy('jam_mulai_sidang', 'asc')
            ->where('grup_id', $grup->id)
            ->paginate(100);
        return view('akademik.dataJadwal.show-final', compact('grup', 'daftar'));
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
    }

    public function publish($id)
    {
        Grup::query()
            ->where('id', $id)
            ->update([
                'status_jadwal' => 'published'
            ]);
        return back();
    }
}
