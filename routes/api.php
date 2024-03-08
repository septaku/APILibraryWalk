<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\KategoriBukuRelasiController;
use App\Http\Controllers\KoleksiPribadiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UlasanBukuController;
use App\Http\Controllers\AuthController;


// Rute resource untuk CRUD user
Route::resource('users', UserController::class);

// Rute untuk BukuController
Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/{id}', [BukuController::class, 'show']);
Route::post('/buku', [BukuController::class, 'store']);
Route::put('/buku/{id}', [BukuController::class, 'update']);
Route::delete('/buku/{id}', [BukuController::class, 'destroy']);

// Rute untuk KategoriBukuController
Route::get('/kategoribuku', [KategoriBukuController::class, 'index']);
Route::get('/kategoribuku/{id}', [KategoriBukuController::class, 'show']);
Route::post('/kategoribuku', [KategoriBukuController::class, 'store']);
Route::put('/kategoribuku/{id}', [KategoriBukuController::class, 'update']);
Route::delete('/kategoribuku/{id}', [KategoriBukuController::class, 'destroy']);

// Rute untuk KategoriBukuRelasiController
Route::get('/kategoribukurelasi', [KategoriBukuRelasiController::class, 'index']);
Route::get('/kategoribukurelasi/{id}', [KategoriBukuRelasiController::class, 'show']);
Route::post('/kategoribukurelasi', [KategoriBukuRelasiController::class, 'store']);
Route::put('/kategoribukurelasi/{id}', [KategoriBukuRelasiController::class, 'update']);
Route::delete('/kategoribukurelasi/{id}', [KategoriBukuRelasiController::class, 'destroy']);

// Rute untuk KoleksiPribadiController
Route::get('/koleksipribadi', [KoleksiPribadiController::class, 'index']);
Route::get('/koleksipribadi/{id}', [KoleksiPribadiController::class, 'show']);
Route::post('/koleksipribadi', [KoleksiPribadiController::class, 'store']);
Route::put('/koleksipribadi/{id}', [KoleksiPribadiController::class, 'update']);
Route::delete('/koleksipribadi/{id}', [KoleksiPribadiController::class, 'destroy']);

// Rute untuk PeminjamanController
Route::get('/peminjaman', [PeminjamanController::class, 'index']);
Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show']);
Route::post('/peminjaman', [PeminjamanController::class, 'store']);
Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update']);
Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy']);

// Rute untuk UlasanBukuController
Route::get('/ulasanbuku', [UlasanBukuController::class, 'index']);
Route::get('/ulasanbuku/{id}', [UlasanBukuController::class, 'show']);
Route::post('/ulasanbuku', [UlasanBukuController::class, 'store']);
Route::put('/ulasanbuku/{id}', [UlasanBukuController::class, 'update']);
Route::delete('/ulasanbuku/{id}', [UlasanBukuController::class, 'destroy']);

// Rute untuk UserController
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::post('/login', [AuthController::class, 'login']);

// Middleware 'auth:sanctum' ditambahkan jika diperlukan otentikasi
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
