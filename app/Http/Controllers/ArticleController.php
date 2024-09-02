<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
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
    public function article(Article $article){
        //Check if the article and user are premium.
        if($article->premium_article == true && Session::get('premium') == true){        
            return view('articles.article', compact('article'));
        } else if($article->premium_article == false) {
            return view('articles.article', compact('article'));
        } else {
            return redirect()->route('articles.index'); 
        }
    }

    //Point tot the edit page for the specified Article
    public function edit(Article $article){
        //Grab all the categories for assignment
        $articleCategories = ArticleCategory::where('article_id', $article->id)->distinct()->get();
        $categories = Category::all();
        return view('articles.edit', compact('article', 'articleCategories', 'categories'));
    }
    //Update the article in the form and the selected categories.
    public function update(UpdateArticleRequest $request, Article $article){
        $validated = $request->validated();

        $article->update($validated);

        //Grab all the categories for assignment
        $articleCategories = ArticleCategory::where('article_id', $article->id)->distinct()->get();

        $articleCategories->update($validated);
        return redirect()->route('users.index'); 
    }
    //Destroy function to delete the article.
    public function destroy(Article $article){
        $article->delete();
        return redirect()->route('users.index');
    }
    //Points to a confirmation page for the specified action
    public function confirm(Article $article, string $action){
        $validAction = htmlspecialchars($action);
        //Check if the user id is the same as the author session id
        if($article->user->id == Session::get('user_id')){
            if ($validAction == 'del'){
                return view('articles.confirm', compact('article', 'validAction'));
            } else {
                return redirect()->route('users.index');
            } 
        } else {
            return redirect()->route('users.index');
        }
    }
    //Change the article's premium status depending on the boolean given in the array.
    public function exclusivity(Article $article, bool $action){
        $validAction = filter_var($action, FILTER_VALIDATE_BOOL);
        //Check if the user id is the same as the author session id
        if($article->user->id == Session::get('user_id')){
            if($validAction == true){
                $article->update(['premium_article' =>true]);
            } else {
                $article->update(['premium_article' =>false]);
            }
            return redirect()->route('users.index');
        } else {
            return redirect()->route('users.index');
        }
    }
}
