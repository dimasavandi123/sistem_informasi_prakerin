<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun-ajaran';
    protected $guarded = ['id'];
    protected $fillable = ['tahun_ajaran','semester'];
}
