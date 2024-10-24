<?php

namespace App\Http\Controllers;
use PDF; 
use App\Models\User;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Jawaban;
use App\Models\jawabanSiswa;
use Illuminate\Http\Request;

class nilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kelasId = $request->input('kelas_id');

        $jawabanSiswaQuery = jawabanSiswa::with(['users', 'kelas', 'nilai', 'tugas']);
    
        if ($kelasId) {
            $jawabanSiswaQuery->whereHas('kelas', function($query) use ($kelasId) {
                $query->where('id', $kelasId);
            });
        }
    
        $jawabanSiswa = $jawabanSiswaQuery->get();
    
        // Mengelompokkan nilai berdasarkan gurumapel dan menghitung rata-rata per mapel
        $nilaiRataRataMapel = $jawabanSiswa->groupBy('tugas.gurumapel_id')->map(function ($group) {
            $totalNilai = $group->flatMap(function ($jawabanSiswa) {
                return $jawabanSiswa->nilai->pluck('nilai');
            })->sum();
            
            $jumlahNilai = $group->flatMap(function ($jawabanSiswa) {
                return $jawabanSiswa->nilai->pluck('nilai');
            })->count();
            
            return $jumlahNilai ? $totalNilai / $jumlahNilai : 0;
        });
    
        // Menghitung rata-rata per siswa berdasarkan rata-rata per mapel
        $nilaiRataRata = $jawabanSiswa->groupBy('users.id')->map(function ($group) use ($nilaiRataRataMapel) {
            $totalNilaiPerMapel = $group->groupBy('tugas.gurumapel_id')->map(function ($mapelGroup) {
                $totalNilai = $mapelGroup->flatMap(function ($jawabanSiswa) {
                    return $jawabanSiswa->nilai->pluck('nilai');
                })->sum();
                
                $jumlahNilai = $mapelGroup->flatMap(function ($jawabanSiswa) {
                    return $jawabanSiswa->nilai->pluck('nilai');
                })->count();
                
                return $jumlahNilai ? $totalNilai / $jumlahNilai : 0;
            });
    
            $jumlahMapel = $totalNilaiPerMapel->count();
            $rataRata = $jumlahMapel ? $totalNilaiPerMapel->sum() / $jumlahMapel : 0;
    
            return [
                'username' => $group->first()->users->username ?? 'N/A',
                'kelas' => $group->first()->kelas->kelas_jurusan_siswa ?? 'N/A',
                'rata_rata' => $rataRata,
                'user_id' => $group->first()->users->id ?? null,
            ];
        });
    
        $kelas = Kelas::all();
    
        return view('nilai.index', [
            'nilaiRataRata' => $nilaiRataRata,
            'kelas' => $kelas,
            'kelasId' => $kelasId // Pastikan variabel ini diteruskan ke tampilan
        ]);


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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jawaban_siswa_id' => 'required|exists:jawaban_siswa,id',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        Nilai::create([
            'jawaban_siswa_id' => $validated['jawaban_siswa_id'],
            'nilai' => $validated['nilai'],
        ]);

        return redirect()->back()->with('success', 'Nilai berhasil ditambahkan');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        $nilaiLengkap = jawabanSiswa::with(['users', 'kelas', 'nilai', 'tugas'])
            ->where('users_id', $userId)
            ->get();
    
        if ($nilaiLengkap->isEmpty()) {
            return redirect()->route('nilai.index')->with('error', 'Data tidak ditemukan.');
        }
    
        // Mengelompokkan nilai berdasarkan Gurumapel
        $nilaiRataRataMapel = $nilaiLengkap->groupBy('tugas.gurumapel_id')->map(function ($group) {
            // Mengambil nilai dari setiap jawaban dan menghitung rata-ratanya
            $totalNilai = $group->flatMap(function ($jawabanSiswa) {
                return $jawabanSiswa->nilai->pluck('nilai');
            })->sum();
    
            $jumlahNilai = $group->flatMap(function ($jawabanSiswa) {
                return $jawabanSiswa->nilai->pluck('nilai');
            })->count();
    
            return $jumlahNilai ? $totalNilai / $jumlahNilai : 0;
        });
    
        return view('nilai.show', compact('nilaiLengkap', 'nilaiRataRataMapel'));
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


    public function cetakNilai($userId)
    {
        $user = User::findOrFail($userId);

        // Ambil data nilai lengkap
        $nilaiLengkap = jawabanSiswa::where('users_id', $userId)
            ->with('nilai', 'tugas', 'kelas') // Sertakan relasi kelas
            ->get();
        
        // Mengelompokkan nilai berdasarkan Gurumapel
        $nilaiRataRataMapel = $nilaiLengkap->groupBy('tugas.gurumapel_id')->map(function ($group) {
            $totalNilai = $group->flatMap(function ($jawabanSiswa) {
                return $jawabanSiswa->nilai->pluck('nilai');
            })->sum();
            
            $jumlahNilai = $group->flatMap(function ($jawabanSiswa) {
                return $jawabanSiswa->nilai->pluck('nilai');
            })->count();
            
            return $jumlahNilai ? $totalNilai / $jumlahNilai : 0;
        });
    
        // Hitung rata-rata semua mata pelajaran
        $rataRataKeseluruhan = $nilaiRataRataMapel->values()->avg();
        
        // Buat PDF menggunakan tampilan Blade
        $pdf = PDF::loadView('nilai.cetaknilai', [
            'user' => $user,
            'nilaiLengkap' => $nilaiLengkap, // Pastikan ini juga dikirim
            'nilaiRataRataMapel' => $nilaiRataRataMapel,
            'rataRataKeseluruhan' => $rataRataKeseluruhan,
        ]);
    
        return $pdf->stream('Rapor-Nilai-' . $user->username . '.pdf');
    }
}
