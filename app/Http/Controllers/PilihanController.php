<?php

namespace App\Http\Controllers;

use App\Models\pertanyaan;
use App\Models\pilihan;
use App\Http\Requests\PilihanRequest as Request;
use Illuminate\Support\Str;

class PilihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd($pertanyaan);

        $data = [
            'title' => 'Pilihan',
            'pilihan' => pilihan::get(),
            'no' => 1,
        ];

        return view('admin.pilihan.pilihan', $data);
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
        $pilihan = new pilihan();
        $pilihan->token_pilihan = Str::random(16);
        $pilihan->pilihan = $request->pilihan;
        $pilihan->nilai = $request->nilai;
        $pilihan->save();

        return back()->with('success', 'Pilihan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(pilihan $pilihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pilihan $pilihan)
    {
        $data = [
            'title' => 'Edit Pilihan',
            'pilihan' => $pilihan,
        ];

        return view('admin.pilihan.pilihan-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,pilihan $pilihan)
    {
        $pilihan->update([
            'token_pilihan' => Str::random(16),
            'pilihan' => $request->pilihan,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('pilihan.index')->with('success', 'Pilihan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pilihan $pilihan)
    {
        $pilihan->delete();

        return back()->with('success', 'Pilihan berhasil dihapus');
    }
}
