<?php

namespace App\Http\Controllers;

use Log;
use PDF;
use file;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Gurupem;
use App\Models\Prakerin;
use App\Models\Gurumapel;
use Illuminate\Http\Request;
use App\Models\tempatPrakerin;
use App\Imports\PrakerinImport;
use Maatwebsite\Excel\Facades\Excel;

class prakerinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil semua data yang dibutuhkan
        $siswa = Siswa::all();
        $Gurupem = Gurupem::all();
        $tempatPrakerin = tempatPrakerin::all();
        $gurumapel = Gurumapel::all();
    
        // Ambil filter dari request
        $kelasFilter = $request->input('kelas_filter');
    
        // Query dasar untuk prakerin
        $prakerinQuery = Prakerin::with(['siswa', 'Gurupem', 'kelas', 'tempatPrakerin', 'gurumapel']);
    
        // Jika ada filter kelas, tambahkan ke query
        if ($kelasFilter) {
            $prakerinQuery->where('kelas_id', $kelasFilter);
        }
    
        // Eksekusi query
        $prakerin = $prakerinQuery->get();
    
        // Ambil semua data kelas (untuk dropdown filter)
        $kelas = Kelas::all();
    
        return view('prakerin.index', compact('prakerin', 'siswa', 'Gurupem', 'kelas', 'tempatPrakerin', 'gurumapel', 'kelasFilter'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurumapel = Gurumapel::all();
        $siswa = Siswa::all();
        $gurupem = Gurupem::all();
        $kelas = Kelas::all();
        $tempatPrakerin = tempatPrakerin::all();
        return view('prakerin.create',compact('siswa','gurupem','kelas','tempatPrakerin','gurumapel'));
    }

    // AJAX
    public function getSiswaGuru(Request $request)
    {
    // Validasi input
    $gurumapel_id = $request->input('gurumapel_id');

    // Query untuk mendapatkan siswa berdasarkan gurumapel_id dari tabel pembimbing
    $gurupem = Gurupem::with('siswa', 'kelas')
                    ->where('gurumapel_id', $gurumapel_id)
                    ->get();

    // Format opsi siswa untuk dropdown
    $options = "<option value=''>--Pilih Siswa--</option>";
    foreach ($gurupem as $data) {
        $options .= "<option value='{$data->siswa->id}'>{$data->siswa->nama_siswa}</option>";
    }
    
    return response()->json(['options' => $options]);
    }
    
    

    public function getDetailSiswa(Request $request){
        $siswa_id = $request->input('siswa_id');
        $siswa = Siswa::find($siswa_id);
        $kelas = $siswa->kelas;
        return response()->json([
            'nis_siswa' => $siswa->nis_siswa,
            'kelas_jurusan_siswa' => $kelas->kelas_jurusan_siswa,
            'kelas_id' => $kelas->id
        ]);
    }

    public function searchSiswa(Request $request)
{
    $query = $request->input('query');
    $siswa = Siswa::where('nama_siswa', 'LIKE', '%' . $query . '%')->get();

    return response()->json($siswa);
}


    
    public function getPimpinan(Request $request){
        
    $id_tempatPrakerin = $request->input('id_tempatPrakerin');
    $tempatPrakerin = tempatPrakerin::find($id_tempatPrakerin);

    if ($tempatPrakerin) {
        return response()->json([
            'nama_pimpinan' => $tempatPrakerin->nama_pimpinan,
            'alamat_dudi' => $tempatPrakerin->alamat_dudi,
        ]);
    } else {
        return response()->json(['error' => 'Tempat Prakerin tidak ditemukan'], 404);
    }
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
            'gurumapel_id' => 'required',
            'siswa_id' => 'required',
            'kelas_id' => 'required',
            'nis_siswa' => 'required',
            'tempatPrakerin_id' => 'required',
            'nama_pimpinan' => 'required',
            'alamat_dudi' => 'required',
        ]);

        $prakerin = new Prakerin;
        $prakerin->gurumapel_id = $request->gurumapel_id;
        $prakerin->siswa_id = $request->siswa_id;
        $prakerin->tempatPrakerin_id = $request->tempatPrakerin_id;
        $prakerin->nama_pimpinan = $request->nama_pimpinan;
        $prakerin->alamat_dudi = $request->alamat_dudi;
        $prakerin->nis_siswa = $request->nis_siswa;
        $prakerin->kelas_id = $request->kelas_id;
        $prakerin->save();

        return to_route('prakerin.index')->with('success','Data Berhasil Ditambahkan');
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
        $gurumapel = Gurumapel::all();
        $siswa = Siswa::all();
        $gurupem = Gurupem::all();
        $kelas = Kelas::all();
        $tempatPrakerin = tempatPrakerin::all();
        $prakerin = Prakerin::findOrFail($id);
        return view('prakerin.edit',compact('siswa','gurupem','prakerin','kelas','tempatPrakerin','gurumapel'));
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
            'gurumapel_id' => 'required|exists:gurumapel,id',
            'siswa_id' => 'required|exists:siswa,id',
            'kelas_id' => 'required|exists:kelas,id',
            'nis_siswa' => 'required',
            'tempatPrakerin_id' => 'required|exists:tempatPrakerin,id',
            
            'nama_pimpinan' => 'required',
            'alamat_dudi' => 'required',
        ]);

        $prakerin = Prakerin::find($id);
        $prakerin->gurumapel_id = $request->gurumapel_id;
        $prakerin->siswa_id = $request->siswa_id;
        $prakerin->tempatPrakerin_id = $request->tempatPrakerin_id;
        $prakerin->nama_pimpinan = $request->nama_pimpinan;
        $prakerin->alamat_dudi = $request->alamat_dudi;
        $prakerin->nis_siswa = $request->nis_siswa;
        $prakerin->kelas_id = $request->kelas_id;
        $prakerin->update();

        return to_route('prakerin.index')->with('success','Data Berhasil Diupdate');
    }

    public function cetakprakerin(){
        $prakerin = Prakerin::select('*')->get();

        $pdf = PDF::loadView('prakerin.cetakprakerin', ['prakerin' => $prakerin]);
        return $pdf->stream('Laporan-Daftar-Siswa-Prakerin.pdf');
    }
    public function importPrakerin (Request $request){
        Excel::import(new PrakerinImport, $request->file('file')->store('files'));
        return redirect()->back()->with('success','Berhasil Mengimport Data');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $prakerin = Prakerin::find($id);
        if($prakerin){
            $prakerin->delete();
            return response()->json(['success' => 'Data Berhasil Dihapus']);
        }else{
            return response()->json(['error' => 'Data Tidak Ditemukan'],404);
        }
    }
}
