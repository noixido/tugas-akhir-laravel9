<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            $data = Mahasiswa::query()
                ->join('users', 'users.id', '=', 'mahasiswas.user_id')
                ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
                // ->sortable()
                ->orderBy('mahasiswas.created_at', 'desc')
                ->orWhere('nama_mahasiswa', 'LIKE', '%' . $request->search . '%')
                ->orWhere('username', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nim', 'LIKE', '%' . $request->search . '%')
                ->orWhere('angkatan', 'LIKE', '%' . $request->search . '%')
                ->orWhere('jenjang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nama_prodi', 'LIKE', '%' . $request->search . '%')
                ->paginate(10)
                ->onEachSide(2);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Mahasiswa::query()
                ->join('users', 'users.id', '=', 'mahasiswas.user_id')
                ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
                // ->sortable()
                ->orderBy('mahasiswas.created_at', 'desc')
                ->paginate(10)
                ->onEachSide(2);
            Session::put('halaman_url', request()->fullUrl());
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
        $data = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();
        return view('akademik.dataMahasiswa.create', compact('data'));
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
            'username' => ['required'],
            'password' => ['required', 'min:8'],
            'nim' => ['required'],
            'angkatan' => ['required', 'integer', 'min:1900', 'max:2222'],
            'jurusan' => ['required', 'integer'],
            'email' => ['nullable'],
            'telepon' => ['nullable', 'numeric', 'min:10'],
        ]);
        // dd($request->all());
        $data = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => "mahasiswa",
            'remember_token' => Str::random(60),
        ]);
        Mahasiswa::create([
            'user_id' => $data->id,
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama,
            'angkatan' => $request->angkatan,
            'jurusan_id' => $request->jurusan,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);
        return redirect()->route('data-mahasiswa');
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
        // dd($id);
        $data = Mahasiswa::query()
            ->join('users', 'users.id', '=', 'mahasiswas.user_id')
            ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
            ->orderBy('mahasiswas.created_at', 'desc')
            ->where('user_id', $id)
            ->first();
        // dd($data);
        return view('akademik.dataMahasiswa.show', compact('data'));
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
        $prodis = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();
        $data = Mahasiswa::query()
            ->join('users', 'users.id', '=', 'mahasiswas.user_id')
            // ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
            ->orderBy('mahasiswas.created_at', 'desc')
            ->where('user_id', $id)
            ->first();
        return view('akademik.dataMahasiswa.edit', compact('data', 'prodis'));
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
                'nim' => ['required'],
                'angkatan' => ['required', 'integer', 'min:1900', 'max:2222'],
                'jurusan' => ['required', 'integer'],
                'email' => ['required'],
                'telepon' => ['required', 'numeric', 'min:10'],
            ]);
            $data = User::query()
                ->find($id)
                ->update([
                    'username' => $request->username,
                ]);
            Mahasiswa::query()
                ->where('user_id', $id)
                ->update([
                    // 'user_id' => $data->id,
                    'nim' => $request->nim,
                    'nama_mahasiswa' => $request->nama,
                    'angkatan' => $request->angkatan,
                    'jurusan_id' => $request->jurusan,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                ]);
        } else {
            $request->validate([
                'nama' => ['required', 'min:3'],
                'username' => ['required'],
                'password' => ['min:8'],
                'nim' => ['required'],
                'angkatan' => ['required', 'integer', 'min:1900', 'max:2222'],
                'jurusan' => ['required', 'integer'],
                'email' => ['required'],
                'telepon' => ['required', 'numeric', 'min:10'],
            ]);
            $data = User::query()
                ->find($id)
                ->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            Mahasiswa::query()
                ->where('user_id', $id)
                ->update([
                    // 'user_id' => $data->id,
                    'nim' => $request->nim,
                    'nama_mahasiswa' => $request->nama,
                    'angkatan' => $request->angkatan,
                    'jurusan_id' => $request->jurusan,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
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
        Mahasiswa::query()
            ->where('user_id', $id)
            ->delete();
        User::query()
            ->find($id)
            ->delete();
        return back();
    }
}
