<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prakerin extends Model
{
    use HasFactory;
    
    protected $table = 'prakerin';
    protected $guarded = ['id'];
    protected $fillable = ['kelas_id','siswa_id','gurumapel_id','tempatPrakerin_id','nis_siswa','nama_pimpinan','alamat_dudi'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function tempatPrakerin()
    {
        return $this->belongsTo(TempatPrakerin::class,'tempatPrakerin_id');
    }
    public function gurupem()
    {
        return $this->belongsTo(Gurupem::class, 'gurupem_id');
    }
    public function Instruktur()
    {
        return $this->hasMany(Instruktur::class, 'prakerin_id','id');
    }
    public function gurumapel()
    {
        return $this->belongsTo(Gurumapel::class, 'gurumapel_id');
    }
}
