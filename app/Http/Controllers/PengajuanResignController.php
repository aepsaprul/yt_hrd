<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Resign;
use App\Models\ResignApprover;
use App\Models\ResignDetail;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanResignController extends Controller
{
    public function index()
    {
        $resign = Resign::where('karyawan_id', Auth::user()->karyawan_id)->get();

        return view('pages.pengajuan.resign.index', [
            'resigns' => $resign
        ]);
    }

    public function create()
    {
        $karyawan = Karyawan::with('jabatan')->where('id', Auth::user()->karyawan_id)->first();

        return response()->json([
            'karyawan' => $karyawan
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'nama.required' => 'Nama harus diisi',
            'karyawan_id.required' => 'Karyawan id harus diisi',
            'tanggal_keluar.required' => 'Tanggal keluar harus diisi',
            'alasan.required' => 'Alasan harus diisi'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'karyawan_id' => 'required',
            'tanggal_keluar' => 'required',
            'alasan' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $resign = new Resign;
            $resign->karyawan_id = $request->karyawan_id;
            $resign->alasan = $request->alasan;
            $resign->tanggal_keluar = $request->tanggal_keluar;
            $resign->approved_text = "Permohonan Resign";
            $resign->approved_percentage = "0";
            $resign->approved_background = "secondary";
            $resign->save();

            $karyawan = Karyawan::find($request->karyawan_id);

            $approve = ResignApprover::where('role_id', $karyawan->role_id)->get();

            foreach ($approve as $key => $value) {
                $resign_detail = new ResignDetail;
                $resign_detail->resign_id = $resign->id;
                $resign_detail->hirarki = $value->hirarki;
                $resign_detail->atasan_id = $value->atasan_id;
                $resign_detail->status = 0;
                $resign_detail->confirm = 0;
                $resign_detail->approved_text = "Permohonan Resign";
                $resign_detail->approved_percentage = "0";
                $resign_detail->approved_background = "default";
                $resign_detail->save();
            }

            return response()->json([
                'status' => 200,
                'message' => "Data berhasil ditambahkan"
            ]);
        }
    }
}
