<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BimbinganController extends Controller
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
        $mhs = Mahasiswa::query()
            ->where('user_id', $user)
            ->first();
        $data = Bimbingan::query()
            ->where('mahasiswa_id', $mhs->id)
            ->orderBy('tanggal_bimbingan', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(8)
            ->onEachSide(2);
        $dataCount = Bimbingan::query()
            ->where('mahasiswa_id', $mhs->id)
            ->where('status_bimbingan', 'diterima')
            ->count();
        return view('mahasiswa.bimbingan', compact('data', 'dataCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mahasiswa.tambah-bimbingan');
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
        // dd($request->all());
        $user = Auth::user()->id;
        $mhs = Mahasiswa::query()
            ->where('user_id', $user)
            ->first();
        $ta = TugasAkhir::query()
            ->where('mahasiswa_id', $mhs->id)
            ->first();
        $request->validate([
            'tanggal' => ['required'],
            'isi' => ['required']
        ]);

        if ($ta === null) {
            return redirect()->route('tugas-akhir')->with('message', 'Silahkan lengkapi data tugas akhir anda terlebih dahulu sebelum melaksanakan bimbingan!');
        }
        Bimbingan::create([
            'mahasiswa_id' => $mhs->id,
            'tugas_akhir_id' => $ta->id,
            'tanggal_bimbingan' => $request->tanggal,
            'isi_bimbingan' => $request->isi,
            'status_bimbingan' => 'sedang ditinjau'
        ]);
        return redirect()->route('bimbingan');
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
        $mhs = Mahasiswa::query()
            ->where('user_id', $user)
            ->first();
        $data = Bimbingan::query()
            ->join('mahasiswas', 'mahasiswas.id', '=', 'bimbingans.mahasiswa_id')
            ->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'bimbingans.tugas_akhir_id')
            ->where('bimbingans.id', $id)
            ->first();
        $ta = TugasAkhir::query()
            ->join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->where('mahasiswa_id', $mhs->id)
            ->first();
        return view('mahasiswa.lihat-bimbingan', compact('data', 'ta'));
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
        $data = Bimbingan::query()
            ->where('bimbingans.id', $id)
            ->first();
        return view('mahasiswa.edit-bimbingan', compact('data'));
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
        $request->validate([
            'isi' => ['required']
        ]);
        Bimbingan::query()
            ->where('id', $id)
            ->update([
                'isi_bimbingan' => $request->isi
            ]);
        return redirect()->route('bimbingan');
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
        Bimbingan::query()
            ->find($id)
            ->delete();
        return back();
    }
}
