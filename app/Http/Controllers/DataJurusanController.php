<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DataJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->has('search')) {
            $data = ProgramStudi::query()
                ->sortable()
                ->orderBy('created_at', 'desc')
                ->where('kode_prodi', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nama_prodi', 'LIKE', '%' . $request->search . '%')
                ->orWhere('jenjang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('konsentrasi', 'LIKE', '%' . $request->search . '%')
                ->paginate(10)
                ->onEachSide(2);

            //ini bikin session biar kalo update data,
            //user gk akan dibawa ke page paling petama,
            //tapi di page tempat terakhir kita edit data
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = ProgramStudi::query()
                ->sortable()
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->onEachSide(2);

            //ini bikin session biar kalo update data,
            //user gk akan dibawa ke page paling petama,
            //tapi di page tempat terakhir kita edit data
            Session::put('halaman_url', request()->fullUrl());
        }
        return view('akademik.dataJurusan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('akademik.dataJurusan.create');
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
        $request->validate([
            'kode_prodi' => ['required'],
            'jenjang' => ['required'],
            'nama_prodi' => ['required'],
            'konsentrasi' => ['nullable'],
        ]);
        // dd($request->all());
        $data = ProgramStudi::create([
            'kode_prodi' => $request->kode_prodi,
            'jenjang' => $request->jenjang,
            'nama_prodi' => $request->nama_prodi,
            'konsentrasi' => $request->konsentrasi,
        ]);

        return redirect()->route('data-jurusan');
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
        $data = ProgramStudi::find($id);
        return view('akademik.dataJurusan.edit', compact('data'));
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
            'kode_prodi' => ['required'],
            'jenjang' => ['required'],
            'nama_prodi' => ['required'],
            'konsentrasi' => ['nullable'],
        ]);
        ProgramStudi::query()
            ->find($id)
            ->update([
                'kode_prodi' => $request->kode_prodi,
                'jenjang' => $request->jenjang,
                'nama_prodi' => $request->nama_prodi,
                'konsentrasi' => $request->konsentrasi,
            ]);
        if (session('halaman_url')) {
            return redirect(session('halaman_url'));
        }
        return redirect()->route('data-jurusan');
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
        ProgramStudi::query()
            ->find($id)
            ->delete();
        return back();
    }
}
