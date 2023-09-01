<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Dosen;
use App\Models\Grup;
use App\Models\Mahasiswa;
use App\Models\Ruangan;
use App\Models\StaffProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
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
        $staffprodi = StaffProdi::query()
            ->where('user_id', $user)
            ->first();
        $data = Grup::query()
            ->where('status_jadwal', 'sedang dilengkapi')
            ->where('jurusan_id', $staffprodi->jurusan_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);
        return view('staffprodi.jadwal.draft', compact('data'));
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
        $data = Grup::query()
            ->where('id', $id)
            ->first();
        $daftar = DaftarSidang::query()
            ->orderBy('daftar_sidangs.created_at', 'desc')
            ->where('grup_id', $data->id)
            ->paginate(10);
        return view('staffprodi.jadwal.show', compact('data', 'daftar'));
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

    public function lengkapiJadwalA(Request $request, $id)
    {
        $grup = Grup::query()
            ->where('id', $id)
            ->first();
        $ruangan = Ruangan::query()
            ->orderBy('lantai', 'asc')
            ->orderBy('ruangan', 'asc')
            ->get();
        return view('staffprodi.jadwal.lengkapi-a', compact('grup', 'ruangan'));
    }

    public function prosesLengkapiJadwalA(Request $request, $id)
    {
        $grup = Grup::query()
            ->where('id', $id)
            ->first();
        $request->validate([
            'ruangan' => ['required'],
            'tanggal_sidang' => ['required'],
            'revisi' => ['required']
        ]);
        $grup->update([
            'ruangan_id' => $request->ruangan,
            'tanggal_sidang' => $request->tanggal_sidang,
            'batas_revisi' => $request->revisi,
        ]);
        return redirect()->route('detail-jadwal', $grup->id);
    }

    public function lengkapiJadwalB(Request $request, $id)
    {
        // $grup = Grup::find($id)->first();
        $daftar = DaftarSidang::query()
            ->where('id', $id)
            ->first();

        // dd($data);
        return view('staffprodi.jadwal.lengkapi-b', compact('daftar'));
    }
}
