<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id_like';
    // protected $fillable = ['name'];
   

    // public function articles()
    // {
    //     return $this->belongsToMany(Articles::class, 'id');
    // }

}
