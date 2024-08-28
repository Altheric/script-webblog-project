<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    //Show the index of Articles
    public function index() {
        $articles = Article::with(['user', 'image'])->get();
        //Sort by date created
        $articles = $articles->sortBy('created_at');
        return view('articles.index', compact('articles'));
    }
}
