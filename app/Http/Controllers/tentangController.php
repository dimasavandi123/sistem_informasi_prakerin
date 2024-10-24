<?php

namespace App\Http\Controllers;

use App\Models\Tentang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class tentangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tentang = Tentang::all();
        return view('tentang.index',compact('tentang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tentang.create');
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
            'gambar_tentang' => 'required|file',
            'text_tentang' => 'required|max:10000'
        ]);

        $tentang = new Tentang;
        if ($request->hasfile('gambar_tentang')) {
            $file = $request->file('gambar_tentang');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/tentang/' ,$filename);
            $tentang->gambar_tentang = $filename;
        }
        $tentang->text_tentang = $request->text_tentang;
        $tentang->save();
        return to_route('tentang.index')->with('success','Data Berhasil Ditambahkan');
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
        $tentang = Tentang::find($id);
        return view('tentang.edit',compact('tentang'));
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

            'text_tentang' => 'required|max:10000'
        ]);

        $tentang = Tentang::find($id);
        if ($request->hasfile('gambar_tentang')) {
            $foto = 'uploads/tentang/'. $tentang->gambar_tentang;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
            $file = $request->file('gambar_tentang');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/tentang/' ,$filename);
            $tentang->gambar_tentang = $filename;
        }
        $tentang->text_tentang = $request->text_tentang;
        $tentang->save();
        return to_route('tentang.index')->with('success','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $tentang = Tentang::find($id);
        if ($tentang){
            $foto = 'uploads/tentang/'. $tentang->gambar_tentang;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
        $tentang->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }
}
