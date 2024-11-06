<?php

namespace App\Exports;

use App\Models\Hiburan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;

class HiburanExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return Hiburan::whereDate('created_at', $this->date)->get([
            'nib',
            'namaHiburan',
            'resiko',
            'skalaUsaha',
            'alamat',
            'koordinat',
            'namaPj',
            'emailPj',
            'teleponPj',
            'status',
            'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'NIB',
            'Nama Hiburan',
            'Resiko',
            'Skala Usaha',
            'Alamat',
            'Koordinat',
            'Nama Penanggung Jawab',
            'Email Penanggung Jawab',
            'Telepon Penanggung Jawab',
            'Status',
            'Created At',
        ];
    }
}
