<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    //Show the index of Articles
    public function index(int $filterParam = null) {
        //Prepare the articles table with it's user relation.
        $statement = Article::with('user');
        //Check if filterParam is not null.
        if($filterParam != null){
            //Inner join on article_categories and select all articles with the relevant category_id
            $statement = $statement->join('article_categories', 'articles.id','=','article_categories.article_id')->where('category_id', $filterParam);
        }
        if(Session::get('premium') == false){
            //If the user isn't premium, grab the articles that aren't premium as well.
            $statement = $statement->where('premium_article', 0);
        }
        //Now run the query and sort it. Distinct is added because the seeder likes to assign duplicate categories.
        $articles = $statement->distinct()->get()->sortBy('created_at');
        //Get all the categories
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

        //Check if article is not null.
        if($article != null){
            //Check if the article and user are premium.
            if($article->premium_article == true && Session::get('premium') == true){        
                return view('articles.article', compact('article'));
            } else if($article->premium_article == false) {
                return view('articles.article', compact('article'));
            }
        } else {
            return redirect()->route('articles.index');
        }
    }
}
