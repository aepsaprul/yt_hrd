<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::get();

        return view('pages.informasi.index', ['informasis' => $informasi]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'document' => 'required|mimes:pdf|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ]);
        } else {
            $informasi = new Informasi;
            $informasi->title = $request->title;
            $informasi->publish = 'y';

            if($request->hasFile('document')) {
                $file = $request->file('document');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "." . $extension;
                $file->move('file/', $filename);
                $informasi->document = $filename;
            }

            $informasi->save();

            return response()->json([
                'status' => 200
            ]);
        }
    }

    public function edit($id)
    {
        $informasi = Informasi::find($id);

        return response()->json([
            'id' => $informasi->id,
            'informasi' => $informasi
        ]);
    }

    public function update(Request $request)
    {
        $informasi = Informasi::find($request->id);
        $informasi->title = $request->title;

        if($request->hasFile('document')) {
            if (file_exists(public_path("file/" . $informasi->document))) {
                File::delete(public_path("file/" . $informasi->document));
            }
            $file = $request->file('document');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('file/', $filename);
            $informasi->document = $filename;
        }

        $informasi->save();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function deleteBtn($id)
    {
        $informasi = Informasi::find($id);

        return response()->json([
            'id' => $informasi->id
        ]);
    }

    public function delete(Request $request)
    {
        $informasi = Informasi::find($request->id);

        if (file_exists(public_path("file/" . $informasi->document))) {
            File::delete(public_path("file/" . $informasi->document));
        }

        $informasi->delete();

        return response()->json([
            'status' => 'true'
        ]);
    }

    public function publishSave(Request $request, $id)
    {
        $informasi = Informasi::find($id);
        $informasi->publish = $request->publish;
        $informasi->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
