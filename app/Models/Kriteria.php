<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';
    protected $primaryKey = 'token_kriteria';
    protected $keyType = 'string';
    protected $guarded = ['id_kriteria'];

    public function getRouteKeyName()
    {
        return 'token_kriteria';
    }
}
