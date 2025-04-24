<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaans';
    protected $primaryKey = 'token_pertanyaan';
    protected $keyType = 'string';
    protected $guarded = ['id_pertanyaan'];

    public function getRouteKeyName()
    {
        return 'token_pertanyaan';
    }

    public function pilihan()
    {
        return $this->belongsToMany(pilihan::class, 'alternatif_kriteria', 'id_pertanyaan', 'id_pilihan', 'id_pertanyaan', 'id_pilihan');
    }

    public function jawabanPengunjung()
    {
        return $this->hasMany(jawabanPengunjung::class, 'id_pertanyaan', 'id_pertanyaan');
    }
}
