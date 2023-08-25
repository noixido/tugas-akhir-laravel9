<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DataRuanganController extends Controller
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
            $data = Ruangan::sortable()
                ->orderBy('created_at', 'desc')
                ->where('lantai', 'LIKE', '%' . $request->search . '%')
                ->orWhere('ruangan', 'LIKE', '%' . $request->search . '%')
                ->paginate(10)
                ->onEachSide('3');

            //ini bikin session biar kalo update data,
            //user gk akan dibawa ke page paling petama,
            //tapi di page tempat terakhir kita edit data
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Ruangan::sortable()
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->onEachSide('3');

            //ini bikin session biar kalo update data,
            //user gk akan dibawa ke page paling petama,
            //tapi di page tempat terakhir kita edit data
            Session::put('halaman_url', request()->fullUrl());
        }
        return view('akademik.dataRuangan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('akademik.dataRuangan.create');
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
            'lantai' => ['required', 'numeric'],
            'ruangan' => ['required', 'numeric'],
        ]);
        // dd($request->all());
        $data = Ruangan::create([
            'lantai' => $request->lantai,
            'ruangan' => $request->ruangan,
        ]);

        return redirect()->route('data-ruangan');
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
        $data = Ruangan::find($id);
        return view('akademik.dataRuangan.edit', compact('data'));
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
            'lantai' => ['required', 'numeric'],
            'ruangan' => ['required', 'numeric'],
        ]);
        Ruangan::find($id)
            ->update([
                'lantai' => $request->lantai,
                'ruangan' => $request->ruangan,
            ]);
        if (session('halaman_url')) {
            return redirect(session('halaman_url'));
        }
        return redirect()->route('data-ruangan');
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
        Ruangan::find($id)->delete();
        return back();
    }
}
