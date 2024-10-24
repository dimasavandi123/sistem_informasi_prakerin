<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswaUser extends Model
{
    use HasFactory;
    protected $table = 'siswaUser';
    protected $guarded = ['id'];
    protected $fillable = ['name','username','email','role','status','password'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
