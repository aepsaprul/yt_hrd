<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\CutiApprover;
use App\Models\CutiDetail;
use App\Models\Karyawan;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanCutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::where('karyawan_id', Auth::user()->karyawan_id)->get();

        return view('pages.pengajuan.cuti.index', [
            'cutis' => $cuti
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
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi',
            'alasan.required' => 'Alasan harus diisi'
        ];

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'karyawan_id' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'alasan' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $cuti = new Cuti;
            $cuti->karyawan_id = $request->karyawan_id;
            $cuti->alasan = $request->alasan;
            $cuti->tanggal_mulai = $request->tanggal_mulai;
            $cuti->tanggal_selesai = $request->tanggal_selesai;
            $cuti->approved_text = "Permohonan Cuti";
            $cuti->approved_percentage = "0";
            $cuti->approved_background = "secondary";
            $cuti->save();

            $karyawan = Karyawan::find($request->karyawan_id);

            $approve = CutiApprover::where('role_id', $karyawan->role_id)->get();

            foreach ($approve as $key => $value) {
                $cuti_detail = new CutiDetail;
                $cuti_detail->cuti_id = $cuti->id;
                $cuti_detail->hirarki = $value->hirarki;
                $cuti_detail->atasan_id = $value->atasan_id;
                $cuti_detail->status = 0;
                $cuti_detail->confirm = 0;
                $cuti_detail->approved_text = "Permohonan Cuti";
                $cuti_detail->approved_percentage = "0";
                $cuti_detail->approved_background = "default";
                $cuti_detail->save();
            }

            return response()->json([
                'status' => 200,
                'message' => "Data berhasil ditambahkan"
            ]);
        }
    }
}
