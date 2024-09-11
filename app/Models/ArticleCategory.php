<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasFactory;
    //Disable timestamps.
    public $timestamps = false;
    protected $table = "article_category";
    protected $fillable = ['article_id', 'category_id'];
    public function article(){
        return $this->belongsToMany(Article::class);
    }
}
