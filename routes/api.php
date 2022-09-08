<?php

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

//user
Route::post('/register', [App\Http\Controllers\Api\UserController::class, 'register']);

//KepalaPDE
Route::prefix('pde')->group(function(){
    //route login
    Route::post('/login', [App\Http\Controllers\Api\KPDE\LoginController::class, 'index', ['as' => 'pde']]);

    //route with midleware
    Route::group(['middleware' => 'auth:api'], function(){
        //get data user PDE
        Route::get('/user', [App\Http\Controllers\Api\KPDE\LoginController::class, 'getUser', ['as' => 'pde']]);
        //data belum terverifikasi
        Route::get('/karyawan-inver', [App\Http\Controllers\Api\KPDE\KaryawanController::class, 'inverif', ['as' => 'pde']]);
        //Verifikasi data user
        Route::post('/verifikasi-user/{id}', [App\Http\Controllers\Api\KPDE\KaryawanController::class, 'verifikasiKaryawan', ['as' => 'pde']]);
        //list data karyawan terverifikasi
        Route::get('/list-karyawan', [App\Http\Controllers\Api\KPDE\KaryawanController::class, 'listKaryawan', ['as' => 'pde']]);
        //detail karyawan
        Route::get('/detail-karyawan/{id}', [App\Http\Controllers\Api\KPDE\KaryawanController::class, 'detailKarywan', ['as' => 'pde']]);
        //update data karyawan
        Route::post('/update-karyawan/{id}', [App\Http\Controllers\Api\KPDE\KaryawanController::class,'ubahDataKaryawan', ['as' => 'pde']]);
        //hapus karyawan
        Route::delete('/hapus-karyawan/{id}', [App\Http\Controllers\Api\KPDE\KaryawanController::class, 'hapusKaryawan', ['as' => 'pde']]);
        //list kepala ruangan
        Route::get('/list-kroom', [App\Http\Controllers\Api\KPDE\RuanganController::class, 'listKR', ['as' => 'pde']]);
        //tambah data ruangan
        Route::post('/add-room', [App\Http\Controllers\Api\KPDE\RuanganController::class, 'addRoom', ['as' => 'pde']]);
        //list data ruangan
        Route::get('/list-room', [App\Http\Controllers\Api\KPDE\RuanganController::class, 'listRoom', ['as' => 'pde']]);
        //detail data ruangan
        Route::get('/detail-room/{id}', [App\Http\Controllers\Api\KPDE\RuanganController::class, 'detailRoom', ['as' => 'pde']]);
        //ubah ruangan
        Route::post('/ubah-room/{id}', [App\Http\Controllers\Api\KPDE\RuanganController::class, 'ubahRoom', ['as' => 'pde']]);
        //hapus ruangan
        Route::delete('/hapus-room/{id}', [App\Http\Controllers\Api\KPDE\RuanganController::class, 'hapusRoom', ['as' => 'pde']]);
    });
});
