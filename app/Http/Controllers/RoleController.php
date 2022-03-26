<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = Role::get();

        return view('pages.role.index', ['roles' => $role]);
    }

    public function store(Request $request)
    {
        $role = new Role;
        $role->nama = $request->nama;
        $role->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return response()->json([
            'role' => $role
        ]);
    }

    public function update(Request $request)
    {
        $role = Role::find($request->id);
        $role->nama = $request->nama;
        $role->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $role = Role::find($id);

        return response()->json([
            'id' => $role->id
        ]);
    }

    public function delete(Request $request)
    {
        $role = Role::find($request->id);
        $role->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }
}
