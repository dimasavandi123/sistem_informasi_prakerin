<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visimisi extends Model
{
    use HasFactory;
    protected $table = 'visimisi';
    protected $guarded = ['id'];
    protected $fillable = ['judul_visimisi','slogan_visimisi','deskripsi_visimisi'];
}
