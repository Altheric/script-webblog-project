<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //Show the index of Articles
    public function index() {
        return view('articles.index');
    }
}
