<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kelas;
use PDF;
use App\Models\absenSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class absenSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang login
        $kelas = Kelas::all();
        $sudahAbsen = absenSiswa::where('users_id', $userId)
            ->whereDate('waktu_absen', Carbon::today())
            ->exists();
    
        // Query untuk riwayat absensi
        $riwayat = absenSiswa::with('kelas');
    
        // Jika admin atau guru, ambil semua riwayat
        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            // Filter berdasarkan kelas jika dipilih
            if ($request->filled('kelas_id')) {
                $riwayat->where('kelas_id', $request->kelas_id);
            }
    
            // Filter berdasarkan tanggal jika dipilih, default ke hari ini
            $tanggalAbsen = $request->input('tanggal_absen', Carbon::today()->format('Y-m-d'));
            $riwayat->whereDate('waktu_absen', $tanggalAbsen);
        } else {
            // Siswa hanya bisa melihat riwayat mereka sendiri
            $riwayat->where('users_id', $userId);
            
            // Filter berdasarkan kelas jika dipilih
            if ($request->filled('kelas_id')) {
                $riwayat->where('kelas_id', $request->kelas_id);
            }
    
            // Filter berdasarkan tanggal jika dipilih, default ke hari ini
            $tanggalAbsen = $request->input('tanggal_absen', Carbon::today()->format('Y-m-d'));
            $riwayat->whereDate('waktu_absen', $tanggalAbsen);
        }
    
        // Ambil data riwayat absensi
        $riwayat = $riwayat->get();
    
        return view('absen-siswa.index', compact('riwayat', 'sudahAbsen', 'kelas'));
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
        $userId = Auth::id();

        $request->validate([
            'status' => 'required',
            'keterangan' => 'required',
            'foto_kegiatan' => 'required|file',
            'catatan_kegiatan' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $absenSiswa = new absenSiswa;
        $absenSiswa->users_id = $userId;
        $absenSiswa->status = $request->status;
        $absenSiswa->keterangan = $request->keterangan;

        if ($request->hasfile('foto_kegiatan')) {
            $file = $request->file('foto_kegiatan');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'. $extension;
            $file->move('uploads/absen-siswa/' ,$filename);
            $absenSiswa->foto_kegiatan = $filename;
        }

        $absenSiswa->catatan_kegiatan = $request->catatan_kegiatan;
        $absenSiswa->kelas_id = $request->kelas_id;
        $absenSiswa->waktu_absen = Carbon::now(); 
        $absenSiswa->save();

        return redirect()->route('absen-siswa.index')->with('success','Berhasil Absen');
    }


    public function rekapPDF(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();
    
        // Ambil absensi siswa berdasarkan users_id yang sedang login
        $absensi = absenSiswa::where('users_id', $user->id)->get();
    
        // Hitung jumlah berdasarkan status
        $jumlahMasuk = $absensi->where('status', 'Masuk')->count();
        $jumlahTelat = $absensi->where('status', 'Telat')->count();
        $jumlahIzin = $absensi->where('status', 'Izin')->count();
    
        // Menggunakan dompdf untuk memuat view dan mengirimkan data absensi serta ringkasan kehadiran
        $pdf = PDF::loadView('absen-siswa.rekap_pdf', [
            'absensi' => $absensi,
            'jumlahMasuk' => $jumlahMasuk,
            'jumlahTelat' => $jumlahTelat,
            'jumlahIzin' => $jumlahIzin
        ]);
    
        // Mengembalikan file PDF yang bisa diunduh atau ditampilkan
        return $pdf->stream();
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
}
