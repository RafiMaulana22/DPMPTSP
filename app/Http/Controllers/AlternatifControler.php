<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifKriteria;
use App\Models\JawabanPengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data untuk chart agregat jawaban
        // Query ini akan menghitung berapa kali setiap "pilihan" dipilih oleh semua pengunjung.
        $dataChart = JawabanPengunjung::join('pilihans', 'jawaban_pengunjung.id_pilihan', '=', 'pilihans.id_pilihan')
            ->select(
                'pilihans.pilihan as nama_opsi_pilihan', // Menggunakan kolom 'pilihan' dari tabel 'pilihans'
                DB::raw('count(jawaban_pengunjung.id_pilihan) as total_jawaban')
            )
            ->groupBy('pilihans.id_pilihan', 'pilihans.pilihan') // Group juga menggunakan kolom 'pilihan'
            ->orderBy('total_jawaban', 'desc')
            ->get();

        // Menyiapkan semua data untuk dikirim ke view
        $data = [
            'title' => 'Pengunjung',
            'alternatif' => Alternatif::get(), // Menggunakan nama variabel yang diubah
            'no' => 1,               // Menggunakan nama variabel yang diubah
            'labelsChart' => $dataChart->pluck('nama_opsi_pilihan')->toArray(),
            'nilaiChart' => $dataChart->pluck('total_jawaban')->toArray(),
        ];

        return view('admin.alternatif.alternatif', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternatif $alternatif)
    {

        // dd($alternatif->pertanyaan());

        $data = [
            'title' => 'Detail Alternatif',
            'alternatif' => $alternatif,
            'jawaban' => JawabanPengunjung::where('id_alternatif', $alternatif->id_alternatif)->get(),
        ];

        return view('admin.alternatif.alternatif-show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
