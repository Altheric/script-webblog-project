<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    //Disable timestamps.
    public $timestamps = false;
    protected $fillable = ['category_name'];
    public function articleCategory(){
        return $this->hasMany(ArticleCategory::class);
    }
}
