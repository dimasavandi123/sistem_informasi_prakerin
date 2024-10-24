<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    protected $guarded = ['id'];
    protected $fillable = ['judul_berita','cover_berita','gambar_berita','artikel_berita','views'];
}
