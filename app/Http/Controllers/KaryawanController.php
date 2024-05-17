<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\KaryawanService;

class KaryawanController extends Controller
{
    private $karyawanService;

    public function __construct(KaryawanService $karyawanService)
    {
        $this->karyawanService = $karyawanService;
    }

    public function listKaryawanHotel($id)
    {
        $result = $this->karyawanService->listKaryawanHotel($id);
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function listKaryawanHiburan($id)
    {
        $result = $this->karyawanService->listKaryawanHiburan($id);
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function listKaryawanFnb($id)
    {
        $result = $this->karyawanService->listKaryawanFnb($id);
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function inputDataKaryawan(Request $request)
    {
        $validateData = $request->validate([
            'namaKaryawan' => 'required',
            'nikKaryawan' => 'required',
            'pendidikanKaryawan' => 'required',
            'jabatanKaryawan' => 'required',
            'alamatKaryawan' => 'required',
            'sertifikasiKaryawan' => 'required',
            'wargaNegara' => 'required',
            'surveyor_id' => 'required',
            'jenisKelamin' => 'required',
        ]);

        $result = $this->karyawanService->inputDataKaryawan($validateData);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }

    public function updateDataKaryawan(Request $request, $id)
    {
        $validateData = $request->validate([
            'namaKaryawan' => 'required',
            'nikKaryawan' => 'required',
            'pendidikanKaryawan' => 'required',
            'jabatanKaryawan' => 'required',
            'alamatKaryawan' => 'required',
            'sertifikasiKaryawan' => 'required',
            'wargaNegara' => 'required',
            'surveyor_id' => 'required',
            'jenisKelamin' => 'required',
        ]);

        $result = $this->karyawanService->updateDataKaryawan($validateData, $id);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }

    public function deleteDataKaryawan($id)
    {
        $result = $this->karyawanService->deleteDataKaryawan($id);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }
}
