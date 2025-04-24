<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pilihan extends Model
{
    /** @use HasFactory<\Database\Factories\PilihanFactory> */
    use HasFactory;

    protected $table = 'pilihans';
    protected $primaryKey = 'token_pilihan';
    protected $keyType = 'string';
    protected $guarded = ['id_pilihan'];

    public function getRouteKeyName()
    {
        return 'token_pilihan';
    }

    public function pertanyaan()
    {
        return $this->belongsToMany(pertanyaan::class, 'alternatif_kriteria', 'id_pilihan', 'id_pertanyaan', 'id_pilihan', 'id_pertanyaan');
    }

    public function jawabanPengunjung()
    {
        return $this->hasMany(jawabanPengunjung::class, 'id_pilihan', 'id_pilihan');
    }
}
