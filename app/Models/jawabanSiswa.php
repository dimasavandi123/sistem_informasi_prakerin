<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jawabanSiswa extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa';
    protected $guarded = ['id'];
    protected $fillable = [
        'tugas_id',

        'kelas_id',
        'kolom_tugas_id',
        'jawaban',
        'status',
        'users_id'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    public function kolomTugas()
    {
        return $this->belongsTo(KolomTugas::class, 'kolom_tugas_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'jawaban_siswa_id', 'id');
    }
}
