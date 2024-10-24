<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table ='siswa';
    protected $guarded = ['id'];
    protected $fillable = ['nama_siswa','kelas_siswa','nis_siswa','foto_siswa','tmpt_lahir_siswa','tgl_lahir_siswa','jenis_kelamin','no_ortu','kelas_id',];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    
    public function Gurupem()
    {
        
        return $this->hasMany(Gurupem::class, 'siswa_id','id');
    }
    public function prakerin()
    {
        return $this->hasMany(Prakerin::class, 'siswa_id','id');
    }
    public function Instruktur()
    {
        return $this->hasMany(Instruktur::class, 'tempatPrakerin_id','id');
    }
    public function Nilai()
    {
        return $this->hasMany(NilaiT::class, 'siswa_id','id');
    }
    public function Jawaban()
    {
        return $this->hasMany(Jawaban::class, 'siswa_id','id');
    }
    public function gurumapel()
{
    return $this->belongsTo(GuruMapel::class, 'gurumapel_id');
}
}
