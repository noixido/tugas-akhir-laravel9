<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = TugasAkhir::join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->where('tugas_akhirs.user_id', $user)
            ->first();
        // $dosen = Dosen::orderBy('jurusan_id', 'asc')->orderBy('nama_dosen', 'asc')->get();
        return view('mahasiswa.tugas-akhir', compact('data'));
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
        $user = Auth::user()->id;
        $data = TugasAkhir::where('user_id', $user)->first();
        $mhs = Mahasiswa::where('user_id', $user)->first();
        $dosen = Dosen::where('jurusan_id', $mhs->jurusan_id)->orderBy('jurusan_id', 'asc')->orderBy('nama_dosen', 'asc')->get();
        return view('mahasiswa.edit-tugas-akhir', compact('data', 'dosen'));
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
            'dosen' => ['nullable'],
            'judul_tugas_akhir' => ['nullable']
        ]);
        TugasAkhir::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            [
                'dosen_id' => $request->dosen,
                'judul_tugas_akhir' => $request->judul
            ]
        );
        return redirect()->route('tugas-akhir', Auth::user()->username);
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
