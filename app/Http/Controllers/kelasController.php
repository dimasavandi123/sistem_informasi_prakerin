<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use PDF;
use Illuminate\Http\Request;

class kelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        $siswa = Siswa::all();
        return view ('kelas.index',compact('kelas','siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelas.create');
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
            'kelas_jurusan_siswa' => 'required'
        ]);

        $kelas = new Kelas;
        $kelas->kelas_jurusan_siswa = $request->kelas_jurusan_siswa;
        $kelas->save();
        return to_route('kelas.index')->with('success','Data Berhasil Ditambahkan');

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
        return view ('kelas.edit')->with([
            'kelas' => Kelas::find($id),
        ]);
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
            'kelas_jurusan_siswa' => 'required'
        ]);

        $kelas = Kelas::find($id);
        $kelas->kelas_jurusan_siswa = $request->kelas_jurusan_siswa;
        $kelas->save();
        return to_route('kelas.index')->with('success','Data Berhasil Diupdate');
    }


    public function cetakkelas(){
        $kelas = Kelas::select('*')->get();

        $pdf = PDF::loadView('kelas.cetakkelas', ['kelas' => $kelas]);
        return $pdf->stream('Laporan-Daftar-Kelas.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        if ($kelas){
        $kelas->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }
}
