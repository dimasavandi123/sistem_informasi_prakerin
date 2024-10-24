<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Gurumapel;
use Illuminate\Http\Request;

class guruMapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurumapel = Gurumapel::all();
        return view('guru-mapel.index',compact('gurumapel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurumapel = Gurumapel::all();
        return view('guru-mapel.create',compact('gurumapel'));
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
            'nama_guru_mapel' => 'required',
            'nip_guru' => 'required',
            'nama_mapel' => 'required',
        ]);

        $gurumapel = new Gurumapel;
        $gurumapel->nama_guru_mapel = $request->nama_guru_mapel;
        $gurumapel->nip_guru = $request->nip_guru;
        $gurumapel->nama_mapel = $request->nama_mapel;
        $gurumapel->save();
        return to_route('guru-mapel.index')->with('success','Data Berhasil Ditambah');
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
        $gurumapel = Gurumapel::find($id);
        return view('guru-mapel.edit',compact('gurumapel'));
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
            'nama_guru_mapel' => 'required',
            'nip_guru' => 'required',
            'nama_mapel' => 'required',
        ]);

        $gurumapel = Gurumapel::find($id);
        $gurumapel->nama_guru_mapel = $request->nama_guru_mapel;
        $gurumapel->nip_guru = $request->nip_guru;
        $gurumapel->nama_mapel = $request->nama_mapel;
        $gurumapel->save();
        return to_route('guru-mapel.index')->with('success','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gurumapel = Gurumapel::find($id);
        if ($gurumapel){
        $gurumapel->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }

    public function cetakmapel(){
        $gurumapel = Gurumapel::select('*')->get();

        $pdf = PDF::loadView('guru-mapel.cetakmapel', ['gurumapel' => $gurumapel]);
        return $pdf->stream('Laporan-Daftar-Mapel.pdf');
    }
}
