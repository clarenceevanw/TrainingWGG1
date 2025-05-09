<?php

use App\Models\Pegawai;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckLevelAkses;
use App\Http\Controllers\PegawaiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);


Route::middleware(['admin'])->group(function () {
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/dashboard', [PegawaiController::class, 'dashboard'])->name('pegawai.dashboard');
    //Create Data Pegawai
    Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
    Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
    
    //Delete Data Pegawai
    Route::delete('/pegawai/delete/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    
    //Info Level Akses
    Route::get('/pegawai/info/akses', [PegawaiController::class, 'infoLevel'])->name('pegawai.infoAkses');

    //Create Level Akses
    Route::get('/pegawai/create/eakses', [PegawaiController::class, 'createAkses'])->name('pegawai.createAkses');
    Route::post('/pegawai/store/akses', [PegawaiController::class, 'storeAkses'])->name('pegawai.storeAkses');
    
    //Get Level Akses Pegawai
    Route::get('/pegawai/get-level-akses/{id}', [PegawaiController::class, 'getLevelAkses']);
    
    //Edit Level Akses
    Route::get('/akses', [PegawaiController::class, 'akses'])->name('pegawai.akses');
    Route::put('/pegawai/update-akses', [PegawaiController::class, 'updateAkses'])->name('pegawai.updateAkses');
});

Route::middleware(['karyawan'])->group(function() {
    Route::get('/info', [PegawaiController::class, 'info'])->name('pegawai.info');
    Route::get('/pegawai/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
    Route::put('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::post('/pegawai/logout', [LoginController::class, 'logout'])->name('pegawai.logout');
});