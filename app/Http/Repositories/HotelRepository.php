<?php

namespace App\Http\Repositories;

use App\Models\Hotel;

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
            $dataHotel = Hotel::get();
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
            $dataHotel = Hotel::find($id);
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

    public function inputDataHotel(Request $request)
    {}

    public function updateDataHotel(Request $request)
    {}

    public function deleteDataHotel(Request $request)
    {}
}