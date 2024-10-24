<?php

namespace App\Http\Controllers;

use App\Models\Visimisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class visimisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visimisi = Visimisi::all();
        return view('visi-misi.index',compact('visimisi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visi-misi.create');
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
            'gambar_visimisi' => 'required|file',
            'judul_visimisi' => 'required',
            'slogan_visimisi' => 'required',
            'deskripsi_visimisi' => 'required',
        ]);

        $visimisi = new Visimisi;
        if ($request->hasfile('gambar_visimisi')) {
            $file = $request->file('gambar_visimisi');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/visi-misi/' ,$filename);
            $visimisi->gambar_visimisi = $filename;
        }

        $visimisi->judul_visimisi = $request->judul_visimisi;
        $visimisi->slogan_visimisi = $request->slogan_visimisi;
        $visimisi->deskripsi_visimisi = $request->deskripsi_visimisi;
        $visimisi->save();
        return to_route('visimisi.index')->with('suceess','Data Berhasil Ditambahkan');
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
        $visimisi = Visimisi::find($id);
        return view('visi-misi.edit',compact('visimisi'));
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
    
            'judul_visimisi' => 'required',
            'slogan_visimisi' => 'required',
            'deskripsi_visimisi' => 'required',
        ]);

        $visimisi = Visimisi::find($id);
        if ($request->hasfile('gambar_visimisi')) {
            $foto = 'uploads/visi-misi/'. $visimisi->gambar_visimisi;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
            $file = $request->file('gambar_visimisi');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/visi-misi/' ,$filename);
            $visimisi->gambar_visimisi = $filename;
        }

        $visimisi->judul_visimisi = $request->judul_visimisi;
        $visimisi->slogan_visimisi = $request->slogan_visimisi;
        $visimisi->deskripsi_visimisi = $request->deskripsi_visimisi;
        $visimisi->save();
        return to_route('visimisi.index')->with('suceess','Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visimisi = Visimisi::find($id);
        if ($visimisi){
            $foto = 'uploads/visi-misi/'. $visimisi->gambar_visimisi;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
        $visimisi->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }
}
