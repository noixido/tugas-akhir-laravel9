<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $bimbingan = Bimbingan::query()
            ->select('bimbingans.mahasiswa_id', 'nama_mahasiswa', 'nim', 'judul_tugas_akhir', DB::raw('MAX(tanggal_bimbingan) as tanggal_bimbingan_terakhir'))
            ->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'bimbingans.tugas_akhir_id')
            ->join('mahasiswas', 'mahasiswas.id', '=', 'bimbingans.mahasiswa_id')
            ->orderBy('tanggal_bimbingan_terakhir', 'desc')
            ->where('tugas_akhirs.dosen_id', $dosen->id)
            ->groupBy('bimbingans.mahasiswa_id', 'nama_mahasiswa', 'nim', 'judul_tugas_akhir')
            ->paginate(10)
            ->onEachSide(2);
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
        $ta = TugasAkhir::query()
            ->join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->join('mahasiswas', 'mahasiswas.id', '=', 'tugas_akhirs.mahasiswa_id')
            ->where('dosen_id', $dosen->id)
            ->where('mahasiswa_id', $id)
            ->first();
        $bimbingan = Bimbingan::query()
            ->select('bimbingans.id as bimbingan_id', 'tanggal_bimbingan', 'isi_bimbingan', 'status_bimbingan')
            ->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'bimbingans.tugas_akhir_id')
            ->join('mahasiswas', 'mahasiswas.id', '=', 'bimbingans.mahasiswa_id')
            ->where('tugas_akhirs.dosen_id', $dosen->id)
            ->where('bimbingans.mahasiswa_id', $id)
            ->orderBy('tanggal_bimbingan', 'desc')
            ->paginate(8)
            ->onEachSide(2);
        // dd($bimbingan);
        return view('dosen.bimbingan.lihat', compact('bimbingan', 'ta'));
    }

    public function profileMahasiswa($id)
    {
        $data = Mahasiswa::query()
            ->where('id', $id)
            ->first();
        $bimbingan = Bimbingan::query()
            ->where('mahasiswa_id', $data->id)
            ->first();
        return view('dosen.profile.profile-mahasiswa', compact('data', 'bimbingan'));
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
        // return 'diterima';
        Bimbingan::find($id)->update([
            'status_bimbingan' => 'diterima',
        ]);
        return back();
    }

    public function ditolak(Request $request, $id)
    {
        // return 'ditolak';
        Bimbingan::find($id)->update([
            'status_bimbingan' => 'ditolak',
        ]);
        return back();
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
