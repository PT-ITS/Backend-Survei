<?php

namespace App\Exports;

use App\Models\Karyawan;
use App\Models\KaryawanHotel;
use App\Models\KaryawanHiburan;
use App\Models\KaryawanFnb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KaryawanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Karyawan::all(); // Fetch all Karyawan data
    }

    /**
     * Define the headings for the export file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID Karyawan',
            'Nama Karyawan',
            'Pendidikan Karyawan',
            'Jabatan Karyawan',
            'Alamat Karyawan',
            'Sertifikasi Karyawan',
            'Warga Negara',
            'Jenis Kelamin',
            'NIB'
        ];
    }

    /**
     * Map the Karyawan data for export
     *
     * @param  mixed  $karyawan
     * @return array
     */
    public function map($karyawan): array
    {
        // Check for KaryawanHotel NIB
        $hotel_nib = KaryawanHotel::where('karyawan_id', $karyawan->id)
            ->join('hotels', 'karyawan_hotels.hotel_id', '=', 'hotels.id')
            ->pluck('hotels.nib')->first();

        // Check for KaryawanHiburan NIB if no hotel NIB is found
        $hiburan_nib = $hotel_nib ?: KaryawanHiburan::where('karyawan_id', $karyawan->id)
            ->join('hiburans', 'karyawan_hiburans.hiburan_id', '=', 'hiburans.id')
            ->pluck('hiburans.nib')->first();

        // Check for KaryawanFnb NIB if no hiburan NIB is found
        $fnb_nib = $hiburan_nib ?: KaryawanFnb::where('karyawan_id', $karyawan->id)
            ->join('fn_b_s', 'karyawan_fnbs.fnb_id', '=', 'fn_b_s.id')
            ->pluck('fn_b_s.nib')->first();

        // Return the first found NIB (hotel > hiburan > fnb)
        $nib = $hotel_nib ?: $hiburan_nib ?: $fnb_nib;

        return [
            $karyawan->id,
            $karyawan->namaKaryawan,
            $karyawan->pendidikanKaryawan,
            $karyawan->jabatanKaryawan,
            $karyawan->alamatKaryawan,
            $karyawan->sertifikasiKaryawan,
            $karyawan->wargaNegara,
            $karyawan->jenisKelamin,
            $nib
        ];
    }
}
