<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\DashboardService;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function getDataDashboard()
    {
        $result = $this->hotelService->listDataHotel();
        return response()->json([
            'message' => $result['message'],
            'data' => $result['data'] 
        ], $result['statusCode']
        );
    }
}
