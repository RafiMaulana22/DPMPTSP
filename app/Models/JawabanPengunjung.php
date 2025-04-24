<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanPengunjung extends Model
{
    use HasFactory;

    protected $table = 'jawaban_pengunjung';
    protected $fillable = ['id_alternatif', 'id_pertanyaan', 'id_pilihan'];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(pertanyaan::class, 'id_pertanyaan', 'id_pertanyaan');
    }

    public function pilihan()
    {
        return $this->belongsTo(Pilihan::class, 'id_pilihan', 'id_pilihan');
    }
}
