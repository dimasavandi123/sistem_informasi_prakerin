<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Banner;
use App\Models\Berita;
use App\Models\Galery;
use App\Models\Gurupem;
use App\Models\Tentang;
use App\Models\Prakerin;
use App\Models\Visimisi;
use App\Models\Gurumapel;
use App\Models\Collaborate;
use Illuminate\Http\Request;
use App\Models\tempatPrakerin;

class frontendController extends Controller
{
    public function index(){
        $tentang = Tentang::all();
        $banner = Banner::all();
        $collaborate = Collaborate::all();
        $visimisi = Visimisi::all();
        // Mengurutkan berita berdasarkan tanggal terbaru
        $berita = Berita::orderBy('created_at', 'desc')->paginate(4);
        return view('frontend.index', compact('banner', 'tentang', 'berita','collaborate','visimisi'));
    }
    
    public function berita(){
        $banner = Banner::all();
        // Mengurutkan berita berdasarkan tanggal terbaru
        $berita = Berita::orderBy('created_at', 'desc')->paginate(12);
        return view('frontend.berita', compact('banner', 'berita'));
    }

    public function showBerita($id){
        $banner = Banner::all();
        $berita = Berita::find($id);
        $berita->increment('views');
    
        // Mengambil 5 berita terbaru kecuali berita yang sedang dibuka
        $berita_terbaru = Berita::where('id', '!=', $id)
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();
    
        return view('frontend.showBerita', compact('banner', 'berita', 'berita_terbaru'));
    }
    
    
    public function galeri(){
        $galery = Galery::paginate(12);
        $banner = Banner::all();
        return view('frontend.galeri',compact('banner','galery'));
    }
    public function kerjasama(){
        $banner = Banner::all();
        $collaborate = Collaborate::all();
        return view ('frontend.kerjasama',compact('banner','collaborate'));
    }
    public function tentang(){
        $banner = Banner::all();
        return view('frontend.tentang',compact('banner'));
    }

    public function halamanvisimisi(){
        $banner = Banner::all();
        return view('frontend.halaman-visimisi',compact('banner'));
    }

    public function listSiswa(){
        $banner = Banner::all();
        $siswa = Siswa::all();
        $Gurupem = Gurupem::all();
        $gurumapel = Gurumapel::all();
        $kelas = Kelas::all();
        $tempatPrakerin = tempatPrakerin::all();
        $prakerin = Prakerin::all();
        return view('frontend.listSiswa',compact('banner','prakerin','siswa','Gurupem','kelas','tempatPrakerin','gurumapel'));
    }
}
