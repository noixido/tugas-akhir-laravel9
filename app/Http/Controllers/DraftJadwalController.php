<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Grup;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class DraftJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Grup::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);
        return view('akademik.dataJadwal.draft', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $prodi = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();
        $data = DaftarSidang::query()
            ->orderBy('daftar_sidangs.created_at', 'desc')
            ->where('grup_id', null)
            ->get();
        // dd($data);
        return view('akademik.dataJadwal.tambah-draft', compact('prodi', 'data'));
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
        $grup = Grup::create([
            'periode_ke' => $request->periode,
            'yudisium_ke' => $request->yudisium,
            'jurusan_id' => $request->jurusan,
            'tahun_akademik' => $request->tahun
        ]);
        DaftarSidang::query()
            ->whereIn('id', $request->daftarSidang)
            ->update([
                'grup_id' => $grup->id
            ]);
        return redirect()->route('draft-jadwal');
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
        return view('akademik.dataJadwal.show', compact('data', 'daftar'));
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
        DaftarSidang::query()
            ->where('grup_id', $id)
            ->update([
                'grup_id' => null,
            ]);
        Grup::query()
            ->find($id)
            ->delete();
        return back();
    }
}
