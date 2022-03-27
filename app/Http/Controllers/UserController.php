<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\NavAccess;
use App\Models\NavSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $nav_access = NavAccess::with('karyawan')
            ->select(DB::raw('count(*) as nav_access_count, user_id'))
            ->groupBy('user_id')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.master.user.index', ['users' => $nav_access]);
    }

    public function create()
    {
        $karyawan = Karyawan::with('cabang')
            ->where('status_karyawan', 'aktif')
            ->doesntHave('navAccess')
            ->get();

        return response()->json([
            'karyawans' => $karyawan
        ]);
    }

    public function store(Request $request)
    {
        $nav_sub = NavSub::get();

        foreach ($nav_sub as $key => $item) {
            $nav_access = new NavAccess;
            $nav_access->user_id = $request->karyawan_id;
            $nav_access->main_id = $item->main_id;
            $nav_access->sub_id = $item->id;
            $nav_access->tampil = "n";
            $nav_access->save();
        }

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function delete(Request $request)
    {
        $nav_access = NavAccess::where('user_id', $request->id);
        $nav_access->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function access($id)
    {
        $karyawan = Karyawan::where('id', $id)->first();
        $menu = NavAccess::with('navSub')->where('user_id', $id)->get();
        $sub = NavAccess::with('navMain')
            ->where('user_id', $id)
            ->select(DB::raw('count(main_id) as total'),'main_id')
            ->groupBy('main_id')
            ->get();

        $sync = DB::table('nav_subs')
            ->select('nav_subs.id AS nav_sub_id', 'nav_subs.title AS title', 'nav_subs.main_id AS nav_main')
            ->leftJoin('nav_accesses', function($join) use ($id) {
                $join->on('nav_subs.id', '=', 'nav_accesses.sub_id')
                    ->where('nav_accesses.user_id', '=', $id);
            })
            ->whereNull('user_id')
            ->get();

        // return view('pages.master.user.access', [
        //     'karyawan' => $karyawan,
        //     'menus' => $menu,
        //     'subs' => $sub,
        //     'syncs' => $sync
        // ]);
        return response()->json([
            'karyawan' => $karyawan,
            'menus' => $menu,
            'subs' => $sub,
            'syncs' => $sync
        ]);
    }

    public function accessSave(Request $request, $id)
    {
        $nav_access = NavAccess::find($id);

        if ($request->show) {
            $nav_access->tampil = $request->show;
        }

        $nav_access->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function sync(Request $request)
    {
        $karyawan = Karyawan::where('id', $request->id)->first();

        $karyawan_id = $karyawan->id;
        $sync = DB::table('nav_subs')
            ->select('nav_subs.id AS nav_sub_id', 'nav_subs.title AS title', 'nav_subs.main_id AS nav_main')
            ->leftJoin('nav_accesses', function($join) use ($karyawan_id) {
                $join->on('nav_subs.id', '=', 'nav_accesses.sub_id')
                    ->where('nav_accesses.user_id', '=', $karyawan_id);
            })
            ->whereNull('user_id')
            ->get();

        foreach ($sync as $key => $item) {
            $nav_access = new NavAccess;
            $nav_access->user_id = $karyawan->id;
            $nav_access->main_id = $item->nav_main;
            $nav_access->sub_id = $item->nav_sub_id;
            $nav_access->tampil = "n";
            $nav_access->save();
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
