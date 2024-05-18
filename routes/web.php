<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\KegiatanDosenController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// dd(bcrypt("password"));
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/admin', [HomeController::class, 'admin'])->middleware('role:admin');
Route::get('/user', [HomeController::class, 'user'])->middleware('role:user');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    //kegiatan
    Route::get('/tambahKegiatan', [App\Http\Controllers\KegiatanDosenController::class, 'create'])->name('tambahKegiatan');
    Route::get('/kegiatanDosen', [App\Http\Controllers\KegiatanDosenController::class, 'index'])->name('kegiatanDosen.index');
    Route::post('/simpanKegiatan', [App\Http\Controllers\KegiatanDosenController::class, 'store'])->name('simpanKegiatan');
    Route::get('/editKegiatan/{id}', [KegiatanDosenController::class, 'edit'])->name('editKegiatan');
    Route::post('/updateKegiatan/{id}', [KegiatanDosenController::class, 'update'])->name('updateKegiatan');
    Route::get('/deleteKegiatan/{id}', [KegiatanDosenController::class, 'destroy'])->name('deleteKegiatan');
    Route::get('/searchKegiatan', [KegiatanDosenController::class, 'search'])->name('searchKegiatan');

    //Dosen
    Route::get('/dosen', [App\Http\Controllers\DosenController::class, 'index'])->name('dosen.index');
    Route::get('/tambahDosen', [App\Http\Controllers\DosenController::class, 'create'])->name('tambahDosen');
    Route::post('/simpanDosen', [App\Http\Controllers\DosenController::class, 'store'])->name('simpanDosen');
    Route::get('/editDosen/{NIP}', [DosenController::class, 'edit'])->name('editDosen');
    Route::post('/updateDosen/{NIP}', [DosenController::class, 'update'])->name('updateDosen');
    Route::get('/deleteDosen/{NIP}', [DosenController::class, 'destroy'])->name('deleteDosen');
    Route::get('/searchDosen', [DosenController::class, 'search'])->name('searchDosen');

    //logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

//Login with google
Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
