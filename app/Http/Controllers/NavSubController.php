<?php

namespace App\Http\Controllers;

use App\Models\NavMain;
use App\Models\NavSub;
use Illuminate\Http\Request;

class NavSubController extends Controller
{
    public function index()
    {
        $nav_sub = NavSub::get();

        return view('pages.master.nav_sub.index', ['nav_subs' => $nav_sub]);
    }

    public function create()
    {
        $main = NavMain::get();

        return response()->json([
            'nav_mains' => $main
        ]);
    }

    public function store(Request $request)
    {
        $nav_sub = new NavSub;
        $nav_sub->title = $request->title;
        $nav_sub->link = $request->link;
        $nav_sub->main_id = $request->main_id;
        $nav_sub->set_active = $request->set_active;
        $nav_sub->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $nav_sub = NavSub::find($id);
        $nav_main = NavMain::get();

        return response()->json([
            'id' => $nav_sub->id,
            'nav_sub' => $nav_sub,
            'nav_mains' => $nav_main
        ]);
    }

    public function update(Request $request)
    {
        $nav_sub = NavSub::find($request->id);
        $nav_sub->title = $request->title;
        $nav_sub->link = $request->link;
        $nav_sub->main_id = $request->main_id;
        $nav_sub->set_active = $request->set_active;
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
