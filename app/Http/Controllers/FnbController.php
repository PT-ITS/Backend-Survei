<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\FnbService;
use App\Models\Fnb;
use App\Models\Karyawan;
use App\Models\KaryawanFnb;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FnbController extends Controller
{
    private $fnbService;

    public function __construct(FnbService $fnbService)
    {
        $this->fnbService = $fnbService;
    }

    public function listFnb()
    {
        $result = $this->fnbService->listFnb();

        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function detailFnb($id)
    {
        $result = $this->fnbService->detailFnb($id);
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function inputFnbAndKaryawan(Request $request)
    {
        try {
            // Validasi data fnb
            $validateFnbData = $request->validate([
                'fnb.nib' => 'required',
                'fnb.namaFnb' => 'required',
                'fnb.resiko' => 'required',
                'fnb.skalaUsaha' => 'required',
                'fnb.alamat' => 'required',
                'fnb.koordinat' => 'required',
                'fnb.namaPj' => 'required',
                'fnb.nikPj' => 'required',
                'fnb.pendidikanPj' => 'required',
                'fnb.teleponPj' => 'required',
                'fnb.wargaNegaraPj' => 'required',
            ]);

            // Validasi data karyawan
            $validateKaryawanData = $request->validate([
                'karyawan.*.namaKaryawan' => 'required',
                'karyawan.*.nikKaryawan' => 'required',
                'karyawan.*.pendidikanKaryawan' => 'required',
                'karyawan.*.jabatanKaryawan' => 'required',
                'karyawan.*.alamatKaryawan' => 'required',
                'karyawan.*.wargaNegara' => 'required',
                'karyawan.*.jenisKelamin' => 'required',
            ]);

            DB::beginTransaction();

            try {
                // Simpan data fnb
                $fnb = new Fnb();
                $fnb->fill($request->fnb);
                $fnb->surveyor_id = auth()->user()->id;
                $fnb->save();

                // Simpan data karyawan
                foreach ($request->karyawan as $karyawanData) {
                    $karyawan = new Karyawan();
                    $karyawan->fill($karyawanData);
                    $karyawan->surveyor_id = auth()->user()->id;
                    $karyawan->save();

                    $karyawanFnb = new KaryawanFnb();
                    $karyawanFnb->karyawan_id = $karyawan->id;
                    $karyawanFnb->fnb_id = $fnb->id;
                    $karyawanFnb->save();
                }

                DB::commit();
                return response()->json(['message' => 'Data fnb dan karyawan berhasil disimpan'], 201);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data', 'error' => $e->getMessage()], 500);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        }
    }


    // public function createFnb(Request $request)
    // {
    //     $validateData = $request->validate([
    //         'namaFnb' => 'required',
    //         'alamat' => 'required',
    //         'koordinat' => 'required',
    //         'namaPj' => 'required',
    //         'nikPj' => 'required',
    //         'pendidikanPj' => 'required',
    //         'teleponPj' => 'required',
    //         'wargaNegaraPj' => 'required',
    //         'surveyor_id' => 'required',
    //     ]);

    //     $result = $this->fnbService->createFnb($validateData);
    //     return response()->json(
    //         [
    //             'message' => $result['message']
    //         ],
    //         $result['statusCode']
    //     );
    // }

    public function updateFnb(Request $request, $id)
    {
        $validateData = $request->validate([
            'namaFnb' => 'required',
            'alamat' => 'required',
            'koordinat' => 'required',
            'namaPj' => 'required',
            'nikPj' => 'required',
            'pendidikanPj' => 'required',
            'teleponPj' => 'required',
            'wargaNegaraPj' => 'required',
            'surveyor_id' => 'required',
        ]);

        $result = $this->fnbService->updateFnb($validateData, $id);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }

    public function deleteFnb($id)
    {
        $result = $this->fnbService->deleteFnb($id);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }
}
