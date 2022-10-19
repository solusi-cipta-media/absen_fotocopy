<?php

use App\Http\Controllers\KaryawanController;
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

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('profil', function () {
    return view('profil');
})->name('profil');

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::get('karyawan/{id}', [KaryawanController::class, 'get'])->name('karyawan.get');
Route::put('karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
Route::delete('karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.delete');

Route::get('mesin', function () {
    return view('mesin');
})->name('mesin');

Route::get('customer', function () {
    return view('customer');
})->name('customer');

Route::get('kontrak', function () {
    return view('kontrak');
})->name('kontrak');

Route::get('cuti', function () {
    return view('cuti');
})->name('cuti');

Route::get('absensi', function () {
    return view('absensi');
})->name('absensi');

Route::get('absensi_ketidakhadiran', function () {
    return view('absensi_ketidakhadiran');
})->name('absensi_ketidakhadiran');


Route::get('periode', function () {
    return view('periode');
})->name('periode');

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
