<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tempatPrakerin;
use PDF;

class tempatPrakerinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tempat-dudi.index')->with([
            'tempatPrakerin' => tempatPrakerin::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tempat-dudi.create');
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
            'nama_dudi' => 'required',
            'nama_pimpinan'  => 'required',
            'alamat_dudi'  => 'required',
            'jmlh_kuota' => 'required|numeric|max:12',
            'kuota_terisi' => 'required|numeric|max:12',
            'jurusan' => 'required'
        ],[
            'kuota_terisi.required' => 'Silahkan Isi Angka 0 Jika Tempat Dudi Belum Terisi Oleh Siswa',
            'jmlh_kuota.max' => 'Maximal Hanya 12 Siswa',
            'kuota_terisi.max' => 'Maximal Hanya 12 Siswa',
        ]);

        $sisa_kuota = $request->jmlh_kuota - $request->kuota_terisi;

        $tempatPrakerin = new tempatPrakerin;
        $tempatPrakerin->nama_dudi = $request->nama_dudi;
        $tempatPrakerin->nama_pimpinan = $request->nama_pimpinan;
        $tempatPrakerin->alamat_dudi = $request->alamat_dudi;
        $tempatPrakerin->jmlh_kuota = $request->jmlh_kuota;
        $tempatPrakerin->kuota_terisi = $request->kuota_terisi;
        $tempatPrakerin->jurusan = $request->jurusan;
        $tempatPrakerin->save();
        return to_route('tempat-dudi.index')->with('success','Data Berhasil Ditambahkan');
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
        return view('tempat-dudi.edit')->with([
            'tempatPrakerin' => tempatPrakerin::find($id),
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
            'nama_dudi' => 'required',
            'nama_pimpinan'  => 'required',
            'alamat_dudi'  => 'required',
            'jmlh_kuota' => 'required|numeric|max:12',
            'kuota_terisi' => 'required|numeric|max:12',
            'jurusan' => 'required'
        ],[
            'kuota_terisi.required' => 'Silahkan Isi Angka 0 Jika Tempat Dudi Belum Terisi Oleh Siswa',
            'jmlh_kuota.max' => 'Maximal Hanya 12 Siswa',
            'kuota_terisi.max' => 'Maximal Hanya 12 Siswa',
        ]);

        $sisa_kuota = $request->jmlh_kuota - $request->kuota_terisi;

        $tempatPrakerin = tempatPrakerin::find($id);
        $tempatPrakerin->nama_dudi = $request->nama_dudi;
        $tempatPrakerin->nama_pimpinan = $request->nama_pimpinan;
        $tempatPrakerin->alamat_dudi = $request->alamat_dudi;
        $tempatPrakerin->jmlh_kuota = $request->jmlh_kuota;
        $tempatPrakerin->kuota_terisi = $request->kuota_terisi;
        $tempatPrakerin->sisa_kuota = $request->sisa_kuota;
        $tempatPrakerin->jurusan = $request->jurusan;
        $tempatPrakerin->save();
        return to_route('tempat-dudi.index')->with('success','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tempatPrakerin = tempatPrakerin::find($id);
        if ($tempatPrakerin){
        $tempatPrakerin->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
        
    }

    public function cetaktempat(){
        $tempatPrakerin = tempatPrakerin::select('*')->get();

        $pdf = PDF::loadView('tempat-dudi.cetaktempat', ['tempatPrakerin' => $tempatPrakerin]);
        return $pdf->stream('Laporan-Daftar-Tempat-Prakerin.pdf');
    }
}
