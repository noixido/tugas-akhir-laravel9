<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('akademik.dashboard');
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
        $user = Auth::user()->id;
        // $data = User::find($user);
        $data = Admin::join('users', 'users.id', '=', 'admins.user_id')
            ->where('user_id', $user)->first();
        return view('akademik.profile', compact('data'));
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
        $user = Auth::user()->id;
        $data = Admin::join('users', 'users.id', '=', 'admins.user_id')
            ->orderBy('admins.created_at', 'desc')
            ->where('user_id', $user)
            ->first();
        return view('akademik.edit-profile', compact('data'));
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
        $user = Auth::user()->id;
        if ($request->password == null) {
            $request->validate([
                'username' => ['required'],
                'nama' => ['required'],
            ]);
            $data = User::find($user)
                ->update([
                    'username' => $request->username,
                ]);
            Admin::where('user_id', $user)->update([
                'nama_admin' => $request->nama,
            ]);
        } else {
            $request->validate([
                'username' => ['required'],
                'password' => ['min:8'],
            ]);
            $data = User::find($user)
                ->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            Admin::where('user_id', $user)->update([
                'nama_admin' => $request->nama,
            ]);
        }
        return redirect()->route('akademik_profile', $request->username);
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
