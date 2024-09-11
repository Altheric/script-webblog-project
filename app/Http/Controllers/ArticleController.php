<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;

use Illuminate\Support\Facades\Auth;

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
        if(Auth::check()== null || Session::get('premium_user') == false){
            //If the user isn't premium or logged in, grab the articles that aren't premium as well.
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
        //Get all the comments of the article.
        $comments = Comment::with('user')->where('article_id', $article->id)->get();
        //Check if an image exists
        $image = $article->image != null ? $article::find($article->id)->image : null;
        //Check if the article and user are premium.
        if(Auth::check() != null && $article->premium_article == true && Session::get('premium_user') == true){        
            return view('articles.article', compact('article', 'comments', 'image'));
        } else if($article->premium_article == false) {
            return view('articles.article', compact('article', 'comments', 'image'));
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
        //Check if there was an image to update
        if(isset($validated['image_data'])){
            $newImage = $this->imageQuery($article, $validated['image_subtitle'], $request->file('image_data'));
            $image = Image::where('article_id', $article->id)->first();
            $image == null ? Image::create($newImage) : $image->update($newImage);
        }

        //Get the ArticleCategories again because for the life of me I can't pass them through the route.
        $articleCategories = ArticleCategory::where('article_id', $article->id)->distinct()->first();

        //Make an array of all the to be updated/inserted.
        $updateArray = $this->articleCategoryQuery($article, $validated['category']);
        $articleCategories::upsert($updateArray, uniqueBy: ['article_id'], update: ['category_id']);

        return redirect()->route('users.index');

    }


    //Function to point to the article creation page.
    public function create(){
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }


    //Function to store a newly created article
    public function store(StoreArticleRequest $request){
        $validated = $request->validated();
        
        //Create the new article
        $newArticle = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => Auth::id()
        ];
        $article = Article::create($newArticle);
        //Check if there's image data present, and write this to the database aswell.
        if(isset($validated['image_data'])){
            $newImage = $this->imageQuery($article, $validated['image_subtitle'], $request->file('image_data'));
            Image::create($newImage);
        }
        //And the fitting article_categories
        $createArray = $this->articleCategoryQuery($article, $validated['category']);
        ArticleCategory::upsert($createArray, uniqueBy: ['article_id'], update: ['category_id']);
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
        if($article->user->id == Auth::id()){
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
        if($article->user->id == Auth::id()){
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


    //Return a part of the query for updating/storing an image.
    private function imageQuery(Article $article, string $image_subtitle = null ,$image_data): array{
        //Store the uploaded file into the website's public images folder.
        $imagePath = Storage::putFileAs(
            'images',
            $image_data,
            //Okay seriously, why does putFileAs not add a file extension, who thought that was a good idea?
            'article_image_'.$article->id.'.' . $image_data->getClientOriginalExtension()
        );
        $newImage = [
            //Put the path for the folder one up so it will display properly later.
            'image_path' => '../'.$imagePath,
            'image_alt' => $article->title . ' Afbeelding',
            'image_subtitle' => $image_subtitle,
            'article_id' => $article->id
        ];
        return $newImage;
    }

    //Return a part of the query for updating/storing the list of selected categories of an article.
    private function articleCategoryQuery(Article $article, array $categories): array{
        $queryArray = [];
        foreach($categories as $category){
            array_push($queryArray,
                ['article_id' => $article->id,
                'category_id' => $category]
            );
        }
        return $queryArray;
    }
}