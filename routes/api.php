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
    Route::group(['middleware' => 'auth:api_kpde'], function(){
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

//kepala ruangan
Route::prefix('kr')->group(function(){
    //Route Login
    Route::post('/login', [App\Http\Controllers\Api\KR\LoginController::class, 'index', ['as' => 'kr']]);
    //route with middleware
    Route::group(['middleware' => 'auth:api_kr'], function(){
        //get data ruangan
        Route::post('/data-ruangan', [App\Http\Controllers\Api\KR\KeluhanController::class, 'getDataRuangan', ['as' => 'kr']]);

        //post keluhan
        Route::post('/keluhan', [App\Http\Controllers\Api\KR\KeluhanController::class, 'ajukanKeluhan', ['as' => 'kr']]);

        //list keluhan
        Route::post('/list-keluhan', [App\Http\Controllers\Api\KR\KeluhanController::class, 'listKeluhan', ['as' => 'kr']]);

        //detail keluhan {id}
        Route::get('/detail-keluhan/{id}', [App\Http\Controllers\Api\KR\KeluhanController::class, 'detailKeluhan', ['as' => 'kr']]);
    });
});

//teknisi
Route::prefix('teknisi')->group(function(){
    //route login
    Route::post('/login', [App\Http\Controllers\API\TEKNISI\LoginController::class, 'index', ['as' => 'teknisi']]);
    //route with middleware
    Route::group(['middleware' => 'auth:api_teknisi'], function (){
        //get user
        Route::get('/user', [App\Http\Controllers\API\TEKNISI\LoginController::class, 'getUser', ['as' => 'teknisi']]);

        //list data keluhan (notif)
        Route::get('/keluhan', [App\Http\Controllers\Api\TEKNISI\KeluhanController::class, 'listKeluhan', ['as' => 'teknisi']]);

        //ambil perbaikan
        Route::post('/ambil-perbaikan', [App\Http\Controllers\Api\TEKNISI\PerbaikanController::class, 'ambilPerbaikan', ['as' => 'teknisi']]);

        //list perbaikan berdasarkan user teknisi
        Route::post('/list-perbaikan', [App\Http\Controllers\API\TEKNISI\PerbaikanController::class, 'listPerbaikan', ['as' => 'teknisi']]);
    });
});
