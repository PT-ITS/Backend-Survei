<?php

namespace App\Http\Repositories;

use App\Models\Fnb;
use Illuminate\Support\Facades\DB;

class FnbRepository
{
    private $fnbModel;

    public function __construct(Fnb $fnbModel)
    {
        $this->fnbModel = $fnbModel;
    }

    public function listFnb()
    {
        try {
            $dataFnb = $this->fnbModel->get();
            return [
                "statusCode" => 200,
                "data" => $dataFnb,
                "message" => 'get data fnb success'
            ];
        } catch (\Exception  $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function detailFnb($id)
    {
        try {
            $dataFnb = $this->fnbModel->find($id);
            return [
                "statusCode" => 200,
                "data" => $dataFnb,
                "message" => 'get detail data fnb success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function createFnb($requestData)
    {
        try {

            $this->fnbModel->create($requestData);
            return [
                "statusCode" => 201,
                "message" => 'input data fnb success'
            ];
        } catch (\Exception  $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function updateFnb($requestData, $id)
    {
        try {
            $fnb = $this->fnbModel->find($id);
            if ($fnb) {
                $fnb->update($requestData);
                return [
                    "statusCode" => 200,
                    "message" => 'update data fnb success'
                ];
            }
            return [
                "statusCode" => 404,
                "message" => 'data fnb tidak ditemukan'
            ];
        } catch (\Exception  $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function deleteFnb($id)
    {
        try {
            $fnb = $this->fnbModel->find($id);
            if ($fnb) {
                $fnb->delete();
                return [
                    "statusCode" => 200,
                    "message" => 'delete data fnb success'
                ];
            }
            return [
                "statusCode" => 404,
                "message" => 'data fnb tidak ditemukan'
            ];
        } catch (\Exception  $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }
}
