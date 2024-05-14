<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HiburanService;
use Illuminate\Support\Facades\Storage;

class HiburanController extends Controller
{
    private $hiburanService;

    public function __construct(HiburanService $hiburanService)
    {
        $this->hiburanService = $hiburanService;
    }

    public function listHiburan()
    {
        $result = $this->hiburanService->listHiburan();

        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function detailHiburan($id)
    {
        $result = $this->hiburanService->detailHiburan($id);
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function createHiburan(Request $request)
    {
        $validateData = $request->validate([
            'namaHiburan' => 'required',
            'alamat' => 'required',
            'koordinat' => 'required',
            'namaPj' => 'required',
            'nikPj' => 'required',
            'pendidikanPj' => 'required',
            'teleponPj' => 'required',
            'wargaNegaraPj' => 'required',
            'idSurveyor' => 'required',
        ]);

        $result = $this->hiburanService->createHiburan($validateData);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }

    public function updateHiburan(Request $request, $id)
    {
        $validateData = $request->validate([
            'namaHiburan' => 'required',
            'alamat' => 'required',
            'koordinat' => 'required',
            'namaPj' => 'required',
            'nikPj' => 'required',
            'pendidikanPj' => 'required',
            'teleponPj' => 'required',
            'wargaNegaraPj' => 'required',
            'idSurveyor' => 'required',
        ]);

        $result = $this->hiburanService->updateHiburan($validateData, $id);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }

    public function deleteHiburan($id)
    {
        $result = $this->hiburanService->deleteHiburan($id);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }
}
