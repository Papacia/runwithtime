<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('simpan-registrasi',[UserController::class,'registrasi']);
Route::post('login',[UserController::class,'login'])->name('login');
Route::get('login',[UserController::class,'LogOut']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('simpan-kegiatan',[KegiatanController::class,'simpanKegiatan']);
    Route::get('show-kegiatan',[KegiatanController::class,'index']);
    Route::delete('hapus-kegiatan/{id}',[KegiatanController::class,'hapus']);

    Route::put('ubah-kegiatan/{id}',[KegiatanController::class,'ubah']);
});