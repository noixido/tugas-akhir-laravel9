<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dosen.dashboard');
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
        $data = Dosen::query()
            ->join('users', 'users.id', '=', 'dosens.user_id')
            ->join('program_studis', 'program_studis.id', '=', 'dosens.jurusan_id')
            ->where('user_id', $user)
            ->first();
        return view('dosen.profile.profile', compact('data'));
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
        $prodis = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();
        $data = Dosen::query()
            ->join('users', 'users.id', '=', 'dosens.user_id')
            ->orderBy('dosens.created_at', 'desc')
            ->where('user_id', $user)
            ->first();
        return view('dosen.profile.edit-profile', compact('data', 'prodis'));
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
                'nama' => ['required', 'min:3'],
                'nidn' => ['required'],
                'jurusan' => ['required', 'integer'],
                'email' => ['required', 'min:3'],
                'telepon' => ['required', 'numeric', 'min:10'],
                'alamat' => ['required'],
            ]);
            User::query()
                ->find($user)
                ->update([
                    'username' => $request->username,
                ]);
            Dosen::query()
                ->where('user_id', $user)
                ->update([
                    'nidn' => $request->nidn,
                    'nama_dosen' => $request->nama,
                    'jurusan_id' => $request->jurusan,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                ]);
        } else {
            $request->validate([
                'username' => ['required'],
                'password' => ['min:8'],
                'nama' => ['required', 'min:3'],
                'nidn' => ['required'],
                'jurusan' => ['required', 'integer'],
                'email' => ['required', 'min:3'],
                'telepon' => ['required', 'numeric', 'min:10'],
                'alamat' => ['required'],
            ]);
            User::query()
                ->find($user)
                ->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            Dosen::query()
                ->where('user_id', $user)
                ->update([
                    'nidn' => $request->nidn,
                    'nama_dosen' => $request->nama,
                    'jurusan_id' => $request->jurusan,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                ]);
        }
        return redirect()->route('dosen_profile', $request->username);
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
