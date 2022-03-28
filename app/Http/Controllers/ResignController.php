<?php

namespace App\Http\Controllers;

use App\Models\Resign;
use Illuminate\Http\Request;

class ResignController extends Controller
{
    public function index()
    {
        $resign = Resign::get();

        return view('pages.resign.index', ['resigns' => $resign]);
    }

    public function show($id)
    {
        $resign = Resign::with('karyawan')->find($id);

        return response()->json([
            'resign' => $resign
        ]);
    }

    public function deleteBtn($id)
    {
        $resign = Resign::find($id);

        return response()->json([
            'id' => $resign->id
        ]);
    }

    public function delete(Request $request)
    {
        $resign = Resign::find($request->id);
        $resign->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
