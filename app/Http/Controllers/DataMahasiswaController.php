<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $data = Mahasiswa::all();
        // dd($request->all());
        if ($request->has('search')) {
            $data = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
                ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.program_studi_id')
                ->where('nama', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $data = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
                ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.program_studi_id')
                ->paginate(10);
        }
        return view('akademik.dataMahasiswa.index', compact('data'));
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
}
