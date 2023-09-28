<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Grup;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class DraftJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $periode = Grup::query()
            ->select('periode_ke')
            ->orderBy('periode_ke', 'asc')
            ->where('status_jadwal', '!=', 'sudah dilengkapi')
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'published')
            ->groupBy('periode_ke')
            ->get();
        $yudisium = Grup::query()
            ->select('yudisium_ke')
            ->orderBy('yudisium_ke', 'asc')
            ->where('status_jadwal', '!=', 'sudah dilengkapi')
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'published')
            ->groupBy('yudisium_ke')
            ->get();
        $tahun = Grup::query()
            ->select('tahun_akademik')
            ->orderBy('tahun_akademik', 'asc')
            ->where('status_jadwal', '!=', 'sudah dilengkapi')
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'published')
            ->groupBy('tahun_akademik')
            ->get();
        $prodi = Grup::query()
            ->select('jurusan_id')
            ->where('status_jadwal', '!=', 'sudah dilengkapi')
            ->where('status_jadwal', '!=', 'sedang dilengkapi')
            ->where('status_jadwal', '!=', 'published')
            ->groupBy('jurusan_id')
            ->get();
        // $prodi = ProgramStudi::query()
        //     ->orderBy('jenjang', 'asc')
        //     ->orderBy('nama_prodi', 'asc')
        //     ->get();
        $dataQuery = Grup::query()
            ->where('status_jadwal', 'belum dilengkapi')
            ->orderBy('created_at', 'desc')
            ->where(function ($q) use ($request) {
                if ($request->periode) {
                    $q->where('periode_ke', $request->periode);
                }
                if ($request->yudisium) {
                    $q->where('yudisium_ke', $request->yudisium);
                }
                if ($request->tahun) {
                    $q->where('tahun_akademik', $request->tahun);
                }
                if ($request->jurusan) {
                    $q->whereHas('daftar_sidang.program_studi', function ($q) use ($request) {
                        $q->where('id', $request->jurusan);
                    });
                }
            });
        $data = $dataQuery->paginate(10)
            ->onEachSide(2);
        return view('akademik.dataJadwal.draft', compact('data', 'prodi', 'periode', 'yudisium', 'tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $prodi = ProgramStudi::query()
            ->orderBy('jenjang', 'asc')
            ->orderBy('nama_prodi', 'asc')
            ->get();
        $data = DaftarSidang::query()
            ->orderBy('daftar_sidangs.created_at', 'asc')
            ->where('grup_id', null)
            ->get();
        // dd($data);
        return view('akademik.dataJadwal.tambah-draft', compact('prodi', 'data'));
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
            'periode' => ['required'],
            'yudisium' => ['required'],

            'sidang' => ['required'],
            'revisi' => ['required'],

            'jurusan' => ['required'],
        ]);
        $grup = Grup::create([
            'periode_ke' => $request->periode,
            'yudisium_ke' => $request->yudisium,

            'tanggal_sidang' => $request->sidang,
            'batas_revisi' => $request->revisi,

            'jurusan_id' => $request->jurusan,
            'tahun_akademik' => $request->tahun,
            'status_jadwal' => 'belum dilengkapi',
        ]);
        DaftarSidang::query()
            ->whereIn('id', $request->daftarSidang)
            ->update([
                'grup_id' => $grup->id,
                'status_pendaftaran' => 'sedang dijadwalkan'
            ]);
        return redirect()->route('draft-jadwal');
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
            ->orderBy('jam_mulai_sidang', 'asc')
            ->where('grup_id', $data->id)
            ->paginate(10);
        return view('akademik.dataJadwal.show', compact('data', 'daftar'));
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
        DaftarSidang::query()
            ->where('grup_id', $id)
            ->update([
                'grup_id' => null,
            ]);
        Grup::query()
            ->find($id)
            ->delete();
        return back();
    }

    public function kirimKeProdi($id)
    {
        Grup::query()
            ->where('id', $id)
            ->update([
                'status_jadwal' => 'sedang dilengkapi'
            ]);
        return redirect()->route('draft-jadwal');
    }


    public function lengkapiJam(Request $request, $id)
    {
        $daftar = DaftarSidang::query()
            ->where('id', $id)
            ->first();
        return view('akademik.dataJadwal.lengkapi-jam', compact('daftar'));
    }
    public function prosesLengkapiJam(Request $request, $id)
    {
        $daftar = DaftarSidang::query()
            ->where('id', $id)
            ->first();
        $request->validate([
            'mulai' => ['required'],
            'selesai' => ['required']
        ]);
        $daftar->update([
            'jam_mulai_sidang' => $request->mulai,
            'jam_selesai_sidang' => $request->selesai,
        ]);
        return redirect()->route('detail-draft-jadwal', $daftar->grup_id);
    }
}
