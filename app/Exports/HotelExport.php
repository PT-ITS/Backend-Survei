<?php

namespace App\Exports;

use App\Models\Hotel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;

class HotelExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return Hotel::whereDate('created_at', $this->date)->get([
            'nib',
            'namaHotel',
            'bintangHotel',
            'kamarVip',
            'kamarStandart',
            'resiko',
            'skalaUsaha',
            'alamat',
            'koordinat',
            'namaPj',
            'emailPj',
            'passwordPj',
            'nikPj',
            'pendidikanPj',
            'teleponPj',
            'wargaNegaraPj',
            'status',
            'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'NIB',
            'Nama Hotel',
            'Bintang Hotel',
            'Kamar Vip',
            'Kamar Standart',
            'Resiko',
            'Skala Usaha',
            'Alamat',
            'Koordinat',
            'Nama Pj',
            'Email Pj',
            'Password Pj',
            'NIK Pj',
            'Pendidikan Pj',
            'Telepon Pj',
            'Warga Negara Pj',
            'Status',
            'Created At'
        ];
    }
}
