<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('mahasiswa.dashboard');
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
        $data = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
            ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
            ->where('user_id', $user)->first();
        return view('mahasiswa.profile', compact('data'));
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
        $prodis = ProgramStudi::orderBy('jenjang', 'asc')->orderBy('nama_prodi', 'asc')->get();
        $data = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.user_id')
            ->orderBy('mahasiswas.created_at', 'desc')
            ->where('user_id', $user)
            ->first();

        return view('mahasiswa.edit-profile', compact('data', 'prodis'));
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
                'nim' => ['required'],
                'angkatan' => ['required', 'integer', 'min:1900', 'max:2222'],
                'jurusan' => ['required', 'integer'],
                'email' => ['required', 'min:3'],
                'telepon' => ['required', 'numeric', 'min:10'],
            ]);
            $data = User::find($user)
                ->update([
                    'username' => $request->username,
                ]);
            Mahasiswa::where('user_id', $user)->update([
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama,
                'angkatan' => $request->angkatan,
                'jurusan_id' => $request->jurusan,
                'email' => $request->email,
                'telepon' => $request->telepon
            ]);
        } else {
            $request->validate([
                'username' => ['required'],
                'password' => ['min:8'],
                'nama' => ['required', 'min:3'],
                'nim' => ['required', 'min:3'],
                'angkatan' => ['required', 'min:3'],
                'jurusan' => ['required', 'min:3'],
                'email' => ['required', 'min:3'],
                'telepon' => ['required', 'numeric', 'min:10'],
            ]);
            $data = User::find($user)
                ->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            Mahasiswa::where('user_id', $user)->update([
                'nim' => $request->nim,
                'nama_mahasiswa' => $request->nama,
                'angkatan' => $request->angkatan,
                'jurusan' => $request->jurusan,
                'email' => $request->email,
                'telepon' => $request->telepon
            ]);
        }
        return redirect()->route('mahasiswa_profile', $request->username);
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
