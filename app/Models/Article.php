<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'id_category', 'slug', 'short_text', 'long_text'];
    

    public function category()
    {
        return $this->hasOne(Category::class, 'id_category', 'id_category');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'id_article', 'id');

    }
}
