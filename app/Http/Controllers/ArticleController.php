<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;

class ArticleController extends Controller
{
    //Show the index of Articles
    public function index(int $filterParam = null) {
        //Prepare the articles table with it's user relation.
        $articles = Article::with('user');
        //Check if filterParam is not null.
        if($filterParam != null){
            //Inner join on article_categories and select all articles with the relevant category_id
            $articles = $articles->join('article_categories', 'articles.id','=','article_categories.article_id')
            ->where('category_id', $filterParam);
        }
        //Now run the query and sort it.
        $articles = $articles->get()->sortBy('created_at');
        $categories = Category::all();
        return view('articles.index', compact('articles', 'categories'));
    }

    //Filter the index on the given ID
    public function filter(){
        //Validate the filterParam, then give it to the Index
        $filterParam = filter_var($_GET['category'], FILTER_VALIDATE_INT);
        //Check if the filter is not null and respond properly.
        if($filterParam != null){
            return $this->index($filterParam);
        } else {
            return redirect()->route('articles.index');
        }
    }

    //Show a specific article
    public function article(string $id){
        $validID = filter_var($id, FILTER_VALIDATE_INT);
        //Get the specific id given with the href, then show the first hit.
        $article = Article::with('user')->where('id', $validID)->first();
        //Check if article is not null and respond properly.
        if($article != null){
            return view('articles.article', compact('article'));
        } else {
            return redirect()->route('articles.index');
        }
    }
}
