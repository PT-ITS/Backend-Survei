<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\HotelService;
use App\Models\Hotel;

class HotelController extends Controller
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function listDataHotel()
    {
        $result = $this->hotelService->listDataHotel();
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'] 
        ], $result['statusCode']
        );
    }

    public function detailDataHotel($id)
    {
        $result = $this->hotelService->detailDataHotel($id);
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'] 
        ], $result['statusCode']
        );
    }

    public function inputDataHotel(Request $request)
    {
        $validateData = $request->validate([
            'namaHotel' => 'required',
            'bintangHotel' => 'required',
            'kamarVip' => 'required',
            'kamarStandart' => 'required',
            'alamat' => 'required',
            'koordinat' => 'required',
            'namaPj' => 'required',
            'nikPj' => 'required',
            'pendidikanPj' => 'required',
            'teleponPj' => 'required',
            'wargaNegaraPj' => 'required',
            'surveyor_id' => 'required',
        ]);

        $result = $this->hotelService->inputDataHotel($validateData);
        return response()->json([
            'message' => $result['message']
        ], $result['statusCode']
        );
    }

    public function updateDataHotel(Request $request, $id)
    {
        $validateData = $request->validate([
            'namaHotel' => 'required',
            'bintangHotel' => 'required',
            'kamarVip' => 'required',
            'kamarStandart' => 'required',
            'alamat' => 'required',
            'koordinat' => 'required',
            'namaPj' => 'required',
            'nikPj' => 'required',
            'pendidikanPj' => 'required',
            'teleponPj' => 'required',
            'wargaNegaraPj' => 'required',
            'surveyor_id' => 'required',
        ]);

        $result = $this->hotelService->updateDataHotel($validateData, $id);
        return response()->json([
            'message' => $result['message']
        ], $result['statusCode']
        );
    }

    public function deleteDataHotel($id)
    {
        $result = $this->hotelService->deleteDataHotel($id);
        return response()->json([
            'message' => $result['message']
        ], $result['statusCode']
        );
    }

    public function testId($id)
    {
        // $id_encode = base64_encode($id . "public123");
        $id_decode = base64_decode($id);
        $id_result = str_replace("public123", "", $id_decode);

        echo "id:" . $id . "<br>";
        // echo "encode:" . $id_encode . "<br>";
        echo "hasil:" . $id_result . "<br>";
    }

}
