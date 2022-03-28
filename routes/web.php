<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\CutiApproverController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\NavMainController;
use App\Http\Controllers\NavSubController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth'])->group(function () {
    // master
        // nav main
        Route::get('master/nav_main', [NavMainController::class, 'index'])->name('nav_main.index');
        Route::post('master/nav_main/store', [NavMainController::class, 'store'])->name('nav_main.store');
        Route::get('master/nav_main/{id}/edit', [NavMainController::class, 'edit'])->name('nav_main.edit');
        Route::post('master/nav_main/update', [NavMainController::class, 'update'])->name('nav_main.update');
        Route::get('master/nav_main/{id}/delete_btn', [NavMainController::class, 'deleteBtn'])->name('nav_main.delete_btn');
        Route::post('master/nav_main/delete', [NavMainController::class, 'delete'])->name('nav_main.delete');

        // nav sub
        Route::get('master/nav_sub', [NavSubController::class, 'index'])->name('nav_sub.index');
        Route::get('master/nav_sub/create', [NavSubController::class, 'create'])->name('nav_sub.create');
        Route::post('master/nav_sub/store', [NavSubController::class, 'store'])->name('nav_sub.store');
        Route::get('master/nav_sub/{id}/edit', [NavSubController::class, 'edit'])->name('nav_sub.edit');
        Route::post('master/nav_sub/update', [NavSubController::class, 'update'])->name('nav_sub.update');
        Route::get('master/nav_sub/{id}/delete_btn', [NavSubController::class, 'deleteBtn'])->name('nav_sub.delete_btn');
        Route::post('master/nav_sub/delete', [NavSubController::class, 'delete'])->name('nav_sub.delete');

        // user
        Route::get('master/user', [UserController::class, 'index'])->name('user.index');
        Route::get('master/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('master/user/store', [UserController::class, 'store'])->name('user.store');
        Route::get('master/user/{id}/delete_btn', [UserController::class, 'deleteBtn'])->name('user.delete_btn');
        Route::post('master/user/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('master/user/{id}/access', [UserController::class, 'access'])->name('user.access');
        Route::put('master/user/{id}/access_save', [UserController::class, 'accessSave'])->name('user.access_save');
        Route::post('master/user/sync', [UserController::class, 'sync'])->name('user.sync');

        // cuti approver
        Route::get('master/cuti_approver', [CutiApproverController::class, 'index'])->name('cuti_approver.index');
        Route::get('master/cuti_approver/get_cuti', [CutiApproverController::class, 'getCuti'])->name('cuti_approver.get_cuti');
        Route::get('master/cuti_approver/create', [CutiApproverController::class, 'create'])->name('cuti_approver.create');
        Route::post('master/cuti_approver/store', [CutiApproverController::class, 'store'])->name('cuti_approver.store');
        Route::post('master/cuti_approver/update_approver', [CutiApproverController::class, 'updateApprover'])->name('cuti_approver.update_approver');
        Route::post('master/cuti_approver/add_approver', [CutiApproverController::class, 'addApprover'])->name('cuti_approver.add_approver');
        Route::get('master/cuti_approver/{id}/delete_btn', [CutiApproverController::class, 'deleteBtn'])->name('cuti_approver.delete_btn');
        Route::post('master/cuti_approver/delete', [CutiApproverController::class, 'delete'])->name('cuti_approver.delete');
        Route::get('master/cuti_approver/{id}/delete_btn_approver', [CutiApproverController::class, 'deleteBtnApprover'])->name('cuti_approver.delete_btn_approver');
        Route::post('master/cuti_approver/delete_approver', [CutiApproverController::class, 'deleteApprover'])->name('cuti_approver.delete_approver');

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

    // role
    Route::get('role', [RoleController::class, 'index'])->name('role.index');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/update', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/{id}/delete_btn', [RoleController::class, 'deleteBtn'])->name('role.delete_btn');
    Route::post('role/delete', [RoleController::class, 'delete'])->name('role.delete');

    // karyawan
    Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create');
    Route::post('karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::get('karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
    Route::post('karyawan/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::get('karyawan/{id}/delete_btn', [KaryawanController::class, 'deleteBtn'])->name('karyawan.delete_btn');
    Route::post('karyawan/delete', [KaryawanController::class, 'delete'])->name('karyawan.delete');
    Route::post('karyawan/status', [KaryawanController::class, 'status'])->name('karyawan.status');

    // data cuti
    Route::get('cuti', [CutiController::class, 'index'])->name('cuti.index');
    Route::get('cuti/show', [CutiController::class, 'show'])->name('cuti.show');
    Route::get('cuti/{id}/delete_btn', [CutiController::class, 'deleteBtn'])->name('cuti.delete_btn');
    Route::post('cuti/delete', [CutiController::class, 'delete'])->name('cuti.delete');
});
