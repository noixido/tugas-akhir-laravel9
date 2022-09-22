<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt($request->only('username', 'password'))) {
            switch (Auth::user()->role) {
                case 'akademik':
                    return redirect()->intended('/akademik');
                    break;
                case 'mahasiswa':
                    return redirect()->intended('/mahasiswa');
                    break;
                case 'dosen':
                    return redirect()->intended('/dosen');
                    break;
                case 'staffprodi':
                    return redirect()->intended('/staffprodi');
                    break;
                default:
                    return redirect('/')->with('login-error', 'gagal login!');
                    break;
            }
        }
        return redirect('/')->with('login-error', 'gagal login!');
    }

    public function daftar()
    {
        $data = ProgramStudi::all();
        return view('registrasi', compact('data'));
    }

    public function registrasi(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama' => ['required', 'min:3'],
            'username' => ['required'],
            'password' => ['required', 'min:6'],
            'nim' => ['required'],
            'angkatan' => ['required'],
            'email' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'no_telepon' => ['required'],
            'judul_tugas_akhir' => ['required'],
            'pembimbing' => ['required'],
        ]);
        // dd($request->all());
        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => "mahasiswa",
            'remember_token' => Str::random(60),
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'program_studi_id' => $request->program_studi,
            'email' => $request->email,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon' => $request->no_telepon,
            'judul_tugas_akhir' => $request->judul_tugas_akhir,
            'pembimbing' => $request->pembimbing
        ]);
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
