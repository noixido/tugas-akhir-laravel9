<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class DataAdminController extends Controller
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
            $data = User::orderBy('created_at', 'desc')
                ->where('nama', 'LIKE', '%' . $request->search . '%')
                ->orWhere('username', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);

            //ini bikin session biar kalo update data,
            //user gk akan dibawa ke page paling petama,
            //tapi di page tempat terakhir kita edit data
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = User::orderBy('created_at', 'desc')->where('role', 'akademik')
                ->paginate(10);

            //ini bikin session biar kalo update data,
            //user gk akan dibawa ke page paling petama,
            //tapi di page tempat terakhir kita edit data
            Session::put('halaman_url', request()->fullUrl());
        }
        return view('akademik.dataAdmin.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('akademik.dataAdmin.create');
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
            'nama' => ['required', 'min:3'],
            'username' => ['required', 'min:5'],
            'password' => ['required', 'min:8']
        ]);
        $data = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'akademik',
            'remember_token' => Str::random(60),
        ]);
        return redirect()->route('data-admin');
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
        $data = User::find($id);
        return view('akademik.dataAdmin.edit', compact('data'));
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
        if ($request->password == null) {
            $request->validate([
                'nama' => ['required', 'min:3'],
                'username' => ['required'],
            ]);
            $data = User::find($id)
                ->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                ]);
        } else {
            $request->validate([
                'nama' => ['required', 'min:3'],
                'username' => ['required'],
                'password' => ['min:8'],
            ]);
            $data = User::find($id)
                ->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
        }
        if (session('halaman_url')) {
            return redirect(session('halaman_url'));
        }
        return redirect()->route('data-mahasiswa');
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
        User::find($id)->delete();
        return back();
    }
}
