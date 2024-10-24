<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use PDF;
use App\Models\Gurumapel;
use App\Models\kolomTugas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $gurumapel = Gurumapel::all();
    $tugas = Tugas::orderBy('id', 'DESC')
        ->with(['kolomTugas', 'jawabanSiswa'])
        ->get()
        ->filter(function ($tugas) {
            // Menampilkan tugas yang belum dikerjakan oleh pengguna saat ini
            return $tugas->jawabanSiswa->where('users_id', Auth::id())->isEmpty();
        });
        foreach ($tugas as $tgs) {
            if ($tgs->isExpired()) {
                $tgs->status = false;
                $tgs->save();
            }
        }

    return view('tugas.index', compact('gurumapel', 'tugas'));
}

public function index2()
{
    $gurumapel = Gurumapel::all();
    $tugas = Tugas::orderBy('id', 'DESC')
        ->with(['kolomTugas', 'jawabanSiswa'])
        ->get()
        ->filter(function ($tugas) {
            // Ambil jawaban siswa yang sesuai dengan pengguna saat ini
            $jawabanSiswa = $tugas->jawabanSiswa->where('users_id', Auth::id());

            // Menampilkan tugas yang sudah dikerjakan oleh pengguna saat ini
            return $jawabanSiswa->isNotEmpty();
        })->map(function ($tugas) {
            // Mengambil jawaban siswa yang pertama kali dibuat oleh pengguna saat ini
            $jawabanSiswa = $tugas->jawabanSiswa->where('users_id', Auth::id())->first();

            // Menambahkan 'created_at' dari jawaban siswa ke data tugas
            $tugas->jawaban_siswa_created_at = $jawabanSiswa ? $jawabanSiswa->created_at : null;

            return $tugas;
        });

    return view('tugas.index2', compact('gurumapel', 'tugas'));
}



    public function tb(Request $request){
    
        $gurumapel_id = $request->get('gurumapel_id');
    
        $gurumapel = Gurumapel::all();
        
        $query = Tugas::orderBy('id', 'DESC');
        
        if ($gurumapel_id) {
            $query->where('gurumapel_id', $gurumapel_id);
            $tugas = $query->get();
        }else{

            $tugas = $query->paginate(10);
        }
        return view('tugas.tb', compact('gurumapel','tugas','gurumapel_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurumapel = Gurumapel::all();
        return view('tugas.create',compact('gurumapel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_tugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gurumapel_id' => 'required|exists:gurumapel,id',
            'deadline' => 'required|date',
        ]);
    
        // Dapatkan tugas terakhir berdasarkan mapel yang dipilih
        $lastTugas = Tugas::where('gurumapel_id', $request->gurumapel_id)
                        ->orderBy('tugas_ke', 'desc')
                        ->first();
    
        // Tentukan nilai tugas_ke yang baru
        $tugasKeBaru = $lastTugas ? $lastTugas->tugas_ke + 1 : 1;
    
        // Simpan tugas baru
        $tugas = Tugas::create([
            'nama_tugas' => $request->nama_tugas,
            'deskripsi' => $request->deskripsi,
            'gurumapel_id' => $request->gurumapel_id,
            'deadline' => $request->deadline,
            'tugas_ke' => $tugasKeBaru,
        ]);
    
        // Tambahkan kolom tugas baru
        foreach ($request->input('kolom_nama') as $index => $kolomNama) {
            KolomTugas::create([
                'tugas_id' => $tugas->id,  // Pastikan kolom tugas terhubung ke tugas ini
                'kolom_nama' => $kolomNama,  // Isi nama kolom
       
            ]);
        }
    
        return redirect()->route('tb-tugas')->with('success', 'Tugas berhasil dibuat!');
    }
    
    

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::all();
        $gurumapel = Gurumapel::all();
        $tugas = Tugas::find($id);
        if ($tugas->isExpired()) {
            $tugas->status = false;
            $tugas->save();
        }
        return view('tugas.show', compact('gurumapel','tugas','kelas'));
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
        $tugas = Tugas::find($id);
        return view('tugas.edit',compact('tugas','gurumapel'));
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
    // Validasi input
    $request->validate([
        'nama_tugas' => 'required',
        'gurumapel_id' => 'required',
        'deskripsi' => 'nullable|string',
        'kolom_nama' => 'required|array',
        'kolom_tipe' => 'required|array',
        'kolom_nama.*' => 'required|string',
        'kolom_tipe.*' => 'required|string',
        'deadline' => 'required',
        'tugas_ke' => 'required',
    ]);

    // Cari tugas berdasarkan ID
    $tugas = Tugas::findOrFail($id);

    // Update data tugas
    $tugas->nama_tugas = $request->nama_tugas;
    $tugas->gurumapel_id = $request->gurumapel_id;
    $tugas->deskripsi = $request->deskripsi;
    $tugas->deadline = $request->deadline;
    $tugas->tugas_ke = $request->tugas_ke;
    if ($tugas->isExpired()) {
        $tugas->status = false; // Set status sebagai tidak dapat dikerjakan
    } else {
        $tugas->status = true;
    }
    $tugas->save();

    // Hapus kolom tugas lama yang terhubung dengan tugas ini
    $tugas->kolomTugas()->delete();

    // Tambahkan kolom tugas baru
    foreach ($request->input('kolom_nama') as $index => $kolomNama) {
        kolomTugas::create([
            'tugas_id' => $tugas->id,  // Pastikan kolom tugas terhubung ke tugas ini
            'kolom_nama' => $kolomNama,  // Isi nama kolom
           // Isi tipe kolom
        ]);
    }

    // Redirect ke route 'tb-tugas' dengan pesan sukses
    return redirect()->route('tb-tugas')->with('success', 'Tugas berhasil diupdate');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tugas = Tugas::find($id);
        if($tugas){
            $tugas->delete();
            return response()->json(['success' => 'Data Berhasil Dihapus']);
        }else{
            return response()->json(['error' => 'Data Tidak Ditemukan'],404);
        }
    }

   
}
