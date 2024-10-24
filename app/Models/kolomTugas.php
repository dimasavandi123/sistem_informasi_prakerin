<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kolomTugas extends Model
{
    use HasFactory;
    protected $table = 'kolom_tugas';
    protected $guarded = ['id'];
    protected $fillable = [
        'tugas_id',
        'kolom_nama',
        'kolom_tipe',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
    public function jawabanSiswa()
    {
        return $this->hasMany(jawabanSiswa::class, 'kolom_tugas_id');
    }
}
