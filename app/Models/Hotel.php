<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaHotel',
        'bintangHotel',
        'kamarVip',
        'kamarStandart',
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
