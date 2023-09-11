<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Dosen;
use App\Models\Grup;
use App\Models\Nilai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenNilaiController extends Controller
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
        $dosen = Dosen::query()
            ->where('user_id', $user)
            ->first();

        $now = Carbon::now()->toDateString();
        $grup = Grup::query()
            ->whereHas('daftar_sidang', function ($q) use ($dosen) {
                $q->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'daftar_sidangs.tugas_akhir_id')
                    ->where('tugas_akhirs.dosen_id', $dosen->id)
                    ->orWhere('penguji_1', $dosen->id)
                    ->orWhere('penguji_2', $dosen->id);
            })->orderBy('tanggal_sidang', 'desc')
            ->where('status_jadwal', 'published')
            ->whereDate('tanggal_sidang', $now)
            ->paginate(10)
            ->onEachSide(2);
        // dd($grup);
        // $daftar = DaftarSidang::query()
        //     ->join('tugas_akhirs', 'tugas_akhirs.id', '=', 'daftar_sidangs.tugas_akhir_id')
        //     ->whereIn('grup_id', $grup->pluck('id'))
        //     ->where('tugas_akhirs.dosen_id', $dosen->id)
        //     ->orWhere('penguji_1', $dosen->id)
        //     ->orWhere('penguji_2', $dosen->id)
        //     ->get();
        // dd($daftar);

        return view('dosen.nilai.index', compact('grup'));
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

        $grup = Grup::query()
            ->where('id', $id)
            ->first();

        $daftar = DaftarSidang::query()
            ->orderBy('jam_mulai_sidang', 'asc')
            ->where('grup_id', $grup->id)
            ->paginate(10);

        return view('dosen.nilai.show', compact('grup', 'daftar'));
    }

    public function showNilai($id)
    {
        $user = Auth::user()->id;
        $dosen = Dosen::query()
            ->where('user_id', $user)
            ->first();

        $daftar = DaftarSidang::query()
            ->where('id', $id)
            ->first();
        $nilai = Nilai::query()
            ->where('daftar_id', $daftar->id)
            ->first();
        return view('dosen.nilai.show-nilai', compact('daftar', 'nilai', 'dosen'));
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
        $daftar = DaftarSidang::query()
            ->where('id', $id)
            ->first();

        Nilai::query()
            ->updateOrCreate([
                'daftar_id' => $daftar->id,
            ], [
                'nilai_pembimbing' => $request->nilai_pembimbing,
                'nilai_penguji_1' => $request->nilai_penguji_1,
                'nilai_penguji_2' => $request->nilai_penguji_2
            ]);
        return back();
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
