<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $table = 'jawaban';
    protected $guarded = ['id'];

    protected $fillable = ['jawaban','status','kelas_id','users_id','tugas_id'];

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'jawaban_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }
    



}
