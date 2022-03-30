<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\Resign;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan_aktif = Karyawan::where('status_karyawan', 'aktif')->get();
        $count_karyawan_aktif = count($karyawan_aktif);

        $karyawan_nonaktif = Karyawan::where('status_karyawan', 'nonaktif')->get();
        $count_karyawan_nonaktif = count($karyawan_nonaktif);

        $cuti = Cuti::where('approved_percentage', '<', 100)->get();
        $count_cuti = count($cuti);

        $resign = Resign::where('approved_percentage', '<', 100)->get();
        $count_resign = count($resign);

        return view('pages.dashboard.index', [
            'karyawan_aktif' => $karyawan_aktif,
            'count_karyawan_aktif' => $count_karyawan_aktif,
            'karyawan_nonaktif' => $karyawan_nonaktif,
            'count_karyawan_nonaktif' => $count_karyawan_nonaktif,
            'cuti' => $cuti,
            'count_cuti' => $count_cuti,
            'resign' => $resign,
            'count_resign' => $count_resign
        ]);
    }
}
