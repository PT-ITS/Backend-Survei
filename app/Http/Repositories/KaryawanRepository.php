<?php

namespace App\Http\Repositories;

use App\Models\Karyawan;
use App\Models\KaryawanHotel;
use App\Models\KaryawanHiburan;
use App\Models\KaryawanFnb;

class KaryawanRepository
{
    private $karyawanModel;

    public function __construct(Karyawan $karyawanModel, KaryawanHotel $karyawanHotelModel, KaryawanHiburan $karyawanHiburanModel, KaryawanFnb $karyawanFnbModel)
    {
        $this->karyawanModel = $karyawanModel;
        $this->karyawanHotelModel = $karyawanHotelModel;
        $this->karyawanHiburanModel = $karyawanHiburanModel;
        $this->karyawanFnbModel = $karyawanFnbModel;
    }

    public function listKaryawanHotel($id)
    {
        try {
            $dataKaryawan = $this->karyawanModel
                ->join('karyawan_hotels', 'karyawans.id', '=', 'karyawan_hotels.karyawan_id')
                ->select('karyawans.*', 'karyawan_hotels.karyawan_id', 'karyawan_hotels.hotel_id')
                ->where('karyawan_hotels.hotel_id', $id)
                ->get();
            return [
                "statusCode" => 200,
                "data" => $dataKaryawan,
                "message" => 'get data karyawan hotel success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function listKaryawanHiburan($id)
    {
        try {
            $dataKaryawan = $this->karyawanModel
                ->join('karyawan_hiburans', 'karyawans.id', '=', 'karyawan_hiburans.karyawan_id')
                ->select('karyawans.*', 'karyawan_hiburans.karyawan_id', 'karyawan_hiburans.hiburan_id')
                ->where('karyawan_hiburans.hiburan_id', $id)
                ->get();
            return [
                "statusCode" => 200,
                "data" => $dataKaryawan,
                "message" => 'get data karyawan hiburan success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function listKaryawanFnb($id)
    {
        try {
            $dataKaryawan = $this->karyawanModel
                ->join('karyawan_fnbs', 'karyawans.id', '=', 'karyawan_fnbs.karyawan_id')
                ->select('karyawans.*', 'karyawan_fnbs.karyawan_id', 'karyawan_fnbs.fnb_id')
                ->where('karyawan_fnbs.fnb_id', $id)
                ->get();
            return [
                "statusCode" => 200,
                "data" => $dataKaryawan,
                "message" => 'get data karyawan fnb success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function inputDataKaryawan($dataRequest)
    {
        try {
            $result = $this->karyawanModel->insert($dataRequest);
            return [
                "statusCode" => 201,
                "message" => 'input data karyawan success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function updateDataKaryawan($dataRequest, $id)
    {
        try {
            $dataKaryawan = $this->karyawanModel->find($id);
            $dataKaryawan->namaKaryawan = $dataRequest['namaKaryawan'];
            // $dataKaryawan->nikKaryawan = $dataRequest['nikKaryawan'];
            $dataKaryawan->pendidikanKaryawan = $dataRequest['pendidikanKaryawan'];
            $dataKaryawan->jabatanKaryawan = $dataRequest['jabatanKaryawan'];
            $dataKaryawan->alamatKaryawan = $dataRequest['alamatKaryawan'];
            $dataKaryawan->sertifikasiKaryawan = $dataRequest['sertifikasiKaryawan'];
            $dataKaryawan->wargaNegara = $dataRequest['wargaNegara'];
            $dataKaryawan->surveyor_id = $dataRequest['surveyor_id'];
            $dataKaryawan->jenisKelamin = $dataRequest['jenisKelamin'];
            $dataKaryawan->save();

            return [
                "statusCode" => 200,
                "message" => 'update data karyawan success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function deleteDataKaryawan($id)
    {
        try {
            $result = $this->karyawanModel->find($id);
            if ($result) {
                $result->delete();
                return [
                    "statusCode" => 200,
                    "message" => 'delete data karyawan success'
                ];
            }
            return [
                "statusCode" => 404,
                "message" => 'data karyawan tidak ditemukan'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }
}
