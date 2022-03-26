<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\NavMainController;
use App\Http\Controllers\NavSubController;
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
    // master
        // nav main
        Route::get('nav_main', [NavMainController::class, 'index'])->name('nav_main.index');
        Route::post('nav_main/store', [NavMainController::class, 'store'])->name('nav_main.store');
        Route::get('nav_main/{id}/edit', [NavMainController::class, 'edit'])->name('nav_main.edit');
        Route::post('nav_main/update', [NavMainController::class, 'update'])->name('nav_main.update');
        Route::get('nav_main/{id}/delete_btn', [NavMainController::class, 'deleteBtn'])->name('nav_main.delete_btn');
        Route::post('nav_main/delete', [NavMainController::class, 'delete'])->name('nav_main.delete');

        // nav sub
        Route::get('nav_sub', [NavSubController::class, 'index'])->name('nav_sub.index');
        Route::post('nav_sub/store', [NavSubController::class, 'store'])->name('nav_sub.store');
        Route::get('nav_sub/{id}/edit', [NavSubController::class, 'edit'])->name('nav_sub.edit');
        Route::post('nav_sub/update', [NavSubController::class, 'update'])->name('nav_sub.update');
        Route::get('nav_sub/{id}/delete_btn', [NavSubController::class, 'deleteBtn'])->name('nav_sub.delete_btn');
        Route::post('nav_sub/delete', [NavSubController::class, 'delete'])->name('nav_sub.delete');

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
