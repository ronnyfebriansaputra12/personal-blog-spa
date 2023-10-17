<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey = 'post_id';
    protected $guarded=[];

    function kategori() {
        return $this->hasOne(Kategori::class,'kategori_id','id');
    }

    function user() {
        return $this->hasMany(User::class, 'user_id','id');
    }
}
