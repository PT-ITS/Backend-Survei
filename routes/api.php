<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\KaryawanController;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('import', [AuthController::class, 'import']);
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
        
        
        Route::group([
            'middleware' => 'auth:api'
        ], function () {
            // api secure
            
        });
    });
});

Route::group([
    'prefix' => 'hotel'
], function () {
    // Route::group([
    //     'middleware' => 'auth:api'
    // ], function () {
    // });
    Route::get('list-hotel', [HotelController::class, 'listDataHotel']);
    Route::get('detail-hotel/{id}', [HotelController::class, 'detailDataHotel']);
    Route::post('input-hotel', [HotelController::class, 'inputDataHotelAndKaryawan']);
    Route::post('update-hotel/{id}', [HotelController::class, 'updateDataHotel']);
    Route::delete('delete-hotel/{id}', [HotelController::class, 'deleteDataHotel']);
});

Route::group([
    'prefix' => 'karyawan'
], function () {
    // Route::group([
    //     'middleware' => 'auth:api'
    // ], function () {
    // });
    Route::get('list-karyawan', [KaryawanController::class, 'listKaryawanInTempatKerja']);
    Route::post('input-karyawan', [KaryawanController::class, 'inputDataKaryawan']);
    Route::post('update-karyawan/{id}', [KaryawanController::class, 'updateDataKaryawan']);
    Route::delete('delete-karyawan/{id}', [KaryawanController::class, 'deleteDataKaryawan']);
});

