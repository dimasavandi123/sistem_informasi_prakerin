<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Prakerin;
use PDF;
use App\Models\Instruktur;
use Illuminate\Http\Request;
use App\Models\tempatPrakerin;

class instrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prakerin = Prakerin::all();
        $siswa = Siswa::all();
        $tempatPrakerin = tempatPrakerin::all();
        $instruktur = Instruktur::all();
        return view('instruktur-dudi.index',compact('prakerin','siswa','tempatPrakerin','instruktur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $prakerin = Prakerin::all();
        $siswa = Siswa::all();
        $tempatPrakerin = tempatPrakerin::all();
        $instruktur = Instruktur::all();
        return view('instruktur-dudi.create',compact('prakerin','siswa','tempatPrakerin','instruktur'));
    }

    public function getTempat(Request $request){
      
        $prakerin_id = $request->input('prakerin_id');
        $prakerin = Prakerin::where('id', $prakerin_id)->with('siswa')->get();
        $options = "<option value=''>--Pilih Siswa--</option>";
        foreach ($prakerin as $prak) {
            if ($prak->siswa) {
                $options .= "<option value='{$prak->siswa->id}'>{$prak->siswa->nama_siswa}</option>";
            }
        }
        return response()->json(['options' => $options]);
    }

    public function getDetail(Request $request){
        $siswa_id = $request->input('siswa_id');
        $siswa = Siswa::find($siswa_id);
        $kelas = $siswa->kelas;
        return response()->json([
            'kelas_jurusan_siswa' => $kelas->kelas_jurusan_siswa,
            'kelas_id' => $kelas->id
        ]);
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
            'nama_instruktur' => 'required',
            'prakerin_id' => 'required|exists:prakerin,id',
            'siswa_id' => 'required|exists:siswa,id',
            'kelas_id' => 'required'
        ]);

        $instruktur = new Instruktur;
        $instruktur->nama_instruktur = $request->nama_instruktur;
        $instruktur->prakerin_id = $request->prakerin_id;
        $instruktur->siswa_id = $request->siswa_id;
        $instruktur->kelas_id = $request->kelas_id;
        $instruktur->save();
        return to_route('instruktur-dudi.index')->with('success','Data Berhasil Ditambah');
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
        $prakerin = Prakerin::all();
        $siswa = Siswa::all();
        $tempatPrakerin = tempatPrakerin::all();
        $instruktur = Instruktur::find($id);
        return view('instruktur-dudi.edit',compact('prakerin','siswa','tempatPrakerin','instruktur'));
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
            'nama_instruktur' => 'required',
            'prakerin_id' => 'required|exists:prakerin,id',
            'siswa_id' => 'required|exists:siswa,id',
            'kelas_id' => 'required'
        ]);

        $instruktur = Instruktur::find($id);
        $instruktur->nama_instruktur = $request->nama_instruktur;
        $instruktur->prakerin_id = $request->prakerin_id;
        $instruktur->siswa_id = $request->siswa_id;
        $instruktur->kelas_id = $request->kelas_id;
        $instruktur->save();
        return to_route('instruktur-dudi.index')->with('success','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instruktur = Instruktur::find($id);
        if ($instruktur){
        $instruktur->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }

    public function cetakins(){
        $instruktur = Instruktur::select('*')->get();

        $pdf = PDF::loadView('instruktur-dudi.cetakins', ['instruktur' => $instruktur]);
        return $pdf->stream('Laporan-Daftar-Instruktur-Dudi.pdf');
    }
}
