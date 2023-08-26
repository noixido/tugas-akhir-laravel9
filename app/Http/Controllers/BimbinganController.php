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
        $mhs = Mahasiswa::where('user_id', $user)->first();
        $data = Bimbingan::where('mahasiswa_id', $mhs->id)
            ->orderBy('tanggal_bimbingan', 'desc')
            ->paginate(8);
        $dataCount = $data->where('status_bimbingan', 'diterima')->count();
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
        $mhs = Mahasiswa::where('user_id', $user)->first();
        $ta = TugasAkhir::where('mahasiswa_id', $mhs->id)->first();
        $request->validate([
            'tanggal' => ['required'],
            'isi' => ['required']
        ]);
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
        $data = Bimbingan::join('mahasiswas', 'mahasiswas.id', '=', 'bimbingans.mahasiswa_id')
            ->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'bimbingans.tugas_akhir_id')
            ->where('bimbingans.id', $id)
            ->first();
        return view('mahasiswa.lihat-bimbingan', compact('data'));
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
        Bimbingan::find($id)->delete();
        return back();
    }
}
