<?php

namespace App\Http\Services;

use App\Http\Repositories\HotelRepository;

class HotelService
{
    private $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function listDataHotel()
    {
        try {
            return $this->hotelRepository->listDataHotel();
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
            return $this->hotelRepository->detailDataHotel($id);
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