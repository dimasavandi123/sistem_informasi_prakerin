<?php

namespace App\Http\Controllers;

use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class galeryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galery = Galery::orderBy('created_at','desc')->get();
        return view ('galery.index',compact('galery'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('galery.create');
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
            'judul_galery' => 'required',
            'gambar_galery' => 'required|file',
        ]);

        $galery = new Galery;
        $galery->judul_galery = $request->judul_galery;

        if ($request->hasfile('gambar_galery')) {
            $file = $request->file('gambar_galery');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/galery/' ,$filename);
            $galery->gambar_galery = $filename;
        }
        $galery->save();
        return to_route('galery.index')->With('success','Data Berhasil Ditambahkan');
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
        $galery = Galery::find($id);
        return view ('galery.edit',compact('galery'));
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
            'judul_galery' => 'required',
            
        ]);

        $galery = Galery::find($id);
        $galery->judul_galery = $request->judul_galery;

        if ($request->hasfile('gambar_galery')) {
            $foto = 'uploads/galery/' .$galery->gambar_galery = $filename;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
            $file = $request->file('gambar_galery');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/galery/' ,$filename);
            $galery->gambar_galery = $filename;
        }
        $galery->save();
        return to_route('galery.index')->With('success','Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galery = Galery::find($id);
        if ($galery){
            $foto = 'uploads/galery/' .$galery->gambar_galery;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
        $galery->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }
}
