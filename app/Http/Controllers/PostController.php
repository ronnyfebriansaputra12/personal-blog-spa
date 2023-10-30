<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Post;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function viewPost()
    {
        $kategoris = Kategori::all();
        return view('post.index', compact('kategoris'));
    }

    public function index()
    {
        $data = Post::with('kategori')->get();

        return DataTables::of($data)
            ->addColumn('kategori', function ($data) {
                return $data->kategori->kategori;
            })
            ->addColumn('action', function ($data) {
                return view('tombol')->with('data', $data);
            })
            ->make(true);
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
            'user_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'kategori_id' => 'required'
        ]);

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            Post::create($request->all());
            return response()->json(['success' => 'Berhasil Menyimpan data']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post,$id)
    {
        Post::where('id', $id)->delete();
    }
}
