<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\DataImportHotel;
use App\Models\Hotel;
use App\Models\Karyawan;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ImportDataController extends Controller
{
    public function importDataHotel(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
    
        try {
            // Simpan data yang akan diimpor
            $importedData = Excel::toArray(new DataImportHotel, $request->file('file'))[0];
    
            // Inisialisasi variabel hitungan
            $successDataCount = 0;
            $failDataCount = 0;
            $failedRows = [];
            $errors = [];
    
            foreach ($importedData as $index => $data) {
                try {
                    // Validasi dan konversi format tanggal
                    $created_at = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data['created_at']))->format('Y-m-d');

                    // Lakukan validasi atau manipulasi data sesuai kebutuhan
                    $hotel = new Hotel([
                        'nib'           => $data['nib'],
                        'namaHotel'     => $data['namahotel'],
                        'bintangHotel'  => $data['bintanghotel'],
                        'kamarVip'      => $data['kamarvip'],
                        'kamarStandart' => $data['kamarstandart'],
                        'resiko'        => $data['resiko'],
                        'skalaUsaha'    => $data['skalausaha'],
                        'alamat'        => $data['alamat'],
                        'koordinat'     => $data['koordinat'],
                        'namaPj'        => $data['namapj'],
                        'nikPj'         => $data['nikpj'],
                        'pendidikanPj'  => $data['pendidikanpj'],
                        'teleponPj'     => $data['teleponpj'],
                        'wargaNegaraPj' => $data['warganegarapj'],
                        'surveyor_id'   => $data['surveyor_id'],
                        'created_at'    => $created_at,
                    ]);
                    $karyawan = new Karyawan([
                        'namaKaryawan'        => $data['namakaryawan'],
                        'nikKaryawan'         => $data['nikkaryawan'],
                        'pendidikanKaryawan'  => $data['pendidikankaryawan'],
                        'jabatanKaryawan'     => $data['jabatankaryawan'],
                        'alamatKaryawan'      => $data['alamatkaryawan'],
                        'sertifikasiKaryawan' => $data['sertifikasikaryawan'],
                        'wargaNegara'         => $data['warganegara'],
                        'surveyor_id'         => $data['surveyor_id'],
                        'created_at'          => $created_at,
                    ]);
    
                    // Coba simpan hotel ke database
                    if ($hotel->save() && $karyawan->save()) {
                        // Jika berhasil, tambahkan ke hitungan data yang berhasil
                        $successDataCount++;
                    } else {
                        // Jika gagal disimpan ke database, tambahkan ke hitungan data yang gagal
                        $failDataCount++;
                        $failedRows[] = $index + 1; // Catat baris yang gagal
                        $errors[] = "Gagal menyimpan data di baris " . ($index + 1);
                    }
                } catch (\Exception $e) {
                    // Jika ada kesalahan saat menyimpan data, tambahkan ke hitungan data yang gagal
                    $failDataCount++;
                    $failedRows[] = $index + 1; // Catat baris yang gagal
                    $errors[] = "Kesalahan di baris " . ($index + 1) . ": " . $e->getMessage();
                }
            }
    
            return response()->json([
                'message' => 'Data berhasil diimpor.',
                'success_data_count' => $successDataCount,
                'fail_data_count' => $failDataCount,
                'failed_rows' => $failedRows,
                'errors' => $errors,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengimpor data.', 'error' => $e->getMessage()], 500);
        }
    }
}
