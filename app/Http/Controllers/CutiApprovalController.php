<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\CutiDetail;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiApprovalController extends Controller
{
    public function index()
    {
        $karyawan_id = Auth::user()->karyawan_id;

        $cuti_detail = CutiDetail::with('cuti')
            ->where('atasan_id', 'like', "%\"$karyawan_id\"%")
            ->where('confirm', 0)
            ->get();

        return view('pages.cuti_approval.index', ['cuti_details' => $cuti_detail]);
    }

    public function show($id)
    {
        $cuti = Cuti::with('karyawan')->find($id);

        return response()->json([
            'cuti' => $cuti
        ]);
    }

    public function approved($id)
    {
        $cuti_detail = CutiDetail::find($id);

        // update status, agar cuti tampil di approver selanjutnya
        $hirarki = $cuti_detail->hirarki + 1;

        $total_cuti_detail = count(CutiDetail::where('cuti_id', $cuti_detail->cuti_id)->get());

        if ($hirarki <= $total_cuti_detail) {
            $cuti_detail_next = CutiDetail::where('cuti_id', $cuti_detail->cuti_id)->where('hirarki', $hirarki)->first();
            $cuti_detail_next->status = 1;
            $cuti_detail_next->save();
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_cuti_detail);
        // end

        $karyawan = Karyawan::where('id', Auth::user()->karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "l") {
            $approved_text = "Approved Oleh Pak";
        } else {
            $approved_text = "Approved Oleh Bu";
        }

        $cuti_detail->status = 1;
        $cuti_detail->confirm = 1;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->karyawan_id;
        $cuti_detail->approved_text = $approved_text;
        $cuti_detail->approved_percentage = $cuti_detail->approved_percentage + $percentage;
        $cuti_detail->approved_background = "primary";
        $cuti_detail->save();

        $cuti = Cuti::find($cuti_detail->cuti_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->karyawan_id;
        $cuti->approved_text = $approved_text;
        $cuti->approved_percentage = $cuti->approved_percentage + $percentage;
        $cuti->approved_background = "primary";
        $cuti->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function disapproved($id)
    {
        $karyawan = Karyawan::where('id', Auth::user()->karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "l") {
            $approved_text = "Disapproved Oleh Pak";
        } else {
            $approved_text = "Disapproved Oleh Bu";
        }

        $cuti_detail = CutiDetail::find($id);
        $cuti_detail->status = 1;
        $cuti_detail->confirm = 2;
        $cuti_detail->approved_date = date('Y-m-d H:i:s');
        $cuti_detail->approved_leader = Auth::user()->karyawan_id;
        $cuti_detail->approved_text = $approved_text;
        $cuti_detail->approved_percentage = 100;
        $cuti_detail->approved_background = "danger";
        $cuti_detail->save();

        $cuti = Cuti::find($cuti_detail->cuti_id);
        $cuti->approved_date = date('Y-m-d H:i:s');
        $cuti->approved_leader = Auth::user()->master_karyawan_id;
        $cuti->approved_text = $approved_text;
        $cuti->approved_percentage = 100;
        $cuti->approved_background = "danger";
        $cuti->save();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
