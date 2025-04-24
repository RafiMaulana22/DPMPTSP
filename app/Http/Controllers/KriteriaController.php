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
            'no' => 1,
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
    public function edit(Kriteria $kriteria)
    {
        $data = [
            'title' => 'Edit Kriteria',
            'kriteria' => $kriteria,
        ];

        return view('admin.kriteria.kriteria-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        $kriteria->update([
            'token_kriteria' => Str::random(16),
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriteria)
    {
        try {
            $kriteria->delete();
            return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { // Code 23000 menandakan foreign key constraint violation
                return redirect()->route('kriteria.index')->with('error', 'Kriteria tidak bisa dihapus karena masih digunakan dalam data alternatif.');
            }
            return redirect()->route('kriteria.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
