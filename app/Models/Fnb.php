<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FnB extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaFnb',
        'alamat',
        'koordinat',
        'namaPj',
        'nikPj',
        'pendidikanPj',
        'teleponPj',
        'wargaNegaraPj',
        'idSurveyor',
    ];
}
