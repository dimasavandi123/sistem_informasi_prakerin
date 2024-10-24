<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\Jawaban;
use PDF;
use App\Models\Gurumapel;
use App\Models\jawabanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class jawabanSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
{
    $request->validate([
        'jawaban' => 'required|array',
        'jawaban.*' => 'required|string',
        'kelas_id' => 'required|exists:kelas,id',
    ], [
        'jawaban.required' => 'Semua soal wajib diisi.',
        'jawaban.*.required' => 'Jawaban untuk setiap soal tidak boleh kosong.',
        'kelas_id.required' => 'Pilihlah kelas terlebih dahulu.',
    ]);

    $tugas = Tugas::with('kolomTugas')->findOrFail($id);

    foreach ($tugas->kolomTugas as $kolom) {
        if (isset($request->input('jawaban')[$kolom->id])) {
            jawabanSiswa::updateOrCreate(
                [
                    'tugas_id' => $tugas->id,
                    'kolom_tugas_id' => $kolom->id,
                    'users_id' => auth()->user()->id,  // Pastikan menggunakan 'users_id'
                ],
                [
                    'kelas_id' => $request->kelas_id,
                    'jawaban' => $request->input('jawaban')[$kolom->id],
                ]
            );
        }
    }

    return to_route('dikerjakan')->with('success', 'Jawaban berhasil disimpan');
}


    
public function cetakJawaban($id)
{
    $user_id = Auth::id();
    
    // Ambil data jawaban siswa yang sudah dikerjakan untuk tugas dengan $id
    $jawabanSiswa = jawabanSiswa::where('users_id', $user_id)
        ->where('tugas_id', $id)
        ->with('tugas.kolomTugas', 'kelas')
        ->first(); // Mengambil data jawaban pertama yang cocok

    // Cek apakah jawabanSiswa ada
    if (!$jawabanSiswa) {
        return redirect()->back()->withErrors('Jawaban tidak ditemukan untuk tugas ini.');
    }

    // Kirim data ke view untuk membuat PDF
    $pdf = PDF::loadView('tugas.cetakJawaban', compact('jawabanSiswa'));

    // Menampilkan file PDF di tab baru
    return $pdf->stream('jawaban_siswa.pdf');
}




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tugas = Tugas::with('kolomTugas')->findOrFail($id);
        $user_id = Auth::id();
        
        // Mengambil jawaban siswa dengan kelas
        $jawabanSiswa = jawabanSiswa::where('tugas_id', $id)
                          ->where('users_id', $user_id)
                          ->with('kelas') // Memastikan kelas ikut di-load
                          ->get();
    
        return view('tugas.answer', compact('tugas', 'jawabanSiswa'));
    }
    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function showAnswer($id, Request $request)
    {
        // Ambil data filter kelas dari query string
        $kelasFilter = $request->input('kelas');
    
        // Ambil semua kelas untuk dropdown filter
        $kelas = Kelas::all();
        $gurumapel = Gurumapel::all();
        $tugas = Tugas::with('kolomTugas')->findOrFail($id);
    
        // Ambil data jawaban siswa, filter jika kelas dipilih
        $jawabanSiswa = jawabanSiswa::where('tugas_id', $id)
            ->when($kelasFilter, function($query, $kelasFilter) {
                return $query->where('kelas_id', $kelasFilter);
            })
            ->with('kelas') // Memastikan kelas ikut di-load
            ->get();
    
        return view('tugas.showTb', compact('gurumapel', 'tugas', 'kelas', 'jawabanSiswa', 'kelasFilter'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
