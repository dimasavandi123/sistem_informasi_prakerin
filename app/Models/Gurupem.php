<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurupem extends Model
{
    use HasFactory;
    protected $table ='gurupem';
    protected $guarded = ['id'];
    protected $fillable = ['gurumapel_id','siswa_id','kelas_id','nis_siswa'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function gurumapel()
    {
        return $this->belongsTo(Gurumapel::class, 'gurumapel_id');
    }
    
}
