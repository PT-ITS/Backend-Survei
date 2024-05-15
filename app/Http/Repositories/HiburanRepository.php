<?php

namespace App\Http\Repositories;

use App\Models\Hiburan;
use Illuminate\Support\Facades\DB;

class HiburanRepository
{
    private $hiburanModel;

    public function __construct(Hiburan $hiburanModel)
    {
        $this->hiburanModel = $hiburanModel;
    }

    public function listHiburan()
    {
        try {
            $dataHiburan = $this->hiburanModel->get();
            return [
                "statusCode" => 200,
                "data" => $dataHiburan,
                "message" => 'get data hiburan success'
            ];
        } catch (\Exception  $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function detailHiburan($id)
    {
        try {
            $dataHiburan = $this->hiburanModel->find($id);
            return [
                "statusCode" => 200,
                "data" => $dataHiburan,
                "message" => 'get detail data hiburan success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function createHiburan($requestData)
    {
        try {

            $this->hiburanModel->create($requestData);
            return [
                "statusCode" => 201,
                "message" => 'input data hiburan success'
            ];
        } catch (\Exception  $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function updateHiburan($requestData, $id)
    {
        try {
            $hiburan = $this->hiburanModel->find($id);
            if ($hiburan) {
                $hiburan->update($requestData);
                return [
                    "statusCode" => 200,
                    "message" => 'update data hiburan success'
                ];
            }
            return [
                "statusCode" => 404,
                "message" => 'data hiburan tidak ditemukan'
            ];
        } catch (\Exception  $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function deleteHiburan($id)
    {
        try {
            $hiburan = $this->hiburanModel->find($id);
            if ($hiburan) {
                $hiburan->delete();
                return [
                    "statusCode" => 200,
                    "message" => 'delete data hiburan success'
                ];
            }
            return [
                "statusCode" => 404,
                "message" => 'data hiburan tidak ditemukan'
            ];
        } catch (\Exception  $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }
}
