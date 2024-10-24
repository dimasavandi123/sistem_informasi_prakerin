<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class beritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'desc')->get();
        return view('berita.index',compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.create');
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
            'judul_berita' => 'required',
            'gambar_berita' => 'required|file',
            'cover_berita' => 'required|file',
            'artikel_berita' => 'required',
        ]);

        $berita = new Berita;
        $berita->judul_berita = $request->judul_berita;
        // GAMBAR BERITA
        if ($request->hasfile('gambar_berita')) {
            $file = $request->file('gambar_berita');
            $extension = $file->getClientOriginalExtension();
            $filename = 'gambar_berita_'.time().'.'.$extension;
            $file->move('uploads/berita/' ,$filename);
            $berita->gambar_berita = $filename;
        }
        // COVER BERITA
        if ($request->hasfile('cover_berita')) {
            $file = $request->file('cover_berita');
            $extension = $file->getClientOriginalExtension();
            $filename = 'cover_berita_'.time().'.'.$extension;
            $file->move('uploads/berita/' ,$filename);
            $berita->cover_berita = $filename;
        }
        $excerpt = Str::limit(nl2br(str_replace('&nbsp;', ' ', strip_tags($request->artikel_berita, '<p><a><b><i><strong><em><ul><ol><li><br>'))), 1000);
        $berita->artikel_berita =  $excerpt ;
        $berita->save();
        return to_route('berita.index')->with('success','Data Berhasil Ditambahkan');
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
        $berita = Berita::find($id);
        return view('berita.edit',compact('berita'));
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
            'judul_berita' => 'required',
            'artikel_berita' => 'required',
        ]);

        $berita = Berita::find($id);
        $berita->judul_berita = $request->judul_berita;
        // GAMBAR BERITA
        if ($request->hasfile('gambar_berita')) {
            $foto = 'uplodas/berita' .$berita->gambar_berita;
            if (File::exists($foto)) 
            {
                File::delete($foto);
            }
            $file = $request->file('gambar_berita');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/berita/' ,$filename);
            $berita->gambar_berita = $filename;
        }
        // COVER BERITA
        if ($request->hasfile('cover_berita')) {
            $foto = 'uplodas/berita' .$berita->cover_berita;
            if (File::exists($foto)) 
            {
                File::delete($foto);
            }
            $file = $request->file('cover_berita');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/berita/' ,$filename);
            $berita->cover_berita = $filename;
        }
        $excerpt = Str::limit(nl2br(str_replace('&nbsp;', ' ', strip_tags($request->artikel_berita, '<p><a><b><i><strong><em><ul><ol><li><br>'))), 1000);
        $berita->save();
        return to_route('berita.index')->with('success','Data Berhasil Diedit');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::find($id);
        if ($berita){
            $fotoBerita = 'uploads/berita/' .$berita->gambar_berita;
            if(File::exists($fotoBerita))
            {
                File::delete($fotoBerita);
            }
            $fotoCover = 'uploads/berita/' .$berita->cover_berita;
            if(File::exists($fotoCover))
            {
                File::delete($fotoCover);
            }
        $berita->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }
}
