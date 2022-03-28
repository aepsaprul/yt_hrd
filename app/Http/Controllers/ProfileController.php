<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::find(Auth::user()->karyawan_id);
        if ($karyawan != null) {
            return view('pages.profile.index', ['karyawan' => $karyawan]);
        } else {
            return view('error_500');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|max:30',
            'nama_panggilan' => 'required|max:15',
            'telepon' => 'required|max:15',
            'email' => 'required|email|max:50',
            'nomor_ktp' => 'required|max:16',
            'status_ktp' => 'required|max:30',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|max:10',
            'gender' => 'required|max:1',
            'alamat_asal' => 'required',
            'nomor_sim' => 'max:15',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $karyawan = Karyawan::find($request->id);
            $karyawan->nama_lengkap = $request->nama_lengkap;
            $karyawan->nama_panggilan = $request->nama_panggilan;
            $karyawan->telepon = $request->telepon;
            $karyawan->email = $request->email;
            $karyawan->nomor_ktp = $request->nomor_ktp;
            $karyawan->status_ktp = $request->status_ktp;
            $karyawan->tempat_lahir = $request->tempat_lahir;
            $karyawan->tanggal_lahir = $request->tanggal_lahir;
            $karyawan->agama = $request->agama;
            $karyawan->gender = $request->gender;
            $karyawan->alamat_asal = $request->alamat_asal;
            $karyawan->jenis_sim = $request->jenis_sim;
            $karyawan->nomor_sim = $request->nomor_sim;

            if($request->hasFile('foto')) {
                if (file_exists(public_path("image/" . $karyawan->foto))) {
                    File::delete(public_path("image/" . $karyawan->foto));
                }
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $file->move('image/', $filename);
                $karyawan->foto = $filename;
            }

            $karyawan->save();

            $user = User::where('karyawan_id', $request->id)->first();
            $user->name = $request->nama_lengkap;
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => "Data berhasil diperbaharui"
            ]);
        }
    }
}
