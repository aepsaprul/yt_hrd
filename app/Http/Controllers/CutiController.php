<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::get();

        return view('pages.cuti.index', ['cutis' => $cuti]);
    }

    public function show($id)
    {
        $cuti = Cuti::find($id);

        return response()->json([
            'cuti' => $cuti
        ]);
    }

    public function deleteBtn($id)
    {
        $cuti = Cuti::find($id);

        return response()->json([
            'id' => $cuti->id
        ]);
    }

    public function delete(Request $request)
    {
        $cuti = Cuti::find($request->id);
        $cuti->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
