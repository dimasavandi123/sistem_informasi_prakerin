<?php

namespace App\Http\Controllers;

use App\Models\Collaborate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class collaborateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collaborate = Collaborate::all();
        return view('collaborate.index',compact('collaborate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('collaborate.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_industri' => 'required',
            'logo_industri' => 'required|file',
            'jurusan_sekolah' => 'required',
        ]);

        $collaborate = new Collaborate;
        $collaborate->nama_industri = $request->nama_industri;

        if ($request->hasfile('logo_industri')) {
            $file = $request->file('logo_industri');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/kerjasama/' ,$filename);
            $collaborate->logo_industri = $filename;
        }

        $collaborate->jurusan_sekolah = $request->jurusan_sekolah;
        $collaborate->save();
        return to_route('collaborate.index')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collaborate = Collaborate::find($id);
        return view('collaborate.edit',compact('collaborate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_industri' => 'required',
            'jurusan_sekolah' => 'required',
        ]);

        $collaborate = Collaborate::find($id);
        $collaborate->nama_industri = $request->nama_industri;

        if ($request->hasfile('logo_industri')) {
            $foto = 'uploads/kerjasama/' .$collaborate->logo_industri;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
            $file = $request->file('logo_industri');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/kerjasama/' ,$filename);
            $collaborate->logo_industri = $filename;
        }

        $collaborate->jurusan_sekolah = $request->jurusan_sekolah;
        $collaborate->save();
        return to_route('collaborate.index')->with('success','Data Berhasil DiEdit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collaborate = Collaborate::find($id);
        if ($collaborate){
            $foto = 'uploads/collaborate/' .$collaborate->logo_industri;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
        $collaborate->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }
}
