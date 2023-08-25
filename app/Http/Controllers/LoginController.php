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
            'nim' => ['required'],
            'username' => ['required'],
            'password' =>
            ['required', 'min:6', 'password'],
        ]);
        // dd($request->all());
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => "mahasiswa",
            'remember_token' => Str::random(60),
        ]);
        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama' => $request->nama,
        ]);
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
