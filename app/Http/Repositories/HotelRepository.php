<?php

namespace App\Http\Repositories;

use App\Models\Hotel;
use App\Models\Karyawan;

class HotelRepository
{
    private $hotelModel;

    public function __construct(Hotel $hotelModel)
    {
        $this->hotelModel = $hotelModel;
    }

    public function listDataHotel()
    {
        try {
            $dataHotel = $this->hotelModel->get();
            return [
                "statusCode" => 200,
                "data" => $dataHotel,
                "message" => 'get data hotel success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function detailDataHotel($id)
    {
        try {
            $dataHotel = $this->hotelModel->find($id);

            if (!$dataHotel) {
                throw new \Exception('hotel data not found');
            }

            $dataKaryawan = Karyawan::join('karyawan_hotels', 'karyawans.id', '=', 'karyawan_hotels.karyawan_id')
                ->select('karyawans.*', 'karyawan_hotels.karyawan_id', 'karyawan_hotels.hotel_id')
                ->where('karyawan_hotels.hotel_id', $id)
                ->get();

            return [
                "statusCode" => 200,
                "data" => [
                    "hotel" => $dataHotel,
                    "karyawan" => $dataKaryawan
                ],
                "message" => 'get detail data hotel and karyawan hotel success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "data" => [],
                "message" => $e->getMessage()
            ];
        }
    }

    public function inputDataHotel($dataRequest)
    {
        try {
            $result = $this->hotelModel->insert($dataRequest);
            return [
                "statusCode" => 201,
                "message" => 'input data hotel success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function updateDataHotel($dataRequest, $id)
    {
        try {
            $dataHotel = $this->hotelModel->find($id);
            $dataHotel->namaHotel = $dataRequest['namaHotel'];
            $dataHotel->bintangHotel = $dataRequest['bintangHotel'];
            $dataHotel->kamarVip = $dataRequest['kamarVip'];
            $dataHotel->kamarStandart = $dataRequest['kamarStandart'];
            $dataHotel->alamat = $dataRequest['alamat'];
            $dataHotel->koordinat = $dataRequest['koordinat'];
            $dataHotel->namaPj = $dataRequest['namaPj'];
            $dataHotel->nikPj = $dataRequest['nikPj'];
            $dataHotel->pendidikanPj = $dataRequest['pendidikanPj'];
            $dataHotel->teleponPj = $dataRequest['teleponPj'];
            $dataHotel->wargaNegaraPj = $dataRequest['wargaNegaraPj'];
            $dataHotel->surveyor_id = $dataRequest['surveyor_id'];
            $dataHotel->save();

            return [
                "statusCode" => 200,
                "message" => 'update data hotel success'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }

    public function deleteDataHotel($id)
    {
        try {
            $result = $this->hotelModel->find($id);
            if ($result) {
                $result->delete();
                return [
                    "statusCode" => 200,
                    "message" => 'delete data hotel success'
                ];
            }
            return [
                "statusCode" => 404,
                "message" => 'data hotel tidak ditemukan'
            ];
        } catch (\Exception $e) {
            return [
                "statusCode" => 401,
                "message" => $e->getMessage()
            ];
        }
    }
}
