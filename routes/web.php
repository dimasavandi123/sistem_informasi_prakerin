<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\nilaiController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\tugasController;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\beritaController;
use App\Http\Controllers\galeryController;
use App\Http\Controllers\nilaiTController;
use App\Http\Controllers\gurupemController;
use App\Http\Controllers\jawabanController;
use App\Http\Controllers\tentangController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\guruUserController;
use App\Http\Controllers\prakerinController;
use App\Http\Controllers\visimisiController;
use App\Http\Controllers\adminUserController;
use App\Http\Controllers\guruMapelController;
use App\Http\Controllers\siswaUserController;
use App\Http\Controllers\absenSiswaController;
use App\Http\Controllers\instrukturController;
use App\Http\Controllers\collaborateController;
use App\Http\Controllers\tahunAjaranController;
use App\Http\Controllers\jawabanSiswaController;
use App\Http\Controllers\tempatPrakerinController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// FRONTEND
Route::get('/', [frontendController::class,'index'])->name('index');
Route::get('/about', [frontendController::class, 'tentang'])->name('about');
Route::get('/berita-terbaru', [frontendController::class, 'berita'])->name('/berita-terbaru');
Route::get('/kerjasama', [frontendController::class, 'kerjasama'])->name('kerjasama');
Route::get('/galeri', [frontendController::class, 'galeri'])->name('galeri');
Route::get('/showBerita/{id}',[frontendController::class,'showBerita'])->name('showBerita');
Route::get('/halaman-visimisi',[frontendController::class,'halamanvisimisi'])->name('halaman-visimisi');
Route::get('/listSiswa',[frontendController::class,'listSiswa'])->name('listSiswa');

// LOGIN
Route::get('/login', [authController::class, 'index'])->name('login')->middleware('isTamu');
Route::post('/auth/login',[authController::class,'login'])->middleware('isTamu');
Route::get('/register',[authController::class,'register'])->middleware('isTamu');
Route::post('/auth/register',[authController::class,'create'])->middleware('isTamu');
Route::get('/logout',[authController::class,'logout']);
// ENDLOGIN

// MENU SISWA GURU ADMIN
Route::middleware(['auth', 'user-akses:0,1,2'])->group(function () {
    // DASHBOARD
    Route::get('/dashboard',[adminController::class,'index']);
    Route::put('/admin/updateUser/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');


     // TUGAS
     Route::resource('tugas', tugasController::class);
     Route::get('/dikerjakan', [tugasController::class,'index2'])->name('dikerjakan');
    
     // JAWABAN
     Route::post('/jawaban/store/{id}',[jawabanSiswaController::class,'store'])->name('jawaban.store');
     Route::get('/answer/{id}',[jawabanSiswaController::class,'show'])->name('answer');
     
    //  ABSEN SISWA
    Route::resource('absen-siswa',absenSiswaController::class);
    Route::get('/rekap-absen-pdf', [absenSiswaController::class, 'rekapPDF'])->name('rekap-absen-pdf');

    });
    Route::get('/pdf/jawaban/{id}', [jawabanSiswaController::class, 'cetakJawaban'])->name('pdfjawaban');


// MENU GURU ADMIN
Route::middleware(['auth', 'user-akses:0,1'])->group(function () {
    // SISWA
    Route::resource('siswa',siswaController::class);
    Route::get('/siswa.filter',[siswaController::class,'filter'])->name('siswa.filter');
    Route::post('/importExcel',[siswaController::class, 'importExcel'])->name('importExcel');
    Route::get('pdf/siswa/{kelas_id?}',[siswaController::class,'cetaksiswa'])->name('pdfsiswa');
    Route::post('/uploadFoto/{id}',[siswaController::class, 'uploadFoto'])->name('uploadFoto');

    // KELAS
    Route::resource('kelas',kelasController::class);
    Route::get('pdf/kelas',[kelasController::class,'cetakkelas'])->name('pdfkelas');
    // TEMPAT DUDI
    Route::resource('tempat-dudi',tempatPrakerinController::class);
    Route::get('pdf/tempatdudi',[tempatPrakerinController::class,'cetaktempat'])->name('pdftempatdudi');

    // GURU-PEMBIMBING
    Route::resource('guru-pembimbing',gurupemController::class);
    Route::post('/getSiswa',[gurupemController::class , 'getSiswa'])->name('getSiswa');
    Route::post('/getNis',[gurupemController::class , 'getNis'])->name('getNis');
    Route::get('pdf/gurupem',[gurupemController::class,'cetakpem'])->name('pdfgurupem');

    // PRAKERIN
    Route::resource('prakerin',prakerinController::class);
    Route::post('/getPimpinan',[prakerinController::class , 'getPimpinan'])->name('getPimpinan');
    Route::post('getSiswaGuru',[prakerinController::class,'getSiswaGuru'])->name('getSiswaGuru');
    Route::post('getDetailSiswa',[prakerinController::class,'getDetailSiswa'])->name('getDetailSiswa');
    Route::get('pdf/prakerin',[prakerinController::class,'cetakprakerin'])->name('pdfprakerin');
    Route::post('/importPrakerin',[prakerinController::class, 'importPrakerin'])->name('importPrakerin');
    Route::post('/search-siswa', [prakerinController::class, 'searchSiswa'])->name('searchSiswa');


    // INSTRUKTUR-DUDI
    Route::resource('instruktur-dudi', instrukturController::class);
    Route::post('getTempat',[instrukturController::class,'getTempat'])->name('getTempat');
    Route::post('getDetail',[instrukturController::class,'getDetail'])->name('getDetail');
    Route::get('pdf/instruktur',[instrukturController::class,'cetakins'])->name('pdfinstruktur');


    // USER
    // SISWA USER
    Route::resource('siswa-user', siswaUserController::class);
    Route::get('user/{id}', [siswaUserController::class, 'status']);
    // GURU USER
    Route::resource('guru-user', guruUserController::class);
    Route::get('user/{id}', [guruUserController::class, 'status']);
    // ADMIN USER
    Route::resource('admin-user', adminUserController::class);
    Route::get('user/{id}', [adminUserController::class, 'status']);

    // GURU MAPEL
    Route::resource('guru-mapel', guruMapelController::class);
    Route::get('pdf/mapel',[guruMapelController::class,'cetakmapel'])->name('pdfmapel');

    
    // TUGAS

    Route::get('/tb-tugas',[tugasController::class,'tb'])->name('tb-tugas');
    Route::get('/showAnswer/{id}',[jawabanSiswaController::class,'showAnswer'])->name('showAnswer');

    // BANNER

    Route::resource('banner',bannerController::class);

    // TENTANG

    Route::resource('tentang',tentangController::class);

    // BERITA
    Route::resource('berita',beritaController::class);

    // KERJA SANA
    Route::resource('collaborate',collaborateController::class);

    // GALERY

    Route::resource('galery',galeryController::class);

    // NILAI
    Route::post('/nilai/store', [nilaiController::class, 'store'])->name('nilai.store');
    Route::resource('nilai', NilaiController::class);
    Route::get('nilai/{userId}', [nilaiController::class, 'show'])->name('nilai.show');
    Route::get('nilai/cetak/{userId}', [NilaiController::class, 'cetakNilai'])->name('nilai.cetakNilai');



    // VISI MISI
    Route::resource('visimisi',visimisiController::class);

    // TAHUN AJARAN
    Route::resource('tahun-ajaran' , tahunAjaranController::class);
   
});











