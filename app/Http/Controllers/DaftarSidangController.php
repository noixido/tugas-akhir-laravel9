<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\DaftarSidang;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarSidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user()->id;
        $mahasiswa = Mahasiswa::query()
            ->where('user_id', $user)
            ->first();
        $mhs = Mahasiswa::query()
            ->join('users', 'users.id', '=', 'mahasiswas.user_id')
            // ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
            ->where('mahasiswas.user_id', $user)
            ->first();
        $ta = TugasAkhir::query()
            ->join('mahasiswas', 'mahasiswas.id', '=', 'tugas_akhirs.mahasiswa_id')
            ->join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->where('mahasiswas.user_id', $user)
            ->first();
        $bimbinganCount = Bimbingan::query()
            ->where('mahasiswa_id', $mahasiswa->id)
            ->where('status_bimbingan', 'diterima')
            ->count();


        $daftar = DaftarSidang::query()
            ->where('mahasiswa_id', $mahasiswa->id)
            ->first();

        if ($daftar != null) {
            return redirect()->route('lihat-daftar-sidang', $daftar->id);
        } else {
            return view('mahasiswa.daftar.daftar-sidang', compact('mhs', 'ta', 'bimbinganCount'));
        }
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
        // ddd($request);
        $request->validate(([
            'kelas' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'alamat_mahasiswa' => ['required'],
            'ipk' => ['required', 'numeric', 'max:4'],
            'pas_foto' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'spp' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'ijazah' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'akte' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'kk' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'ujikom_1' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'ujikom_2' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'ujikom_3' => ['nullable', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'ujikom_4' => ['nullable', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'ujikom_5' => ['nullable', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'peka' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
            'toefl' => ['required', 'image', 'mimes:jpg,jpeg', 'file', 'max:2048'],
        ]));


        $user = Auth::user()->id;
        $mhs = Mahasiswa::query()
            ->where('user_id', $user)
            ->first();
        $mahasiswa = Mahasiswa::query()
            ->join('program_studis', 'program_studis.id', '=', 'mahasiswas.jurusan_id')
            ->where('user_id', $user)
            ->first();
        $ta = TugasAkhir::query()
            ->where('mahasiswa_id', $mhs->id)
            ->first();
        $bimbingan = Bimbingan::query()
            ->where('mahasiswa_id', $mhs->id)
            ->first();

        if ($ta === null) {
            return redirect()->route('tugas-akhir')->with('message', 'Silahkan lengkapi data tugas akhir anda sebelum mendaftar!');
        }
        if (Bimbingan::where('status_bimbingan', 'diterima')->where('mahasiswa_id', $mhs->id)->count() < 8) {
            return redirect()->route('daftar-sidang')->with('message', 'Kelihatannya Bimbingan yang telah dikonfirmasi oleh dosen pembimbing anda belum mencukupi syarat minimum untuk melakukan pendaftaran sidang tugas akhir.
            Syarat minimum untuk melakukan pendaftaran sidang tugas akhir salah satunya adalah bimbingan yang telah dikonfirmasi oleh dosen pembimbing sudah mencapai sebanyak 8 bimbingan paling sedikit.
            Silakan lengkapi bimbingan anda terlebih dahulu!');
        }

        $pasFotoCustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Pas-Foto.jpg");
        $sppCustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-SPP.jpg");
        $ijazahCustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Ijazah.jpg");
        $akteCustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Akte.jpg");
        $kkCustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Kartu-Keluarga.jpg");
        $ujikom1CustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Ujikom-1.jpg");
        $ujikom2CustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Ujikom-2.jpg");
        $ujikom3CustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Ujikom-3.jpg");
        $ujikom4CustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Ujikom-4.jpg");
        $ujikom5CustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Ujikom-5.jpg");
        $pekaCustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Peka.jpg");
        $toeflCustomName = str_replace(" ", "-", $mhs->nim . "_" . $mhs->nama_mahasiswa . "_" . "Scan-Toefl.jpg");

        if ($request->file('ujikom_3')) {
            $ujikom3 =  $request->file('ujikom_3')->storeAs('images/ujikom', $ujikom3CustomName, 'public');
        } else {
            $ujikom3 = null;
        }
        if ($request->file('ujikom_4')) {
            $ujikom4 =  $request->file('ujikom_4')->storeAs('images/ujikom', $ujikom4CustomName, 'public');
        } else {
            $ujikom4 = null;
        }
        if ($request->file('ujikom_5')) {
            $ujikom5 =  $request->file('ujikom_5')->storeAs('images/ujikom', $ujikom5CustomName, 'public');
        } else {
            $ujikom5 = null;
        }

        DaftarSidang::create([
            'mahasiswa_id' => $mhs->id,
            'jurusan_id' => $mahasiswa->jurusan_id,
            'kelas' => $request->kelas,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat_mahasiswa,
            'tugas_akhir_id' => $ta->id,
            'bimbingan_id' => $bimbingan->id,
            'ipk_saat_ini' => $request->ipk,
            'pas_foto' => $request->file('pas_foto')->storeAs('images/pass-photo', $pasFotoCustomName, 'public'),
            'scan_bukti_spp' => $request->file('spp')->storeAs('images/spp', $sppCustomName, 'public'),
            'scan_ijazah_terakhir' => $request->file('ijazah')->storeAs('images/ijazah', $ijazahCustomName, 'public'),
            'scan_akta_kelahiran' => $request->file('akte')->storeAs('images/akte', $akteCustomName, 'public'),
            'scan_kartu_keluarga' => $request->file('kk')->storeAs('images/kartu-keluarga', $kkCustomName, 'public'),
            'scan_sertifikat_ujikom_1' => $request->file('ujikom_1')->storeAs('images/ujikom', $ujikom1CustomName, 'public'),
            'scan_sertifikat_ujikom_2' => $request->file('ujikom_2')->storeAs('images/ujikom', $ujikom2CustomName, 'public'),
            'scan_sertifikat_ujikom_3' => $ujikom3,
            'scan_sertifikat_ujikom_4' => $ujikom4,
            'scan_sertifikat_ujikom_5' => $ujikom5,
            'scan_sertifikat_peka' => $request->file('peka')->storeAs('images/peka', $pekaCustomName, 'public'),
            'scan_sertifikat_toefl' => $request->file('toefl')->storeAs('images/toefl', $toeflCustomName, 'public'),
            'status_pendaftaran' => 'sedang ditinjau',
        ]);

        return redirect()->route('daftar-sidang');
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

        // return "dapet id lu.. id pendaftaran sidang lu adalah " . $id;

        $user = Auth::user()->id;
        $mhs = Mahasiswa::query()
            ->where('user_id', $user)
            ->first();

        $ta = TugasAkhir::query()
            ->join('mahasiswas', 'mahasiswas.id', '=', 'tugas_akhirs.mahasiswa_id')
            ->join('dosens', 'dosens.id', '=', 'tugas_akhirs.dosen_id')
            ->where('tugas_akhirs.mahasiswa_id', $mhs->id)
            ->first();
        $bimbinganCount = Bimbingan::query()
            ->where('mahasiswa_id', $mhs->id)
            ->where('status_bimbingan', 'diterima')
            ->count();
        $data = DaftarSidang::query()
            ->join('mahasiswas', 'mahasiswas.id', '=', 'daftar_sidangs.mahasiswa_id')
            ->join('program_studis', 'program_studis.id', '=', 'daftar_sidangs.jurusan_id')
            ->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'daftar_sidangs.tugas_akhir_id')
            ->where('daftar_sidangs.mahasiswa_id', $mhs->id)
            ->first();
        $create = DaftarSidang::query()
            ->where('daftar_sidangs.mahasiswa_id', $mhs->id)
            ->first();

        return view('mahasiswa.daftar.lihat-daftar-sidang', compact('data', 'ta', 'bimbinganCount', 'create'));
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
