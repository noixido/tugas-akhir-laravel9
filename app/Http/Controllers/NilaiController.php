<?php

namespace App\Http\Controllers;

use App\Exports\NilaiExport;
use App\Models\Nilai;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $prodi = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();

        $queryNilai = Nilai::query()
            ->orderBy('created_at', 'desc')
            ->where(function ($q) use ($request) {
                if ($request->jurusan) {
                    $q->whereHas('daftar_sidang.program_studi', function ($q) use ($request) {
                        $q->where('id', $request->jurusan);
                    });
                }
                if ($request->nama) {
                    $q->whereHas('daftar_sidang.mahasiswa', function ($q) use ($request) {
                        $q->where('nama_mahasiswa', 'LIKE', '%' . $request->nama . '%');
                    });
                }
                if ($request->nim) {
                    $q->whereHas('daftar_sidang.mahasiswa', function ($q) use ($request) {
                        $q->where('nim', 'LIKE', '%' . $request->nim . '%');
                    });
                }
            });
        $nilai = $queryNilai->paginate(10)
            ->onEachSide(2);
        return view('akademik.dataNilai.index', compact('nilai', 'prodi'));
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
        $nilai = Nilai::query()
            ->where('id', $id)
            ->first();
        return view('akademik.dataNilai.show', compact('nilai'));
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

    public function export()
    {
        return Excel::download(new NilaiExport, 'nilai-sidang-mahasiswa.xlsx');
    }
}
