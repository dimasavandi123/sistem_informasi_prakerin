<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absenSiswa extends Model
{
    use HasFactory;

    protected $table = 'absen_siswa';
    protected $guarded = ['id'];
    protected $fillable = ['user_id', 'status', 'keterangan', 'foto_kegiatan', 'catatan_kegiatan', 'waktu_absen','kelas_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
