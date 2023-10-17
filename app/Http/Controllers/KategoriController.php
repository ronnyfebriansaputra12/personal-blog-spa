<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function viewKategori()
    {
        return view('kategori.index');
    }


    public function index()
    {
        $data = Kategori::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('tombol')->with('data',$data);
            })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kategori' => 'required',
        ], [
            'kategori.required' => 'Kategori Wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            Kategori::create($request->all());
            return response()->json(['success' => 'Berhasil Menyimpan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id){
        $data = Kategori::where('id',$id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validasi = Validator::make($request->all(), [
            'kategori' => 'required',
        ], [
            'kategori.required' => 'Kategori Wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            Kategori::where('id',$id)->update($request->all());
            return response()->json(['success' => 'Berhasil Mengubah data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kategori::where('id',$id)->delete();
    }
}
