<?php

namespace App\Http\Controllers;

use App\Models\GroupMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function viewMenu()
    {
        $GroupMenu = GroupMenu::all();
        return view('menu.index', compact('GroupMenu'));
    }


    public function index()
    {
        $data = Menu::all();
        return DataTables::of($data)
            ->addColumn('group-menu', function ($data) {
                return $data->groupMenu->nama_group_menu;
            })
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
        // dd($request->all());
        $validasi = Validator::make($request->all(), [
            'group_id' => 'required',
            'nama_menu' => 'required',
            'url' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'errors' => $validasi->errors()
            ]);
        } else {
            Menu::create($request->all());
            return response()->json([
                'success' => 'Berhasil Menambahkan Data'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu, $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu,$id)
    {
        $data = Menu::find($id);
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu, $id)
    {
        $validasi = Validator::make($request->all(), [
            'group_id' => 'required',
            'nama_menu' => 'required',
            'url' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $menu = Menu::where('id', $id);
            $menu->update($request->all());
            return response()->json(['success' => 'Berhasil Update Data']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, $id)
    {
        Menu::where('id', $id)->delete();
    }
}
