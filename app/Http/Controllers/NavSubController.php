<?php

namespace App\Http\Controllers;

use App\Models\NavSub;
use Illuminate\Http\Request;

class NavSubController extends Controller
{
    public function index()
    {
        $nav_sub = NavSub::get();

        return view('pages.master.nav_sub.index', ['nav_subs' => $nav_sub]);
    }

    public function store(Request $request)
    {
        $nav_sub = new NavSub;
        $nav_sub->nama = $request->nama;
        $nav_sub->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $nav_sub = NavSub::find($id);

        return response()->json([
            'id' => $nav_sub->id,
            'nama' => $nav_sub->nama
        ]);
    }

    public function update(Request $request, $id)
    {
        $nav_sub = NavSub::find($id);
        $nav_sub->nama = $request->nama;
        $nav_sub->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $nav_sub = NavSub::find($id);

        return response()->json([
            'id' => $nav_sub->id
        ]);
    }

    public function delete(Request $request)
    {
        $nav_sub = NavSub::find($request->id);
        $nav_sub->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
