<?php

namespace App\Http\Controllers;

use App\Models\NavMain;
use Illuminate\Http\Request;

class NavMainController extends Controller
{
    public function index()
    {
        $nav_main = NavMain::get();

        return view('pages.master.nav_main.index', ['nav_mains' => $nav_main]);
    }

    public function store(Request $request)
    {
        $nav_main = new NavMain;
        $nav_main->title = $request->title;
        $nav_main->link = $request->link;
        $nav_main->icon = $request->icon;
        $nav_main->set_active = $request->set_active;
        $nav_main->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $nav_main = NavMain::find($id);

        return response()->json([
            'id' => $nav_main->id,
            'nav_main' => $nav_main
        ]);
    }

    public function update(Request $request)
    {
        $nav_main = NavMain::find($request->id);
        $nav_main->title = $request->title;
        $nav_main->link = $request->link;
        $nav_main->icon = $request->icon;
        $nav_main->set_active = $request->set_active;
        $nav_main->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $nav_main = NavMain::find($id);

        return response()->json([
            'id' => $nav_main->id
        ]);
    }

    public function delete(Request $request)
    {
        $nav_main = NavMain::find($request->id);
        $nav_main->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
