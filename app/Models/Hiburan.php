<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hiburan extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaHiburan',
        'alamat',
        'koordinat',
        'namaPj',
        'nikPj',
        'pendidikanPj',
        'teleponPj',
        'wargaNegaraPj',
        'surveyor_id',
    ];
}
