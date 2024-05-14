<?php

namespace App\Http\Repositories;

use App\Models\Karyawan;
use App\Models\Hotel;
use App\Models\Hiburan;
use App\Models\Fnb;

class DashboardRepository
{
    public function getDataDashboard()
    {
        try {
            // Menghitung jumlah karyawan pria dan wanita
            $dataKaryawanPria = Karyawan::where('jenisKelamin', '1')->count();
            $dataKaryawanWanita = Karyawan::where('jenisKelamin', '0')->count();

            // Menghitung jumlah data hotel, hiburan, dan F&B
            $dataHotel = Hotel::count();
            $dataHiburan = Hiburan::count();
            $dataFnb = Fnb::count();

            // Membuat array data dashboard
            $dataDashboard = [
                "jumlahKaryawanPria" => $dataKaryawanPria,
                "jumlahKaryawanWanita" => $dataKaryawanWanita,
                "jumlahHotel" => $dataHotel,
                "jumlahHiburan" => $dataHiburan,
                "jumlahFnb" => $dataFnb,
            ];

            // Mengembalikan response sukses
            return [
                "statusCode" => 200,
                "data" => $dataDashboard,
                "message" => 'Get data dashboard success'
            ];
        } catch (\Exception $e) {
            // Mengembalikan response error
            return [
                "statusCode" => 500, // Menggunakan 500 untuk server error
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }
}
