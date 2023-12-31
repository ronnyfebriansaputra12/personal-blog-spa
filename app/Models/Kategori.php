<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey = 'kategori_id';
    protected $guarded=[];

    function kategori() {
        return $this->hasMany(Post::class,'kategori_id','id');
    }
}
