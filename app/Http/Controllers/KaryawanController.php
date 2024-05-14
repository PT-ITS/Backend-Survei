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

    public function listKaryawanInTempatKerja()
    {

    }

    public function inputDataKaryawan(Request $request)
    {
        $validateData = $request->validate([
            'namaKaryawan' => 'required',
            'nikKaryawan' => 'required',
            'pendidikanKaryawan' => 'required',
            'jabatanKaryawan' => 'required',
            'alamatKaryawan' => 'required',
            'wargaNegara' => 'required',
            'surveyor_id' => 'required',
            'jenisKelamin' => 'required',
        ]);

        $result = $this->karyawanService->inputDataKaryawan($validateData);
        return response()->json([
            'message' => $result['message']
        ], $result['statusCode']
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
            'wargaNegara' => 'required',
            'surveyor_id' => 'required',
            'jenisKelamin' => 'required',
        ]);

        $result = $this->karyawanService->updateDataKaryawan($validateData, $id);
        return response()->json([
            'message' => $result['message']
        ], $result['statusCode']
        );
    }

    public function deleteDataKaryawan($id)
    {
        $result = $this->karyawanService->deleteDataKaryawan($id);
        return response()->json([
            'message' => $result['message']
        ], $result['statusCode']
        );
    }
}
