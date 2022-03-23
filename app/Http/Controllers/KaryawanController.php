<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::get();

        return view('pages.karyawan.index', ['karyawans' => $karyawan]);
    }

    public function create()
    {
        $jabatan = Jabatan::get();
        $cabang = Cabang::get();
        $divisi = Divisi::get();

        return response()->json([
            'jabatans' => $jabatan,
            'cabangs' => $cabang,
            'divisis' => $divisi
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|unique:karyawans|numeric',
            'nama_lengkap' => 'required|max:30',
            'nama_panggilan' => 'required|max:15',
            'telepon' => 'required|unique:karyawans|max:15',
            'email' => 'required|email|unique:karyawans|max:50',
            'nomor_ktp' => 'required|unique:karyawans|max:16',
            'status_ktp' => 'required|max:30',
            'tempat_lahir' => 'required|max:30',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|max:10',
            'gender' => 'required|max:1',
            'alamat_asal' => 'required',
            'alamat_domisili' => 'required',
            'nomor_sim' => 'unique:karyawans|max:15',
            'cabang_id' => 'required',
            'jabatan_id' => 'required',
            'divisi_id' => 'required',
            'tanggal_masuk' => 'required|date',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $karyawan = new Karyawan;
            $karyawan->nik = $request->nik;
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
            $karyawan->alamat_domisili = $request->alamat_domisili;
            $karyawan->jenis_sim = $request->jenis_sim;
            $karyawan->nomor_sim = $request->nomor_sim;
            $karyawan->cabang_id = $request->cabang_id;
            $karyawan->jabatan_id = $request->jabatan_id;
            $karyawan->divisi_id = $request->divisi_id;
            $karyawan->tanggal_masuk = $request->tanggal_masuk;
            $karyawan->status_karyawan = "aktif";

            if($request->hasFile('foto')) {
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $file->move('image/', $filename);
                $karyawan->foto = $filename;
            }

            $karyawan->save();

            return response()->json([
                'status' => 200,
                'message' => "Data berhasil ditambahkan"
            ]);
        }
    }

    public function edit($id)
    {
        $karyawan = Karyawan::find($id);

        $jabatan = Jabatan::get();

        $cabang = Cabang::get();

        $divisi = Divisi::get();

        return response()->json([
            'id' => $karyawan->id,
            'foto' => $karyawan->foto,
            'nik' => $karyawan->nik,
            'nama_lengkap' => $karyawan->nama_lengkap,
            'nama_panggilan' => $karyawan->nama_panggilan,
            'telepon' => $karyawan->telepon,
            'email' => $karyawan->email,
            'nomor_ktp' => $karyawan->nomor_ktp,
            'status_ktp' => $karyawan->status_ktp,
            'tempat_lahir' => $karyawan->tempat_lahir,
            'tanggal_lahir' => $karyawan->tanggal_lahir,
            'agama' => $karyawan->agama,
            'gender' => $karyawan->gender,
            'alamat_asal' => $karyawan->alamat_asal,
            'alamat_domisili' => $karyawan->alamat_domisili,
            'jenis_sim' => $karyawan->jenis_sim,
            'nomor_sim' => $karyawan->nomor_sim,
            'cabang_id' => $karyawan->cabang_id,
            'jabatan_id' => $karyawan->jabatan_id,
            'divisi_id' => $karyawan->divisi_id,
            'tanggal_masuk' => $karyawan->tanggal_masuk,
            'status_karyawan' => $karyawan->status_karyawan,
            'jabatans' => $jabatan,
            'cabangs' => $cabang,
            'divisis' => $divisi
        ]);
    }

    public function update(Request $request)
    {
        $karyawan = Karyawan::find($request->id);
        $karyawan->nik = $request->nik;
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
        $karyawan->alamat_domisili = $request->alamat_domisili;
        $karyawan->jenis_sim = $request->jenis_sim;
        $karyawan->nomor_sim = $request->nomor_sim;
        $karyawan->cabang_id = $request->cabang_id;
        $karyawan->jabatan_id = $request->jabatan_id;
        $karyawan->divisi_id = $request->divisi_id;
        $karyawan->tanggal_masuk = $request->tanggal_masuk;

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

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $karyawan = Karyawan::find($id);

        return response()->json([
            'id' => $karyawan->id
        ]);
    }

    public function delete(Request $request)
    {
        $karyawan = Karyawan::find($request->id);

        if (file_exists(public_path("image/" . $karyawan->foto))) {
            File::delete(public_path("image/" . $karyawan->foto));
        }

        $karyawan->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function status(Request $request)
    {
        $karyawan =  Karyawan::find($request->id);
        $karyawan->status_karyawan = $request->status;
        $karyawan->save();
    }
}
