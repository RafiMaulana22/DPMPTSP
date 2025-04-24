<?php

namespace App\Http\Controllers;

use App\Models\pertanyaan;
use App\Http\Requests\PertanyaanRequest as Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Pertanyaan',
            'pertanyaan' => pertanyaan::get(),
            'no' => 1,
        ];

        return view('admin.pertanyaan.pertanyaan', $data);
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

        $pertanyaan = pertanyaan::create([
            'token_pertanyaan' => Str::random(16),
            'pertanyaan' => $request->pertanyaan,
        ]);

        DB::table('alternatif_kriteria')->insert(
            collect($request->input('pilihan', []))->map(function ($id_pilihan) use ($pertanyaan) {
                return [
                    'id_pertanyaan' => $pertanyaan->token_pertanyaan, // Pakai token sebagai id sementara
                    'id_pilihan' => $id_pilihan,
                ];
            })->toArray()
        );

        return back()->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pertanyaan $pertanyaan)
    {
        $data = [
            'title' => 'Edit Pertanyaan',
            'pertanyaan' => $pertanyaan,
        ];

        return view('admin.pertanyaan.pertanyaan-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pertanyaan $pertanyaan)
    {
        $pertanyaan->update([
            'token_pertanyaan' => Str::random(16),
            'pertanyaan' => $request->pertanyaan,
        ]);

        return redirect()->route('pertanyaan.index')->with('success', 'Pertanyaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pertanyaan $pertanyaan)
    {
        try {
            $pertanyaan->delete();

            return back()->with('success', 'Pertanyaan berhasil dihapus');
        } catch (QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Pertanyaan tidak dapat dihapus karena masih terdapat data yang terkait');
            }

            return back()->with('error', 'Terjadi kesalahan saat menghapus pertanyaan');
        }
    }
}
