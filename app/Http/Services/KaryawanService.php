<?php

namespace App\Http\Services;

use App\Http\Repositories\KaryawanRepository;

class KaryawanService
{
    private $karyawanRepository;

    public function __construct(KaryawanRepository $karyawanRepository)
    {
        $this->karyawanRepository = $karyawanRepository;
    }

    public function listKaryawanInTempatKerja()
    {}

    public function inputDataKaryawan($dataRequest)
    {
        try {
            return $this->karyawanRepository->inputDataKaryawan($dataRequest);
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
            return $this->karyawanRepository->updateDataKaryawan($dataRequest, $id);
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
            return $this->karyawanRepository->deleteDataKaryawan($id);
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }
}