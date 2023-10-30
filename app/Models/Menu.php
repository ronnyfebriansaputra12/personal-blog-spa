<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded=[];


    function groupMenu() {
        return $this->belongsTo(GroupMenu::class,'group_id','id');
    }
}
