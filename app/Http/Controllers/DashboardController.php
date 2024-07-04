<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\DashboardService;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function getDataDashboard()
    {
        $result = $this->dashboardService->getDataDashboard();
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }

    public function listAll()
    {
        // cek jika user login
        $user = auth()->user();

        if (!$user) {
            // return jika belum login
            return response()->json(
                [
                    'message' => 'Unauthorized',
                    'data' => []
                ],
                401
            );
        }

        // inisialisasi hasil
        $result = [];

        // cek level user
        if ($user->level == 1) { // jika admin
            $result = $this->dashboardService->listAll();
        } else { // jika surveyor
            // $result = $this->dashboardService->listAllBySurveyor();
            $result = $this->dashboardService->listAll();
        }

        // return hasil
        return response()->json(
            [
                'message' => $result['message'],
                'data' => $result['data']
            ],
            $result['statusCode']
        );
    }
}
