<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\JawabanPengunjung;
use App\Models\pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pertanyaan' => pertanyaan::get()
        ];

        return view('landing.landing', $data);
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
        // dd($request->all());

        $pengunjung = Alternatif::insertGetId([
            'token_alternatif' => Str::random(16),
            'nama_alternatif' => $request->input('nama_alternatif'),
        ]);

        $jawaban = $request->input('pilihan'); // Ambil jawaban dari form

        foreach ($jawaban as $id_pertanyaan => $id_pilihan) {
            JawabanPengunjung::create([
                'id_alternatif' => $pengunjung,
                'id_pertanyaan' => $id_pertanyaan,
                'id_pilihan' => $id_pilihan,
            ]);
        }

        // Tambahkan session flash
        session()->flash('form_submitted', true);

        return redirect()->back()->with('success', 'Jawaban berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
