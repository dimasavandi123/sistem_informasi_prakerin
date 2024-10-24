<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Gurupem;
use App\Models\Prakerin;
use App\Models\Instruktur;
use Illuminate\Http\Request;
use App\Models\tempatPrakerin;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{

    public function index(){
        
        $kelasSiswa = Kelas::count();
        $jumlahSiswa = Siswa::count();
        $tempatPrakerin = tempatPrakerin::count();
        $gurupem = Gurupem::count();
        $instruktur = Instruktur::count();
        $prakerin = Prakerin::count();
        $user = User::all();
        return view('dashboard.index')->with([
            'jumlahSiswa' => $jumlahSiswa,
            'kelasSiswa' => $kelasSiswa,
            'tempatPrakerin' => $tempatPrakerin,
            'gurupem' => $gurupem,
            'prakerin' => $prakerin,
            'instruktur' => $instruktur,
            'user' => $user
        ]);
    }
    public function indexdua(){
        return view('admin.indexdua');
    }
    public function kelas(){
        
    }


    public function updateUser(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'current_password' => 'nullable|required_with:password|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048'
        ], [
            'current_password.required_with' => 'Password saat ini diperlukan jika Anda ingin mengubah password.',
            'current_password.string' => 'Password saat ini harus berupa string.',
            'current_password.min' => 'Password saat ini harus memiliki minimal 8 karakter.',
        ]);
    
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Periksa apakah password baru diinput
        if ($request->filled('password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            $user->password = Hash::make($request->input('password'));
        }
    
        // Update field lain
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
    
        // Update foto jika diupload
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/userProfil/'), $filename);
    
            // Hapus foto lama jika ada
            if ($user->foto_profil && file_exists(public_path('uploads/userProfil/' . $user->foto_profil))) {
                unlink(public_path('uploads/userProfil/' . $user->foto_profil));
            }
    
            // Simpan foto baru
            $user->foto_profil = $filename;
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
    
    




}
