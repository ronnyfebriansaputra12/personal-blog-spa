<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function viewRole()
    {
        return view('role.index');
    }

    public function index()
    {
        $data = Role::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return view('tombol')->with('data', $data);
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
            'nama_role' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors()
            ]);
        } else {
            Role::create($request->all());
            return response()->json([
                'success' => 'Berhasil Menambahkan Data'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role, $id)
    {
        $data = Role::find($id);
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role, $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_role' => 'required',
            'deskripsi' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $menu = Role::where('id', $id);
            $menu->update($request->all());
            return response()->json(['success' => 'Berhasil Update Data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role, $id)
    {
        Role::where('id',$id)->delete();
    }
}
