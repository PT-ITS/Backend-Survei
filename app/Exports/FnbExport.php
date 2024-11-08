<?php

namespace App\Exports;

use App\Models\Fnb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;

class FnbExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return Fnb::whereDate('created_at', $this->date)->get([
            'nib',
            'namaFnb',
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
            'Nama Fnb',
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
