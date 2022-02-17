<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // cabang
    Route::get('cabang', [CabangController::class, 'index'])->name('cabang.index');
    Route::post('cabang/store', [CabangController::class, 'store'])->name('cabang.store');
    Route::get('cabang/{id}/edit', [CabangController::class, 'edit'])->name('cabang.edit');
    Route::put('cabang/{id}/update', [CabangController::class, 'update'])->name('cabang.update');
    Route::get('cabang/{id}/delete_btn', [CabangController::class, 'deleteBtn'])->name('cabang.delete_btn');
    Route::post('cabang/delete', [CabangController::class, 'delete'])->name('cabang.delete');

    // divisi
    Route::get('divisi', [DivisiController::class, 'index'])->name('divisi.index');
    Route::post('divisi/store', [DivisiController::class, 'store'])->name('divisi.store');
    Route::get('divisi/{id}/edit', [DivisiController::class, 'edit'])->name('divisi.edit');
    Route::post('divisi/update', [DivisiController::class, 'update'])->name('divisi.update');
    Route::get('divisi/{id}/delete_btn', [DivisiController::class, 'deleteBtn'])->name('divisi.delete_btn');
    Route::post('divisi/delete', [DivisiController::class, 'delete'])->name('divisi.delete');

    // jabatan
    Route::get('jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::post('jabatan/store', [JabatanController::class, 'store'])->name('jabatan.store');
    Route::get('jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::put('jabatan/{id}/update', [JabatanController::class, 'update'])->name('jabatan.update');
    Route::get('jabatan/{id}/delete_btn', [JabatanController::class, 'deleteBtn'])->name('jabatan.delete_btn');
    Route::post('jabatan/delete', [JabatanController::class, 'delete'])->name('jabatan.delete');

    // karyawan
    Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::post('karyawan/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('karyawan/{id}/delete_btn', [KaryawanController::class, 'deleteBtn'])->name('karyawan.delete_btn');
    Route::post('karyawan/delete', [KaryawanController::class, 'delete'])->name('karyawan.delete');
    Route::post('karyawan/status', [KaryawanController::class, 'status'])->name('karyawan.status');
});
