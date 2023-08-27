<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenBimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user()->id;
        $dosen = Dosen::where('user_id', $user)->first();
        $bimbingan = Bimbingan::select('bimbingans.mahasiswa_id', 'nama_mahasiswa', 'nim', 'judul_tugas_akhir')->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'bimbingans.tugas_akhir_id')
            ->join('mahasiswas', 'mahasiswas.id', '=', 'bimbingans.mahasiswa_id')
            ->where('tugas_akhirs.dosen_id', $dosen->id)
            ->groupBy('bimbingans.mahasiswa_id', 'nama_mahasiswa', 'nim', 'judul_tugas_akhir')
            ->get();
        // dd($bimbingan);
        return view('dosen.bimbingan.bimbingan', compact('bimbingan'));
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
        $user = Auth::user()->id;
        $dosen = Dosen::where('user_id', $user)->first();
        $ta = TugasAkhir::join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->join('mahasiswas', 'mahasiswas.id', '=', 'tugas_akhirs.mahasiswa_id')
            ->where('dosen_id', $dosen->id)
            ->where('mahasiswa_id', $id)
            ->first();
        $bimbingan = Bimbingan::join('tugas_akhirs', 'tugas_akhirs.id', '=', 'bimbingans.tugas_akhir_id')
            ->join('mahasiswas', 'mahasiswas.id', '=', 'bimbingans.mahasiswa_id')
            ->where('tugas_akhirs.dosen_id', $dosen->id)
            ->where('bimbingans.mahasiswa_id', $id)
            ->orderBy('bimbingans.created_at', 'desc')
            ->paginate(8);
        // dd($bimbingan);
        return view('dosen.bimbingan.lihat', compact('bimbingan', 'ta'));
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

    public function diterima(Request $request, $id)
    {
        return 'diterima';
    }

    public function ditolak(Request $request, $id)
    {
        return 'ditolak';
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
}
