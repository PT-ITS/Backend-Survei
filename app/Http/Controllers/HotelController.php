<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HotelService;
use App\Models\Hotel;
use App\Models\Karyawan;

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
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function detailDataHotel($id)
    {
        $result = $this->hotelService->detailDataHotel($id);
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function inputDataHotelAndKaryawan(Request $request)
    {
        // Validasi data hotel
        $validateHotelData = $request->validate([
            'hotel.namaHotel' => 'required',
            'hotel.bintangHotel' => 'required',
            'hotel.kamarVip' => 'required',
            'hotel.kamarStandart' => 'required',
            'hotel.alamat' => 'required',
            'hotel.koordinat' => 'required',
            'hotel.namaPj' => 'required',
            'hotel.nikPj' => 'required',
            'hotel.pendidikanPj' => 'required',
            'hotel.teleponPj' => 'required',
            'hotel.wargaNegaraPj' => 'required',
            'hotel.surveyor_id' => 'required',
        ]);

        // Validasi data karyawan
        $validateKaryawanData = $request->validate([
            'karyawan.*.namaKaryawan' => 'required',
            'karyawan.*.nikKaryawan' => 'required',
            'karyawan.*.pendidikanKaryawan' => 'required',
            'karyawan.*.jabatanKaryawan' => 'required',
            'karyawan.*.alamatKaryawan' => 'required',
            'karyawan.*.wargaNegara' => 'required',
            'karyawan.*.surveyor_id' => 'required',
            'karyawan.*.jenisKelamin' => 'required',
        ]);

        // Simpan data hotel
        $hotel = new Hotel(); // Ganti dengan model Hotel yang sesuai
        $hotel->namaHotel = $request->hotel['namaHotel'];
        $hotel->bintangHotel = $request->hotel['bintangHotel'];
        $hotel->kamarVip = $request->hotel['kamarVip'];
        $hotel->kamarStandart = $request->hotel['kamarStandart'];
        $hotel->alamat = $request->hotel['alamat'];
        $hotel->koordinat = $request->hotel['koordinat'];
        $hotel->namaPj = $request->hotel['namaPj'];
        $hotel->nikPj = $request->hotel['nikPj'];
        $hotel->pendidikanPj = $request->hotel['pendidikanPj'];
        $hotel->teleponPj = $request->hotel['teleponPj'];
        $hotel->wargaNegaraPj = $request->hotel['wargaNegaraPj'];
        $hotel->surveyor_id = $request->hotel['surveyor_id'];
        $hotel->save();

        // Simpan data karyawan
        foreach ($request->karyawan as $karyawanData) {
            $karyawan = new Karyawan(); // Ganti dengan model Karyawan yang sesuai
            $karyawan->namaKaryawan = $karyawanData['namaKaryawan'];
            $karyawan->nikKaryawan = $karyawanData['nikKaryawan'];
            $karyawan->pendidikanKaryawan = $karyawanData['pendidikanKaryawan'];
            $karyawan->jabatanKaryawan = $karyawanData['jabatanKaryawan'];
            $karyawan->alamatKaryawan = $karyawanData['alamatKaryawan'];
            $karyawan->wargaNegara = $karyawanData['wargaNegara'];
            $karyawan->surveyor_id = $karyawanData['surveyor_id'];
            $karyawan->jenisKelamin = $karyawanData['jenisKelamin'];
            $karyawan->save();
        }

        return response()->json(['message' => 'Data hotel dan karyawan berhasil disimpan'], 201);
    }


    // $result = $this->hotelService->inputDataHotel($validateData);
    // return response()->json([
    //     'message' => $result['message']
    // ], $result['statusCode']
    // );
    public function karyawan($data, $idHotel)
    {
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
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }

    public function deleteDataHotel($id)
    {
        $result = $this->hotelService->deleteDataHotel($id);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
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
