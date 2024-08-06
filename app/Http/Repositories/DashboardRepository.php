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

    public function listAll()
    {
        try {
            // nib, nama usaha, alamat, penanggung jawab, no hp
            $hotelData = Hotel::get();
            $hiburanData = Hiburan::get();
            $fnbData = Fnb::get();

            $allData = [
                "hotel" => $hotelData,
                "hiburan" => $hiburanData,
                "fnb" => $fnbData
            ];

            return [
                "statusCode" => 200,
                "data" => $allData,
                "message" => 'get semua data success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function listAllBySurveyor()
    {
        try {
            $hotelData = Hotel::where('surveyor_id', auth()->user()->id)->get();
            $hiburanData = Hiburan::where('surveyor_id', auth()->user()->id)->get();
            $fnbData = Fnb::where('surveyor_id', auth()->user()->id)->get();

            $allData = [
                "hotel" => $hotelData,
                "hiburan" => $hiburanData,
                "fnb" => $fnbData
            ];

            return [
                "statusCode" => 200,
                "data" => $allData,
                "message" => 'get data berdasarkan surveyor success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function listAllByPengelola()
    {
        try {
            $hotelData = Hotel::where('pj_id', auth()->user()->id)->get();
            $hiburanData = Hiburan::where('pj_id', auth()->user()->id)->get();
            $fnbData = Fnb::where('pj_id', auth()->user()->id)->get();

            $allData = [
                "hotel" => $hotelData,
                "hiburan" => $hiburanData,
                "fnb" => $fnbData
            ];

            return [
                "statusCode" => 200,
                "data" => $allData,
                "message" => 'get data berdasarkan surveyor success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }
}
