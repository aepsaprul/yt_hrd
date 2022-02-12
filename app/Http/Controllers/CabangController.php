<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = Cabang::get();

        return view('pages.cabang.index', ['cabangs' => $cabang]);
    }

    public function store(Request $request)
    {
        $cabang = new Cabang;
        $cabang->nama = $request->nama;
        $cabang->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $cabang = Cabang::find($id);

        return response()->json([
            'id' => $cabang->id,
            'nama' => $cabang->nama
        ]);
    }

    public function update(Request $request, $id)
    {
        $cabang = Cabang::find($id);
        $cabang->nama = $request->nama;
        $cabang->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $cabang = Cabang::find($id);

        return response()->json([
            'id' => $cabang->id
        ]);
    }

    public function delete(Request $request)
    {
        $cabang = Cabang::find($request->id);
        $cabang->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
