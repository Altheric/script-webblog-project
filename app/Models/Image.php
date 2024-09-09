<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    //Disable timestamps.
    public $timestamps = false;
    protected $fillable = ['image_path', 'image_alt', 'image_subtitle', 'article_id'];
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
