<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\StaffProdi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DataStaffProdiController extends Controller
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
            $data = StaffProdi::join('users', 'users.id', '=', 'staff_prodis.user_id')
                ->join('program_studis', 'program_studis.id', '=', 'staff_prodis.jurusan_id')
                // ->sortable()
                ->orderBy('staff_prodis.created_at', 'desc')
                ->where('nama', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nama_prodi', 'LIKE', '%' . $request->search . '%')
                ->paginate(10)
                ->onEachSide('3');
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = StaffProdi::join('users', 'users.id', '=', 'staff_prodis.user_id')
                ->join('program_studis', 'program_studis.id', '=', 'staff_prodis.jurusan_id')
                // ->sortable()
                ->orderBy('staff_prodis.created_at', 'desc')
                ->paginate(10)
                ->onEachSide('3');
            Session::put('halaman_url', request()->fullUrl());
        }
        return view('akademik.dataStaffProdi.index', compact('data'));
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
        return view('akademik.dataStaffProdi.create', compact('data'));
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
            'jurusan' => ['required', 'integer'],
        ]);
        // dd($request->all());
        $data = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => "staffprodi",
            'remember_token' => Str::random(60),
        ]);
        StaffProdi::create([
            'user_id' => $data->id,
            'jurusan_id' => $request->jurusan,
        ]);
        return redirect()->route('data-staffprodi');
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
        $prodis = ProgramStudi::orderBy('jenjang', 'asc')->orderBy('nama_prodi', 'asc')->get();
        $data = StaffProdi::join('users', 'users.id', '=', 'staff_prodis.user_id')
            // ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
            ->orderBy('staff_prodis.created_at', 'desc')
            ->where('user_id', $id)
            ->first();
        return view('akademik.dataStaffProdi.edit', compact('data', 'prodis'));
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
                'jurusan' => ['required', 'integer'],
            ]);
            $data = User::find($id)
                ->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                ]);
            StaffProdi::where('user_id', $id)
                ->update([
                    // 'user_id' => $data->id,
                    'jurusan_id' => $request->jurusan,
                ]);
        } else {
            $request->validate([
                'nama' => ['required', 'min:3'],
                'username' => ['required'],
                'password' => ['min:8'],
                'jurusan' => ['required', 'integer'],
            ]);
            $data = User::find($id)
                ->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            StaffProdi::where('user_id', $id)
                ->update([
                    // 'user_id' => $data->id,
                    'jurusan_id' => $request->jurusan,
                ]);
        }
        if (session('halaman_url')) {
            return redirect(session('halaman_url'));
        }
        return redirect()->route('data-staffprodi');
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
        StaffProdi::where('user_id', $id)->delete();
        User::find($id)->delete();
        return back();
    }
}
