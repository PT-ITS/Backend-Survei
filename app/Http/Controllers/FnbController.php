<?php

namespace App\Http\Controllers;

use App\Models\FnB;
use Illuminate\Http\Request;
use App\Services\FnbService;
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

    public function createFnb(Request $request)
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
            'idSurveyor' => 'required',
        ]);

        $result = $this->fnbService->createFnb($validateData);
        return response()->json(
            [
                'message' => $result['message']
            ],
            $result['statusCode']
        );
    }

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
            'idSurveyor' => 'required',
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
