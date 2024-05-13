<?php

use App\Http\Controllers\HiburanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Hiburan
Route::get('list-hiburan', [HiburanController::class, 'listHiburan']);
Route::get('detail-hiburan/{id}', [HiburanController::class, 'detailHiburan']);
Route::post('create-hiburan', [HiburanController::class, 'createHiburan']);
Route::post('update-hiburan/{id}', [HiburanController::class, 'updateHiburan']);
Route::delete('delete-hiburan/{id}', [HiburanController::class, 'deleteHiburan']);
