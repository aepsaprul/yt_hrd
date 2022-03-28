<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Resign;
use App\Models\ResignDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResignApprovalController extends Controller
{
    public function index()
    {
        $karyawan_id = Auth::user()->karyawan_id;

        $resign_detail = ResignDetail::with('resign')
            ->where('atasan_id', 'like', "%\"$karyawan_id\"%")
            ->where('confirm', 0)
            ->get();

        return view('pages.resign_approval.index', ['resign_details' => $resign_detail]);
    }

    public function show($id)
    {
        $resign = Resign::with('karyawan')->find($id);

        return response()->json([
            'resign' => $resign
        ]);
    }

    public function approved($id)
    {
        $resign_detail = ResignDetail::find($id);

        // update status, agar resign tampil di approver selanjutnya
        $hirarki = $resign_detail->hirarki + 1;

        $total_resign_detail = count(ResignDetail::where('resign_id', $resign_detail->resign_id)->get());

        if ($hirarki <= $total_resign_detail) {
            $resign_detail_next = ResignDetail::where('resign_id', $resign_detail->resign_id)->where('hirarki', $hirarki)->first();
            $resign_detail_next->status = 1;
            $resign_detail_next->save();
        }
        // end

        // hitung persentase progress
        $percentage = ceil(100 / $total_resign_detail);
        // end

        $karyawan = Karyawan::where('id', Auth::user()->karyawan_id)->first();
        if ($karyawan->jenis_kelamin == "l") {
            $approved_text = "Approved Oleh Pak";
        } else {
            $approved_text = "Approved Oleh Bu";
        }

        $resign_detail->status = 1;
        $resign_detail->confirm = 1;
        $resign_detail->approved_date = date('Y-m-d H:i:s');
        $resign_detail->approved_leader = Auth::user()->karyawan_id;
        $resign_detail->approved_text = $approved_text;
        $resign_detail->approved_percentage = $resign_detail->approved_percentage + $percentage;
        $resign_detail->approved_background = "primary";
        $resign_detail->save();

        $resign = Resign::find($resign_detail->resign_id);
        $resign->approved_date = date('Y-m-d H:i:s');
        $resign->approved_leader = Auth::user()->karyawan_id;
        $resign->approved_text = $approved_text;
        $resign->approved_percentage = $resign->approved_percentage + $percentage;
        $resign->approved_background = "primary";
        $resign->save();

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

        $resign_detail = ResignDetail::find($id);
        $resign_detail->status = 1;
        $resign_detail->confirm = 2;
        $resign_detail->approved_date = date('Y-m-d H:i:s');
        $resign_detail->approved_leader = Auth::user()->karyawan_id;
        $resign_detail->approved_text = $approved_text;
        $resign_detail->approved_percentage = 100;
        $resign_detail->approved_background = "danger";
        $resign_detail->save();

        $resign = Resign::find($resign_detail->resign_id);
        $resign->approved_date = date('Y-m-d H:i:s');
        $resign->approved_leader = Auth::user()->karyawan_id;
        $resign->approved_text = $approved_text;
        $resign->approved_percentage = 100;
        $resign->approved_background = "danger";
        $resign->save();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
