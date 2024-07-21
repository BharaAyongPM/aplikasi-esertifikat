<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KegiatanController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    // Rute yang hanya bisa diakses oleh admin
    Route::middleware('admin')->group(function () {
        Route::get('/beranda', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });


    // Display a list of all kegiatan
    Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');

    // Show the form for creating a new kegiatan
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');

    // Store a newly created kegiatan in storage
    Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');

    // Display the specified kegiatan
    Route::get('/kegiatan/{kegiatan}', [KegiatanController::class, 'show'])->name('kegiatan.show');

    // Show the form for editing the specified kegiatan
    Route::get('/kegiatan/{kegiatan}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');

    // Update the specified kegiatan in storage
    Route::put('/kegiatan/{kegiatan}', [KegiatanController::class, 'update'])->name('kegiatan.update');

    // Remove the specified kegiatan from storage
    Route::delete('/kegiatan/{kegiatan}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    Route::post('/kegiatan/{id}/upload-participants', [KegiatanController::class, 'uploadParticipants'])->name('kegiatan.uploadParticipants');
    Route::get('/kegiatan/{id}/certificates', [KegiatanController::class, 'showCertificates'])->name('kegiatan.certificates');
    Route::get('/kegiatan/{kegiatan}/participants', [KegiatanController::class, 'showParticipants'])->name('kegiatan.participants');
    Route::get('/participants/{participant}/download-certificate', [KegiatanController::class, 'downloadCertificate'])->name('participant.downloadCertificate');
});
Route::get('/sertifikat', [KegiatanController::class, 'publicIndex'])->name('public.kegiatan.index');
Route::get('/sertifikat/{kegiatan}', [KegiatanController::class, 'publicShow'])->name('public.kegiatan.show');
Route::post('/kegiatan/{kegiatan}/search-certificate', [KegiatanController::class, 'searchCertificate'])->name('public.kegiatan.searchCertificate');
Route::get('/certificate/{certificate}', [KegiatanController::class, 'showCertificate'])->name('public.certificate.show');
Route::get('/kegiatan/{certificate}/download', [KegiatanController::class, 'createCertificate'])->name('kegiatan.downloadCertificate');
// Dalam routes/web.php
Route::get('/verif/{certificate_number}', [KegiatanController::class, 'verifyCertificate'])->name('certificate.verify');
Route::get('/', [KegiatanController::class, 'publicIndex'])->name('home');
