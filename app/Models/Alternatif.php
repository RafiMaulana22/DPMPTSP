<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatifs';
    protected $primaryKey = 'token_alternatif';
    protected $keyType = 'string';
    protected $guarded = ['id_alternatif'];

    public function getRouteKeyName()
    {
        return 'token_alternatif';
    }
}
