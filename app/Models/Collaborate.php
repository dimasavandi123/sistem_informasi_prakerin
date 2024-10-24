<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaborate extends Model
{
    use HasFactory;
    protected $table = 'collaborate';
    protected $guarded = ['id'];
    protected $fillable = ['nama_industri','logo_industri','jurusan_sekolah'];
}
