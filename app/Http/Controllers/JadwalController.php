<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Dosen;
use App\Models\Grup;
use App\Models\Mahasiswa;
use App\Models\Ruangan;
use App\Models\StaffProdi;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user()->id;
        $staffprodi = StaffProdi::query()
            ->where('user_id', $user)
            ->first();
        $data = Grup::query()
            ->where('status_jadwal', 'sedang dilengkapi')
            ->where('jurusan_id', $staffprodi->jurusan_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(2);
        return view('staffprodi.jadwal.draft', compact('data'));
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
        $data = Grup::query()
            ->where('id', $id)
            ->first();
        $daftar = DaftarSidang::query()
            ->orderBy('daftar_sidangs.created_at', 'asc')
            ->where('grup_id', $data->id)
            ->paginate(10);
        return view('staffprodi.jadwal.show', compact('data', 'daftar'));
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

    public function lengkapiJadwalA(Request $request, $id)
    {
        $grup = Grup::query()
            ->where('id', $id)
            ->first();
        $ruangan = Ruangan::query()
            ->orderBy('lantai', 'asc')
            ->orderBy('ruangan', 'asc')
            ->get();
        return view('staffprodi.jadwal.lengkapi-a', compact('grup', 'ruangan'));
    }

    public function prosesLengkapiJadwalA(Request $request, $id)
    {
        $grup = Grup::query()
            ->where('id', $id)
            ->first();
        $request->validate([
            'ruangan' => ['required'],
            'tanggal_sidang' => ['required'],
            'revisi' => ['required']
        ]);
        $grup->update([
            'ruangan_id' => $request->ruangan,
            'tanggal_sidang' => $request->tanggal_sidang,
            'batas_revisi' => $request->revisi,
        ]);
        return redirect()->route('detail-jadwal', $grup->id);
    }

    public function lengkapiJadwalB(Request $request, $id)
    {
        $daftar = DaftarSidang::query()
            ->where('id', $id)
            ->first();
        $ta = TugasAkhir::query()
            ->where('id', $daftar->tugas_akhir_id)
            ->first();
        $dosen = Dosen::query()
            ->where('jurusan_id', $daftar->jurusan_id)
            ->where('dosens.id', '!=', $ta->dosen_id)
            ->orderBy('nama_dosen', 'asc')
            ->get();
        // dd($dosen);

        return view('staffprodi.jadwal.lengkapi-b', compact('daftar', 'dosen'));
    }

    public function prosesLengkapiJadwalB(Request $request, $id)
    {
        // dd($request->all());
        $daftar = DaftarSidang::query()
            ->where('id', $id)
            ->first();
        $request->validate([
            'mulai' => ['required'],
            'selesai' => ['required'],
            'dosen1' => ['required'],
            'dosen2' => ['required'],
        ]);
        $daftar->update([
            'jam_mulai_sidang' => $request->mulai,
            'jam_selesai_sidang' => $request->selesai,
            'penguji_1' => $request->dosen1,
            'penguji_2' => $request->dosen2,
        ]);
        return redirect()->route('detail-jadwal', $daftar->grup_id);
    }

    public function kirimKeAkademik($id)
    {

        $grup = Grup::query()
            ->where('id', $id)
            ->first();
        $daftar = DaftarSidang::query()
            ->where('grup_id', $grup->id)
            ->first();

        if (
            $grup->ruangan_id != null
            && $grup->tanggal_sidang != null
            && $grup->batas_revisi != null
            && $daftar->jam_mulai_sidang != null
            && $daftar->jam_selesai_sidang != null
            && $daftar->penguji_1 != null
            && $daftar->penguji_2 != null
        ) {
            $grup->update([
                'status_jadwal' => 'sudah dilengkapi'
            ]);
        } else {
            return redirect()->route('detail-jadwal', $grup->id)->with('message', 'Silahkan lengkapi draft jadwal terlebih dahulu sebelum mengirimkan kembali data draft ke Akademik.');
        }
        return redirect()->route('staff-draft-jadwal');
    }
}
