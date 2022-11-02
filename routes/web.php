<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiKetidakhadiranController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KontrakController;
use App\Http\Controllers\MesinController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PeriodeController;
use App\Models\AbsensiKetidakhadiran;
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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('login', [AuthController::class, 'login_page'])->name('login.form');

Route::middleware(['auth', 'supervisor'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan');
    Route::post('karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('karyawan/{id}', [KaryawanController::class, 'get'])->name('karyawan.get');
    Route::post('karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.delete');

    Route::get('mesin', [MesinController::class, 'index'])->name('mesin');
    Route::post('mesin', [MesinController::class, 'store'])->name('mesin.store');
    Route::post('mesin/{id}', [MesinController::class, 'update'])->name('mesin.update');
    Route::get('mesin/{id}', [MesinController::class, 'get'])->name('mesin.get');
    Route::delete('mesin/{id}', [MesinController::class, 'destroy'])->name('mesin.delete');

    Route::post('customer/select', [CustomerController::class, 'select'])->name('customer.select');
    Route::get('customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('customer/code', [CustomerController::class, 'generateCode'])->name('customer.code');
    Route::get('customer/{id}', [CustomerController::class, 'get'])->name('customer.get');
    Route::post('customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('customer/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');


    Route::get('kontrak', [KontrakController::class, 'index'])->name('kontrak');
    Route::post('kontrak', [KontrakController::class, 'store'])->name('kontrak.store');
    Route::get('kontrak/{id}', [KontrakController::class, 'get'])->name('kontrak.get');
    Route::post('kontrak/{id}', [KontrakController::class, 'update'])->name('kontrak.update');
    Route::delete('kontrak/{id}', [KontrakController::class, 'destroy'])->name('kontrak.delete');

    Route::get('cuti', [CutiController::class, 'index'])->name('cuti');
    Route::post('cuti', [CutiController::class, 'store'])->name('cuti.store');
    Route::get('cuti/{id}', [CutiController::class, 'get'])->name('cuti.get');
    Route::post('cuti/{id}', [CutiController::class, 'update'])->name('cuti.update');
    Route::delete('cuti/{id}', [CutiController::class, 'destroy'])->name('cuti.delete');

    Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi');
    Route::get('absensi/{data}', [AbsensiController::class, 'indexDate'])->name('absensi.dateRange');

    Route::get('absensi_ketidakhadiran', [AbsensiKetidakhadiranController::class, 'index'])->name('absensi_ketidakhadiran');
    Route::get('absensi_ketidakhadiran/{data}', [AbsensiKetidakhadiranController::class, 'indexDate'])->name('absensi_ketidakhadiran.dateRange');
    Route::get('absensi_ketidakhadiran/approve/{id}', [AbsensiKetidakhadiranController::class, 'approve'])->name('absensi_ketidakhadiran.approve');
    Route::get('absensi_ketidakhadiran/reject/{id}', [AbsensiKetidakhadiranController::class, 'reject'])->name('absensi_ketidakhadiran.reject');

    Route::get('periode', [PeriodeController::class, 'index'])->name('periode');
    Route::post('periode', [PeriodeController::class, 'store'])->name('periode.store');
    Route::delete('periode/{id}', [PeriodeController::class, 'destroy'])->name('periode.delete');

    Route::get('notifikasi/load', [NotifikasiController::class, 'load'])->name('notifikasi.load');
    Route::get('notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('overhaul_list', function () {
        return view('overhaul_list');
    })->name('overhaul_list');

    Route::get('overhaul_proses', function () {
        return view('overhaul_proses');
    })->name('overhaul_proses');

    Route::get('cekqr', function () {
        return view('cekqr');
    })->name('cekqr');

    Route::get('jadwal_spk', function () {
        return view('jadwal_spk');
    })->name('jadwal_spk');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('absen', function () {
        return view('absen');
    })->name('absen');
    Route::post('absen/in', [AbsensiController::class, 'clock_in'])->name('absen.in');
    Route::post('absen/out', [AbsensiController::class, 'clock_out'])->name('absen.out');

    Route::get('pengajuancuti', [CutiController::class, 'pengajuanindex'])->name('pengajuancuti');

    Route::get('profil', [ProfilController::class, 'index'])->name('profil');
    Route::post('profil/user', [ProfilController::class, 'update_user_profile'])->name('profil.user');
    Route::post('profil/password', [ProfilController::class, 'update_password'])->name('profil.password');
    Route::post('profil/info', [ProfilController::class, 'update_informasi_pribadi'])->name('profil.informasi');
});
