<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Grup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FinalJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grup = Grup::query()
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'belum dilengkapi')
            // ->where('status_jadwal', 'sudah dilengkapi')
            // ->where('status_jadwal', 'published')
            ->orderBy('tanggal_sidang', 'desc')
            ->paginate(10)
            ->onEachSide(2);
        Session::put('halaman_url', request()->fullUrl());
        return view('akademik.dataJadwal.final', compact('grup'));
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
