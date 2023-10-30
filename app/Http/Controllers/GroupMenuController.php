<?php

namespace App\Http\Controllers;

use App\Models\GroupMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GroupMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function viewGroupMenu()
    {
        return view('group-menu.index');
    }

    public function index()
    {
        $data = GroupMenu::all();
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
            'nama_group_menu' => 'required',
        ], [
            'nama_group_menu.required' => 'Kategori Wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            GroupMenu::create($request->all());
            return response()->json(['success' => 'Berhasil Menyimpan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupMenu $groupMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupMenu $groupMenu, $id)
    {
        $data = GroupMenu::find($id);
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupMenu $groupMenu, $id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_group_menu' => 'required',
        ], [
            'nama_group_menu.required' => 'Kategori Wajib diisi',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $groupMenu = GroupMenu::where('id',$id);
            $groupMenu->update($request->all());
            return response()->json(['success' => 'Berhasil Menyimpan data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupMenu $groupMenu, $id)
    {
        GroupMenu::where('id', $id)->delete();
    }
}
