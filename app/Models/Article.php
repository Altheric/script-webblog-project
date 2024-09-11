<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'premium_article', 'user_id'];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function image(){
        return $this->hasOne(Image::class);
    }
}
