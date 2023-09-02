<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Grup;
use App\Models\ProgramStudi;
use App\Models\StaffProdi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grup = Grup::query()
            ->orderBy('tanggal_sidang', 'desc')
            ->get();
        $daftar = DaftarSidang::query()
            ->whereIn('grup_id', $grup->pluck('id'))
            ->orderBy('jam_mulai_sidang', 'asc')
            ->get();
        return view('staffprodi.dashboard', compact('grup', 'daftar'));
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
        // dd($user);
        $data = StaffProdi::query()
            ->join('users', 'users.id', '=', 'staff_prodis.user_id')
            ->join('program_studis', 'program_studis.id', '=', 'staff_prodis.jurusan_id')
            ->where('user_id', $user)
            ->first();
        return view('staffprodi.profile', compact('data'));
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
        // dd($user);
        $prodis = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();
        $data = StaffProdi::query()
            ->join('users', 'users.id', '=', 'staff_prodis.user_id')
            ->orderBy('staff_prodis.created_at', 'desc')
            ->where('user_id', $user)
            ->first();

        return view('staffprodi.edit-profile', compact('data', 'prodis'));
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
                'jurusan' => ['required', 'integer'],
            ]);
            $data = User::query()
                ->find($user)
                ->update([
                    'username' => $request->username,
                ]);
            StaffProdi::query()
                ->where('user_id', $user)
                ->update([
                    'nama_staffprodi' => $request->nama,
                    'jurusan_id' => $request->jurusan,
                ]);
        } else {
            $request->validate([
                'username' => ['required'],
                'password' => ['min:8'],
                'nama' => ['required', 'min:3'],
                'jurusan' => ['required', 'integer'],
            ]);
            User::query()
                ->find($user)
                ->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            StaffProdi::query()
                ->where('user_id', $user)
                ->update([
                    'nama_staffprodi' => $request->nama,
                    'jurusan_id' => $request->jurusan,
                ]);
        }
        return redirect()->route('staffprodi_profile', $request->username);
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
