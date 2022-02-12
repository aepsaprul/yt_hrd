<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::get();

        return view('pages.karyawan.index', ['karyawans' => $karyawan]);
    }

    public function store(Request $request)
    {
        $karyawan = new Karyawan;
        $karyawan->nama_lengkap = $request->input('nama');
        $karyawan->foto = $request->input('foto');

        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('image/', $filename);
            $karyawan->foto = $filename;
        }

        $karyawan->save();

        return response()->json([
            'status' => $request
        ]);
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
