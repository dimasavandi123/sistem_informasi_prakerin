<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class bannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::all();
        return view('banner.index',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('banner.create');
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
            'gambar_banner' => 'required',
            'judul_banner1' => 'required',
            'judul_banner2' => 'required',
            'judul_banner3' => 'required',
        ]);

        $banner = new Banner;
        if ($request->hasfile('gambar_banner')) {
            $file = $request->file('gambar_banner');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/banner/' ,$filename);
            $banner->gambar_banner = $filename;
        }
        $banner->judul_banner1 = $request->judul_banner1;
        $banner->judul_banner2 = $request->judul_banner2;
        $banner->judul_banner3 = $request->judul_banner3;
        $banner->save();
        return to_route('banner.index')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('banner.edit',compact('banner'));    
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
        
            'judul_banner1' => 'required',
            'judul_banner2' => 'required',
            'judul_banner3' => 'required',
        ]);

        $banner = Banner::find($id);
        if ($request->hasfile('gambar_banner')) {
            $foto = 'uploads/banner/' .$banner->gambar_banner;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
            $file = $request->file('gambar_banner');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/banner/' ,$filename);
            $banner->gambar_banner = $filename;
        }
        $banner->judul_banner1 = $request->judul_banner1;
        $banner->judul_banner2 = $request->judul_banner2;
        $banner->judul_banner3 = $request->judul_banner3;
        $banner->save();
        return to_route('banner.index')->with('success','Data Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if ($banner){
            $foto = 'uploads/banner/' .$banner->gambar_banner;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
        $banner->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }
}
