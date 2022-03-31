<?php

use App\Http\Controllers\CabangController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CutiApprovalController;
use App\Http\Controllers\CutiApproverController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\NavMainController;
use App\Http\Controllers\NavSubController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\PengajuanResignController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResignApprovalController;
use App\Http\Controllers\ResignApproverController;
use App\Http\Controllers\ResignController;
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
    // profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/store', [ProfileController::class, 'store'])->name('profile.store');

    // ubah password
    Route::get('change_password', [ChangePasswordController::class, 'index'])->name('change_password.index');
    Route::post('change_password/store', [ChangePasswordController::class, 'store'])->name('change_password.store');

    // dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

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

        // resign approver
        Route::get('master/resign_approver', [ResignApproverController::class, 'index'])->name('resign_approver.index');
        Route::get('master/resign_approver/get_resign', [ResignApproverController::class, 'getresign'])->name('resign_approver.get_resign');
        Route::get('master/resign_approver/create', [ResignApproverController::class, 'create'])->name('resign_approver.create');
        Route::post('master/resign_approver/store', [ResignApproverController::class, 'store'])->name('resign_approver.store');
        Route::post('master/resign_approver/update_approver', [ResignApproverController::class, 'updateApprover'])->name('resign_approver.update_approver');
        Route::post('master/resign_approver/add_approver', [ResignApproverController::class, 'addApprover'])->name('resign_approver.add_approver');
        Route::get('master/resign_approver/{id}/delete_btn', [ResignApproverController::class, 'deleteBtn'])->name('resign_approver.delete_btn');
        Route::post('master/resign_approver/delete', [ResignApproverController::class, 'delete'])->name('resign_approver.delete');
        Route::get('master/resign_approver/{id}/delete_btn_approver', [ResignApproverController::class, 'deleteBtnApprover'])->name('resign_approver.delete_btn_approver');
        Route::post('master/resign_approver/delete_approver', [ResignApproverController::class, 'deleteApprover'])->name('resign_approver.delete_approver');

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

    // approval cuti
    Route::get('cuti_approval', [CutiApprovalController::class, 'index'])->name('cuti_approval.index');
    Route::get('cuti_approval/{id}/show', [CutiApprovalController::class, 'show'])->name('cuti_approval.show');
    Route::get('cuti_approval/{id}/approved', [CutiApprovalController::class, 'approved'])->name('cuti_approval.approved');
    Route::get('cuti_approval/{id}/disapproved', [CutiApprovalController::class, 'disapproved'])->name('cuti_approval.disapproved');

    // data resign
    Route::get('resign', [ResignController::class, 'index'])->name('resign.index');
    Route::get('resign/{id}/show', [ResignController::class, 'show'])->name('resign.show');
    Route::get('resign/{id}/delete_btn', [ResignController::class, 'deleteBtn'])->name('resign.delete_btn');
    Route::post('resign/delete', [ResignController::class, 'delete'])->name('resign.delete');

    // approval resign
    Route::get('resign_approval', [ResignApprovalController::class, 'index'])->name('resign_approval.index');
    Route::get('resign_approval/{id}/show', [ResignApprovalController::class, 'show'])->name('resign_approval.show');
    Route::get('resign_approval/{id}/approved', [ResignApprovalController::class, 'approved'])->name('resign_approval.approved');
    Route::get('resign_approval/{id}/disapproved', [ResignApprovalController::class, 'disapproved'])->name('resign_approval.disapproved');

    // pengajuan cuti
    Route::get('pengajuan/cuti', [PengajuanCutiController::class, 'index'])->name('pengajuan_cuti.index');
    Route::get('pengajuan/cuti/create', [PengajuanCutiController::class, 'create'])->name('pengajuan_cuti.create');
    Route::post('pengajuan/cuti/store', [PengajuanCutiController::class, 'store'])->name('pengajuan_cuti.store');

    // pengajuan resign
    Route::get('pengajuan/resign', [PengajuanResignController::class, 'index'])->name('pengajuan_resign.index');
    Route::get('pengajuan/resign/create', [PengajuanResignController::class, 'create'])->name('pengajuan_resign.create');
    Route::post('pengajuan/resign/store', [PengajuanResignController::class, 'store'])->name('pengajuan_resign.store');

    // informasi
    Route::get('informasi', [InformasiController::class, 'index'])->name('informasi.index');
    Route::post('informasi/store', [InformasiController::class, 'store'])->name('informasi.store');
    Route::get('informasi/{id}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');
    Route::post('informasi/update', [InformasiController::class, 'update'])->name('informasi.update');
    Route::get('informasi/{id}/delete_btn', [InformasiController::class, 'deleteBtn'])->name('informasi.delete_btn');
    Route::post('informasi/delete', [InformasiController::class, 'delete'])->name('informasi.delete');
    Route::put('informasi/{id}/publish_save', [InformasiController::class, 'publishSave'])->name('informasi.publish_save');
});
