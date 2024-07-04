<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HotelService;
use App\Models\Hotel;
use App\Models\Karyawan;
use App\Models\KaryawanHotel;
use Illuminate\Support\Facades\DB;

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
        try {
            // Validasi data hotel
            $validateHotelData = $request->validate([
                'hotel.nib' => 'required',
                'hotel.namaHotel' => 'required',
                'hotel.bintangHotel' => 'required',
                'hotel.kamarVip' => 'required',
                'hotel.kamarStandart' => 'required',
                'hotel.resiko' => 'required',
                'hotel.skalaUsaha' => 'required',
                'hotel.alamat' => 'required',
                'hotel.koordinat' => 'required',
                'hotel.namaPj' => 'required',
                'hotel.nikPj' => 'required',
                'hotel.pendidikanPj' => 'required',
                'hotel.teleponPj' => 'required',
                'hotel.wargaNegaraPj' => 'required',
            ]);

            // Validasi data karyawan
            $validateKaryawanData = $request->validate([
                'karyawan.*.namaKaryawan' => 'required',
                // 'karyawan.*.nikKaryawan' => 'required',
                'karyawan.*.pendidikanKaryawan' => 'required',
                'karyawan.*.jabatanKaryawan' => 'required',
                'karyawan.*.alamatKaryawan' => 'required',
                'karyawan.*.wargaNegara' => 'required',
                'karyawan.*.jenisKelamin' => 'required',
            ]);

            DB::beginTransaction();

            try {
                // Simpan data hotel
                $hotel = new Hotel();
                $hotel->fill($request->hotel);
                $hotel->surveyor_id = auth()->user()->id; // Set surveyor_id here
                $hotel->save();

                // Simpan data karyawan
                foreach ($request->karyawan as $karyawanData) {
                    $karyawan = new Karyawan();
                    $karyawan->fill($karyawanData);
                    $karyawan->surveyor_id = auth()->user()->id;
                    $karyawan->save();

                    $karyawanHotel = new KaryawanHotel();
                    $karyawanHotel->karyawan_id = $karyawan->id;
                    $karyawanHotel->hotel_id = $hotel->id;
                    $karyawanHotel->save();
                }

                DB::commit();
                return response()->json(['message' => 'Data hotel dan karyawan berhasil disimpan'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data', 'error' => $e->getMessage()], 500);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        }
    }


    // $result = $this->hotelService->inputDataHotel($validateData);
    // return response()->json([
    //     'message' => $result['message']
    // ], $result['statusCode']
    // );

    public function updateDataHotel(Request $request, $id)
    {
        $validateData = $request->validate([
            'nib' => 'required',
            'namaHotel' => 'required',
            'resiko' => 'required',
            'skalaUsaha' => 'required',
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
