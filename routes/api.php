<?php

use App\Http\Controllers\Api\TrackingPegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [TrackingPegawaiController::class, 'login']);
Route::get('/user/{id}', [TrackingPegawaiController::class, 'show']);
Route::get('/jamkerja', [TrackingPegawaiController::class, 'jadwal_kerja']);
Route::get('/updatepasword', [TrackingPegawaiController::class, 'update_pass_all']);
Route::post('/trackingpegawai', [TrackingPegawaiController::class, 'store']);

Route::get('/tracking/{id}', [TrackingPegawaiController::class, 'tracking']);
Route::get('/trackingall', [TrackingPegawaiController::class, 'trackingall']);
