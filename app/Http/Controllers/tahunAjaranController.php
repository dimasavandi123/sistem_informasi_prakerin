<?php

namespace App\Http\Controllers;

use App\Models\tahunAjaran;
use Illuminate\Http\Request;

class tahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahunAjaran = tahunAjaran::all();
        return view('tahun-ajaran.index',compact('tahunAjaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahun-ajaran.create');

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
            'tahun_ajaran' => 'required',
            'semester' => 'required'
        ]);

        $tahunAjaran = new tahunAjaran;
        $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
        $tahunAjaran->semester = $request->semester;
        $tahunAjaran->save();
        return to_route('tahun-ajaran.index')->with('success','Data Berhasil Ditambahkan');
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
        $tahunAjaran = tahunAjaran::find($id);
        return view('tahun-ajaran.edit',compact('tahunAjaran'));
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
            'tahun_ajaran' => 'required',
            'semester' => 'required'
        ]);

        $tahunAjaran = tahunAjaran::find($id);
        $tahunAjaran->tahun_ajaran = $request->tahun_ajaran;
        $tahunAjaran->semester = $request->semester;
        $tahunAjaran->save();
        return to_route('tahun-ajaran.index')->with('success','Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
             
        $tahunAjaran = tahunAjaran::find($id);

        if($tahunAjaran){
            $tahunAjaran->delete();
            return response()->json(['success' => 'Data Berhasil Dihapus']);
        }else{
            return response()->json(['error' => 'Data Tidak Ditemukan'],404);
        }
    }
}
