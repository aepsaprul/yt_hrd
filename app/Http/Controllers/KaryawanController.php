<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
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

        return response()->json([
            'jabatans' => $jabatan,
            'cabangs' => $cabang
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
            'tanggal_masuk' => 'required|date',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
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

        return response()->json([
            'id' => $karyawan->id,
            'nama' => $karyawan->nama
        ]);
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->nama = $request->nama;
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
        $karyawan->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
