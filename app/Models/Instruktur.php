<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    use HasFactory;
    protected $table = 'instruktur';
    protected $guarded = ['id'];
    protected $fillable =['nama_instruktur','prakerin_id','siswa_id','kelas_id'];

    public function Prakerin()
    {
        return $this->belongsTo(Prakerin::class, 'prakerin_id');
    }

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

}
