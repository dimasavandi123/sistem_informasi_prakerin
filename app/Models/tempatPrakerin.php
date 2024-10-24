<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempatPrakerin extends Model
{
    use HasFactory;

    protected $table = 'tempatPrakerin';
    protected $guarded = ['id'];
    protected $fillable = ['nama_dudi','nama_pimpinan','alamat_dudi','jmlh_kuota','kuota_terisi','sisa_kuota','jurusan'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->sisa_kuota = $model->jmlh_kuota - $model->kuota_terisi;
        });
    }
    public function Prakerin()
    {
        return $this->hasMany(Prakerin::class, 'tempatPrakerin_id','id');
    }
  
}
