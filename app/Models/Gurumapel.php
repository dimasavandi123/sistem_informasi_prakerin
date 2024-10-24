<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurumapel extends Model
{
    use HasFactory;
    protected $table = 'gurumapel';
    protected $guarded = ['id'];
    protected $fillable = ['nama_guru_mapel','nip_guru','nama_mapel'];  
    
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'gurumapel_id','id');
    }
    public function gurupem()
    {
        return $this->hasMany(Gurupem::class, 'gurumapel_id','id');
    }
    public function prakerin()
    {
        return $this->hasMany(Prakerin::class, 'gurumapel_id','id');
    }
    public function siswa()
{
    return $this->hasMany(Siswa::class, 'gurumapel_id');
}

}
