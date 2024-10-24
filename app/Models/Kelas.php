<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $guarded = ['id'];
    protected $fillable = ['kelas_jurusan_siswa'];
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id','id');
    }
    public function gurupem()
    {
        return $this->hasMany(Gurupem::class, 'kelas_id','id');
    }
    public function prakerin()
    {
        return $this->hasMany(Prakerin::class, 'kelas_id','id');
    }
    public function instruktur()
    {
        return $this->hasMany(Instruktur::class, 'instruktur_id','id');
    }
 
    public function jawabanSiswa()
    {
        return $this->hasMany(jawabanSiswa::class, 'kelas_id','id');
    }
    public function nilai()
    {
        return $this->hasMany(NilaiT::class, 'kelas_id','id');
    }
    public function absenSiswa()
    {
        return $this->hasMany(absenSiswa::class, 'kelas_id','id');
    }
}
