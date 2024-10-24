<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    
    protected $table = 'banner';
    protected $guarded = ['id'];
    protected $fillable = ['gambar_banner','judul_banner1','judul_banner2','judul_banner3'];
}
