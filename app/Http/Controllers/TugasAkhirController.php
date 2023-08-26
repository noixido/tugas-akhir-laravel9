<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use App\Models\User;
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
        $user = Auth::user()->id;
        $mhs = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
            ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
            ->where('user_id', $user)->first();
        $data = TugasAkhir::join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->join('mahasiswas', 'mahasiswas.id', '=', 'tugas_akhirs.mahasiswa_id')
            ->where('mahasiswas.user_id', $user)
            ->first();
        // $dosen = Dosen::orderBy('jurusan_id', 'asc')->orderBy('nama_dosen', 'asc')->get();
        return view('mahasiswa.tugas-akhir', compact('data', 'mhs'));
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
        $mhs = Mahasiswa::where('user_id', $user)->first();
        $data = TugasAkhir::join('mahasiswas', 'mahasiswas.id', '=', 'tugas_akhirs.mahasiswa_id')
            ->where('mahasiswas.user_id', $user)->first();
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
        $user = Auth::user()->id;
        $mhs = Mahasiswa::where('user_id', $user)->first();
        TugasAkhir::updateOrCreate(
            [
                'mahasiswa_id' => $mhs->id,
            ],
            [
                'dosen_id' => $request->dosen,
                'judul_tugas_akhir' => $request->judul
            ]
        );
        return redirect()->route('tugas-akhir');
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
