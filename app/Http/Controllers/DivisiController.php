<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function index()
    {
        $divisi = Divisi::get();

        return view('pages.divisi.index', ['divisis' => $divisi]);
    }

    public function store(Request $request)
    {
        $divisi = new Divisi;
        $divisi->nama = $request->nama;
        $divisi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $divisi = Divisi::find($id);

        return response()->json([
            'id' => $divisi->id,
            'nama' => $divisi->nama
        ]);
    }

    public function update(Request $request)
    {
        $divisi = Divisi::find($request->id);
        $divisi->nama = $request->nama;
        $divisi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $divisi = Divisi::find($id);

        return response()->json([
            'id' => $divisi->id
        ]);
    }

    public function delete(Request $request)
    {
        $divisi = Divisi::find($request->id);
        $divisi->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
