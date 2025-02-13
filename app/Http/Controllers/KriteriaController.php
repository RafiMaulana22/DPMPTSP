<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Http\Requests\KriteriaRequest as Request;
use Illuminate\Support\Str;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Kriteria Kepuasan',
            'kriteria' => Kriteria::get(),
            'no' => 1
        ];

        return view('admin.kriteria.kriteria', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kriteria = new Kriteria();
        $kriteria->token_kriteria = Str::random(16);
        $kriteria->nama_kriteria = $request->nama_kriteria;
        $kriteria->bobot = $request->bobot;
        $kriteria->jenis = $request->jenis;
        $kriteria->save();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambah.');
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
