<?php

use App\Http\Controllers\FnbController;
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

// Fnb
Route::get('list-fnb', [FnbController::class, 'listFnb']);
Route::get('detail-fnb/{id}', [FnbController::class, 'detailFnb']);
Route::post('create-fnb', [FnbController::class, 'createFnb']);
Route::post('update-fnb/{id}', [FnbController::class, 'updateFnb']);
Route::delete('delete-fnb/{id}', [FnbController::class, 'deleteFnb']);
