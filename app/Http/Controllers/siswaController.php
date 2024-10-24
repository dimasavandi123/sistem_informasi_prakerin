<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Siswa;
use PDF;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelas_id = $request->get('kelas_id');
    
        $kelas = Kelas::all();
        
        $query = Siswa::orderBy('nama_siswa','ASC');
        
        if ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
            $siswa = $query->get();
        }else{

            $siswa = $query->paginate(4);
        }
        
        return view('siswa.index', compact('siswa', 'kelas', 'kelas_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create',compact('kelas'));
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
            'nama_siswa' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'nis_siswa' => 'required',
           
            'tmpt_lahir_siswa' => 'required',
            'tgl_lahir_siswa' => 'required',
            'jenis_kelamin' => 'required',
            'no_ortu' => 'required',
        ]);

        $siswa = new Siswa;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->nis_siswa = $request->nis_siswa;
        $siswa->tmpt_lahir_siswa = $request->tmpt_lahir_siswa;
        $siswa->tgl_lahir_siswa = $request->tgl_lahir_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->no_ortu = $request->no_ortu;
        $siswa->save();
        return to_route('siswa.index')->with('success','Data Berhasil Ditambahkan');
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
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
        return view('siswa.edit',compact('siswa','kelas'));
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
            'nama_siswa' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'nis_siswa' => 'required',
            'tmpt_lahir_siswa' => 'required',
            'tgl_lahir_siswa' => 'required',
            'jenis_kelamin' => 'required',
            'no_ortu' => 'required',
        ]);

        $siswa = Siswa::find($id);
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->nis_siswa = $request->nis_siswa;
        if ($request->hasfile('foto_siswa')) {
            $foto = 'uploads/siswa/' .$siswa->foto_siswa;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
            $file = $request->file('foto_siswa');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/siswa/' ,$filename);
            $siswa->foto_siswa = $filename;
        }
        $siswa->tmpt_lahir_siswa = $request->tmpt_lahir_siswa;
        $siswa->tgl_lahir_siswa = $request->tgl_lahir_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->no_ortu = $request->no_ortu;
        $siswa->save();
        return to_route('siswa.index')->with('success','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if ($siswa){
            $foto = 'uploads/siswa/' .$siswa->foto_siswa;
            if(File::exists($foto))
            {
                File::delete($foto);
            }
        $siswa->delete();
        return response()->json(['status' => 'Data Berhasil Dihapus']);
        }else {
            return response()->json(['status' => 'Data Tidak Ditemukan'], 404);
        }
    }

    public function importExcel(Request $request){
        Excel::import(new SiswaImport, $request->file('file')->store('files'));
        return redirect()->back()->with('success','Berhasil Mengimport Data');
    }

    public function cetaksiswa(Request $request, $kelas_id =  null){
        $query= Siswa::orderBy('nama_siswa','ASC');

        if($kelas_id){
            $query->where('kelas_id',$kelas_id);
        }
        $siswa = $query->get();
        $pdf = PDF::loadView('siswa.cetaksiswa', ['siswa' => $siswa]);
        return $pdf->stream('Laporan-Daftar-Siswa.pdf');
    }

    public function uploadFoto(Request $request, $id)
    {
        $request->validate([
            'foto_siswa' => 'required|file'
        ]);

        $siswa = Siswa::find($id);
        if ($request->hasFile('foto_siswa')) {
            $image = $request->file('foto_siswa');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/siswa');
            $image->move($destinationPath, $name);
            if ($siswa->foto_siswa && file_exists(public_path('uploads/siswa/' . $siswa->foto_siswa))) {
                unlink(public_path('uploads/siswa/' . $siswa->foto_siswa));
            }
            $siswa->foto_siswa = $name;
            $siswa->save();
            return back();
        }
    }
    public function filter(Request $request){
        
        $kelas_id = $request->get('kelas_id');
    
        $kelas = Kelas::all();
        
        $query = Siswa::query();
        
        if ($kelas_id) {
            $query->where('kelas_id', $kelas_id);
        }
        
        $siswa = $query->get();
        
        return view('siswa.index', compact('siswa', 'kelas', 'kelas_id'));
    }
    public function search(Request $request){
        
    }
}
