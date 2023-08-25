<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DataDosenController extends Controller
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
            $data = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
                ->join('program_studis', 'program_studis.id', '=', 'dosens.jurusan_id')
                // ->sortable()
                ->orderBy('dosens.created_at', 'desc')
                ->where('nama_dosen', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nidn', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nama_prodi', 'LIKE', '%' . $request->search . '%')
                ->paginate(10)
                ->onEachSide('3');
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
                ->join('program_studis', 'program_studis.id', '=', 'dosens.jurusan_id')
                // ->sortable()
                ->orderBy('dosens.created_at', 'desc')
                ->paginate(10)
                ->onEachSide('3');
            Session::put('halaman_url', request()->fullUrl());
        }
        return view('akademik.dataDosen.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = ProgramStudi::orderBy('jenjang', 'asc')->orderBy('nama_prodi', 'asc')->get();
        return view('akademik.dataDosen.create', compact('data'));
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
            'nidn' => ['required'],
            'jurusan' => ['required', 'integer'],
            'email' => ['nullable'],
            'telepon' => ['nullable', 'numeric', 'min:10'],
            'alamat' => ['nullable']
        ]);
        // dd($request->all());
        $data = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => "dosen",
            'remember_token' => Str::random(60),
        ]);
        Dosen::create([
            'user_id' => $data->id,
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama,
            'jurusan_id' => $request->jurusan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('data-dosen');
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
        $data = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
            ->join('program_studis', 'program_studis.id', '=', 'dosens.jurusan_id')
            ->orderBy('dosens.created_at', 'desc')
            ->where('user_id', $id)
            ->first();
        // dd($data);
        return view('akademik.dataDosen.show', compact('data'));
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
        $prodis = ProgramStudi::orderBy('jenjang', 'asc')->orderBy('nama_prodi', 'asc')->get();
        $data = Dosen::join('users', 'users.id', '=', 'dosens.user_id')
            // ->join('program_studis', 'program_studis.id', '=', 'dosens.jurusan_id')
            ->orderBy('dosens.created_at', 'desc')
            ->where('user_id', $id)
            ->first();
        return view('akademik.dataDosen.edit', compact('data', 'prodis'));
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
                'nidn' => ['required'],
                'jurusan' => ['required', 'integer'],
                'email' => ['nullable'],
                'telepon' => ['nullable', 'numeric', 'min:10'],
                'alamat' => ['nullable'],
            ]);
            $data = User::find($id)
                ->update([
                    'username' => $request->username,
                ]);
            Dosen::where('user_id', $id)
                ->update([
                    // 'user_id' => $data->id,
                    'nidn' => $request->nidn,
                    'nama_dosen' => $request->nama,
                    'jurusan_id' => $request->jurusan,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                ]);
        } else {
            $request->validate([
                'nama' => ['required', 'min:3'],
                'username' => ['required'],
                'password' => ['min:8'],
                'nidm' => ['required'],
                'jurusan' => ['required', 'integer'],
                'email' => ['nullable'],
                'telepon' => ['nullable', 'numeric', 'min:10'],
                'alamat' => ['nullable'],
            ]);
            $data = User::find($id)
                ->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            Dosen::where('user_id', $id)
                ->update([
                    // 'user_id' => $data->id,
                    'nidn' => $request->nidn,
                    'nama_dosen' => $request->nama,
                    'jurusan_id' => $request->jurusan,
                    'email' => $request->email,
                    'telepon' => $request->telepon,
                    'alamat' => $request->alamat,
                ]);
        }
        if (session('halaman_url')) {
            return redirect(session('halaman_url'));
        }
        return redirect()->route('data-dosen');
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
        Dosen::where('user_id', $id)->delete();
        User::find($id)->delete();
        return back();
    }
}
