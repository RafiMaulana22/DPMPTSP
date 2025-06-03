<?php

namespace App\Http\Controllers;

use App\Models\pertanyaan;
use App\Http\Requests\PertanyaanRequest as Request;
use App\Models\pilihan;
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
            'pertanyaan' => pertanyaan::with('pilihan')->get(),
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
        $pertanyaan->load('pilihan'); // Load pilihan terkait

        $data = [
            'title' => 'Edit Pertanyaan',
            'pertanyaan' => $pertanyaan,
            'allPilihans' => pilihan::orderBy('pilihan', 'asc')->get(),
            'selectedPilihanIds' => $pertanyaan->pilihan->pluck('id_pilihan')->toArray(), // Ambil ID pilihan yang sudah dipilih
        ];

        return view('admin.pertanyaan.pertanyaan-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pertanyaan $pertanyaan)
    {
        // 1. Validasi input (sangat direkomendasikan)
        // Sesuaikan aturan validasi dengan kebutuhan Anda
        $validatedData = $request->validate([
            'pertanyaan' => 'required|string|max:65535', // max:65535 untuk tipe TEXT MySQL
            'pilihan'    => 'nullable|array', // 'pilihan' bisa jadi tidak dikirim (jika semua tidak dicentang) atau berupa array
            'pilihan.*'  => 'integer|exists:pilihans,id_pilihan', // Setiap item dalam 'pilihan' harus integer dan ada di tabel 'pilihans' kolom 'id_pilihan'
            // Ganti 'pilihans,id_pilihan' jika nama tabel atau primary key model Pilihan Anda berbeda.
            // Misalnya, jika primary key Pilihan adalah 'id', gunakan 'exists:pilihans,id'
        ]);

        // 2. Update data utama pada model Pertanyaan
        $pertanyaanDataToUpdate = [
            'pertanyaan' => $validatedData['pertanyaan'],
        ];

        // Pertimbangkan apakah 'token_pertanyaan' benar-benar perlu di-update setiap kali.
        // Jika ini adalah ID unik yang dibuat saat pembuatan, mungkin tidak perlu diubah.
        // Jika memang perlu, Anda bisa menambahkannya di sini:
        $pertanyaanDataToUpdate['token_pertanyaan'] = Str::random(16);
        // Untuk saat ini, saya akan mengomentarinya jika tidak selalu dibutuhkan saat update.
        // Jika Anda memutuskan untuk meng-update token, pastikan field tersebut fillable di model Pertanyaan.

        $pertanyaan->update($pertanyaanDataToUpdate);

        // 3. Sinkronisasi pilihan jawaban di tabel pivot
        // Ini mengasumsikan Anda memiliki relasi bernama 'pilihans()' di model Pertanyaan Anda.
        // Method sync() akan menangani penambahan/penghapusan relasi di tabel pivot.
        if ($request->has('pilihan')) {
            // Jika field 'pilihan' ada di request (meskipun array kosong jika semua tidak dicentang),
            // gunakan nilainya. Jika 'pilihan' ada tapi null (seharusnya tidak terjadi dengan checkbox),
            // '?? []' akan memastikan array kosong digunakan.
            $pertanyaan->pilihan()->sync($validatedData['pilihan'] ?? []);
        } else {
            // Jika field 'pilihan' sama sekali tidak ada di request (tidak ada checkbox yang dicentang),
            // ini berarti semua relasi pilihan harus dihapus untuk pertanyaan ini.
            $pertanyaan->pilihan()->sync([]);
        }

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
