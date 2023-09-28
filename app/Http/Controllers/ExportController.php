<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Grup;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
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
    public function jadwalPDF($id)
    {
        $grup = Grup::query()
            ->where('id', $id)
            ->where('status_jadwal', 'published')
            ->orderBy('tanggal_sidang', 'desc')
            ->first();
        $daftar = DaftarSidang::query()
            ->where('grup_id', $grup->id)
            ->orderBy('jam_mulai_sidang', 'asc')
            ->get();
        $pdf = Pdf::loadView('jadwalPDF', compact('grup', 'daftar'))->setPaper('a4', 'landscape');
        $jadwalCustomName = str_replace(" ", "-", "P" . $grup->periode_ke . "Y" . $grup->yudisium_ke . "_" . $grup->tanggal_sidang . "_" . $grup->program_studi->nama_prodi . "_" . "Jadwal-Sidang.pdf");
        return $pdf->download($jadwalCustomName);
        // return view('jadwalPDF', compact('grup', 'daftar'));
    }
}
