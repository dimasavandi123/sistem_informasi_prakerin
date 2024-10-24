<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $guarded = ['id'];
    protected $fillable = ['jawaban_siswa_id','nilai'];

    public function jawabanSiswa()
    {
        return $this->belongsTo(jawabanSiswa::class);
    }
}
