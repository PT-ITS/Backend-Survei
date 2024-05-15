<?php

namespace App\Http\Repositories;

use App\Models\Karyawan;

class KaryawanRepository
{
    private $karyawanModel;

    public function __construct(Karyawan $karyawanModel)
    {
        $this->karyawanModel = $karyawanModel;
    }

    public function listKaryawanInTempatKerja()
    {}

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
            $dataKaryawan->nikKaryawan = $dataRequest['nikKaryawan'];
            $dataKaryawan->pendidikanKaryawan = $dataRequest['pendidikanKaryawan'];
            $dataKaryawan->jabatanKaryawan = $dataRequest['jabatanKaryawan'];
            $dataKaryawan->alamatKaryawan = $dataRequest['alamatKaryawan'];
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