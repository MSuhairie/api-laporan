<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\LaporanController;
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

Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/laporan/{id}', [LaporanController::class, 'detail']);

Route::post('/login', [AuthenticateController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticateController::class, 'logout']);
    Route::get('/me', [AuthenticateController::class, 'me']);
    Route::post('/laporan', [LaporanController::class, 'tambah']);
    Route::patch('/laporan/{id}', [LaporanController::class, 'edit']);
    Route::delete('/laporan/{id}', [LaporanController::class, 'hapus'])->middleware('admin');
});
