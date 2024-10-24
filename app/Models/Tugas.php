<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $guarded = ['id'];
    protected $fillable = ['nama_tugas','deskripsi','gurumapel_id','status','deadline','tugas_ke'];



    public function gurumapel()
    {
        return $this->belongsTo(Gurumapel::class, 'gurumapel_id');
    }
    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'tugas_id','id');
    }
    public function Nilai()
    {
        return $this->hasMany(NilaiT::class, 'tugas_id','id');
    }
    public function kolomTugas()
    {
        return $this->hasMany(kolomTugas::class);
    }
    public function jawabanSiswa()
    {
        return $this->hasMany(jawabanSiswa::class,);
    }
    public function isExpired()
    {
        return $this->deadline && now()->greaterThan($this->deadline);
    }
}
