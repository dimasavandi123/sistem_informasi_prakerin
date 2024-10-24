<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Gurupem;
use App\Models\Gurumapel;
use Illuminate\Http\Request;

class gurupemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gurumapel = Gurumapel::all();
        $siswa = Siswa::all();
        $kelas = Kelas::all();
    
        // Cek apakah filter kelas dipilih
        if ($request->has('kelas_filter') && $request->kelas_filter != '') {
            // Filter berdasarkan kelas yang dipilih
            $gurupem = Gurupem::where('kelas_id', $request->kelas_filter)->get();
        } else {
            // Tampilkan semua data jika tidak ada filter
            $gurupem = Gurupem::all();
        }
    
        return view('guru-pembimbing.index', compact('gurupem', 'siswa', 'kelas', 'gurumapel'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurumapel = Gurumapel::all();
        $kelas = Kelas::all();
        $siswa = Siswa::all();
        return view('guru-pembimbing.create',compact('kelas','siswa','gurumapel'));
    }

    public function getSiswa(Request $request){
        $id_kelas = $request->input('id_kelas');
        $siswa = Siswa::where('kelas_id',$id_kelas)->get();
        $options = "<option value=''>--Pilih Siswa--</option>"; // O
        foreach($siswa as $siswas){
            
            $options.= "<option value='$siswas->id'>$siswas->nama_siswa</option>";
        }
        return response()->json(['options' => $options]);
    }

    public function getNis(Request $request){
        $id_siswa = $request->input('id_siswa');
        $siswa = Siswa::find($id_siswa);
        return response()->json(['nis_siswa' => $siswa->nis_siswa]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gurumapel_id' => 'required|string|exists:gurumapel,id',
            'kelas_id' => 'required|exists:kelas,id',
            'siswa_id' => 'required|array',
            'siswa_id.*' => 'exists:siswa,id',
            'nis_siswa' => 'required|array',  // Pastikan NIS disertakan dalam array
        ]);
    
        foreach ($request->siswa_id as $index => $siswa_id) {
            Gurupem::create([
                'gurumapel_id' => $request->gurumapel_id,
                'kelas_id' => $request->kelas_id,
                'siswa_id' => $siswa_id,
                'nis_siswa' => $request->nis_siswa[$index],  // Simpan NIS berdasarkan index siswa
            ]);
        }
    
        return redirect()->route('guru-pembimbing.index')->with('success', 'Data berhasil disimpan!');
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
        $siswa = Siswa::all();
          $gurumapel = Gurumapel::all();
        $kelas = Kelas::all();
        $gurupem = Gurupem::find($id);
        return view('guru-pembimbing.edit',compact('gurupem','siswa','kelas','gurumapel'));
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
            'gurumapel_id' => 'required|string|exists:gurumapel,id',
            'siswa_id' => 'required|exists:siswa,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);
    
        $gurupem = Gurupem::findOrFail($id);
        $gurupem->gurumapel_id = $request->gurumapel_id;
        $gurupem->siswa_id = $request->siswa_id;
        $gurupem->kelas_id = $request->kelas_id;
        
        $gurupem->save();
    
        return redirect()->route('guru-pembimbing.index')->with('success', 'Data Guru Pembimbing berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gurupem = Gurupem::find($id);
        if ($gurupem){
        $gurupem->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }

    public function cetakpem(){
        $gurupem = Gurupem::select('*')->get();

        $pdf = PDF::loadView('guru-pembimbing.cetakpem', ['gurupem' => $gurupem]);
        return $pdf->stream('Laporan-Daftar-Guru-Pembimbing.pdf');
    }
}
