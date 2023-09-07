<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Grup;
use App\Models\Mahasiswa;
use App\Models\Nilai;
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
        $grup = Grup::query()
            ->where('status_jadwal', 'published')
            ->orderBy('tanggal_sidang', 'desc')
            ->paginate(5)
            ->onEachSide(2);
        $daftar = DaftarSidang::query()
            ->whereIn('grup_id', $grup->pluck('id'))
            ->orderBy('jam_mulai_sidang', 'asc')
            ->get();
        return view('mahasiswa.dashboard', compact('grup', 'daftar'));
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
        // dd($user);
        $data = Mahasiswa::query()
            // ->join('users', 'users.id', '=', 'mahasiswas.user_id')
            // ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
            ->where('user_id', $user)
            ->first();
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
        // dd($user);
        $prodis = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();
        $data = Mahasiswa::query()
            ->join('users', 'users.id', '=', 'mahasiswas.user_id')
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
            $data = User::query()
                ->find($user)
                ->update([
                    'username' => $request->username,
                ]);
            Mahasiswa::query()
                ->where('user_id', $user)
                ->update([
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
                'nim' => ['required'],
                'angkatan' => ['required', 'integer', 'min:1900', 'max:2222'],
                'jurusan' => ['required', 'integer'],
                'email' => ['required', 'min:3'],
                'telepon' => ['required', 'numeric', 'min:10'],
            ]);
            User::query()
                ->find($user)
                ->update([
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                ]);
            Mahasiswa::query()
                ->where('user_id', $user)
                ->update([
                    'nim' => $request->nim,
                    'nama_mahasiswa' => $request->nama,
                    'angkatan' => $request->angkatan,
                    'jurusan_id' => $request->jurusan,
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

    public function nilaiSidang()
    {
        $user = Auth::user()->id;
        $mhs = Mahasiswa::query()
            ->where('user_id', $user)
            ->first();
        $daftar = DaftarSidang::query()
            ->where('mahasiswa_id', $mhs->id)
            ->first();
        // dd($daftar);

        if ($daftar === null) {
            return redirect()->route('daftar-sidang')->with('message', 'Anda belum mendaftar sidang tugas akhir!');
        }


        $nilai = Nilai::query()
            // ->join('daftar_sidangs', 'daftar_sidangs.id', '=', 'nilais.daftar_id')  
            ->where('daftar_id', $daftar->id)
            ->first();

        // dd($nilai);

        $nilaiPembimbing = $nilai->nilai_pembimbing ?? 0;
        $nilaiPenguji1 = $nilai->nilai_penguji_1 ?? 0;
        $nilaiPenguji2 = $nilai->nilai_penguji_2 ?? 0;

        $nilai_sidang = number_format((($nilaiPembimbing * 2) + $nilaiPenguji1 + $nilaiPenguji2) / 4, 2);

        $nilai_huruf = '';

        if ($nilai_sidang >= 85 && $nilai_sidang <= 100) {
            $nilai_huruf = "A";
        } elseif ($nilai_sidang >= 80 && $nilai_sidang <= 84.99) {
            $nilai_huruf = "AB";
        } elseif ($nilai_sidang >= 75 && $nilai_sidang <= 79.99) {
            $nilai_huruf = "B";
        } elseif ($nilai_sidang >= 70 && $nilai_sidang <= 74.99) {
            $nilai_huruf = "BC";
        } elseif ($nilai_sidang >= 60 && $nilai_sidang <= 69.99) {
            $nilai_huruf = "C";
        } elseif ($nilai_sidang >= 55 && $nilai_sidang <= 59.99) {
            $nilai_huruf = "CD";
        } elseif ($nilai_sidang >= 0 && $nilai_sidang <= 54.99) {
            $nilai_huruf = "D";
        } else {
            $nilai_huruf = "Nilai Diluar Jangkauan";
        }
        return view('mahasiswa.nilai', compact('daftar', 'nilai', 'nilai_sidang',  'nilai_huruf'));
    }
}
