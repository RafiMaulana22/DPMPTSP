<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\AlternatifKriteria;
use App\Models\JawabanPengunjung;
use Illuminate\Http\Request;

class AlternatifControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Pengunjung',
            'alternatif' => Alternatif::get(),
            'no' => 1,
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
