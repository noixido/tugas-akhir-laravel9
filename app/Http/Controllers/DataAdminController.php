<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
            $data = Admin::join('users', 'users.id', '=', 'admins.user_id')
                // ->sortable()
                ->orderBy('admins.created_at', 'desc')
                ->where('nama_admin', 'LIKE', '%' . $request->search . '%')
                ->orWhere('username', 'LIKE', '%' . $request->search . '%')
                ->paginate(10)
                ->onEachSide('3');

            //ini bikin session biar kalo update data,
            //user gk akan dibawa ke page paling petama,
            //tapi di page tempat terakhir kita edit data
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Admin::join('users', 'users.id', '=', 'admins.user_id')
                // sortable()
                ->orderBy('admins.created_at', 'desc')
                ->paginate(10)
                ->onEachSide('3');

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
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'akademik',
            'remember_token' => Str::random(60),
        ]);
        Admin::create([
            'user_id' => $data->id,
            'nama_admin' => $request->nama,
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
        $data = Admin::join('users', 'users.id', '=', 'admins.user_id')
            ->orderBy('admins.created_at', 'desc')
            ->where('user_id', $id)
            ->first();
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
                    'username' => $request->username,
                ]);
            Admin::where('user_id', $id)->update([
                'nama_admin' => $request->nama,
            ]);
        } else {
            $request->validate([
                'nama' => ['required', 'min:3'],
                'username' => ['required'],
                'password' => ['min:8'],
            ]);
            $data = User::find($id)
                ->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            Admin::where('user_id', $id)->update([
                'nama_admin' => $request->nama,
            ]);
        }
        if (session('halaman_url')) {
            return redirect(session('halaman_url'));
        }
        return redirect()->route('data-admin');
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
        Admin::where('user_id', $id)->delete();
        User::find($id)->delete();
        return back();
    }
}
