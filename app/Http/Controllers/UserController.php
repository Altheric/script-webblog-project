<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //Show user page for editing articles and such
    public function index() {
        
        return view('users.index');
    }
    //Show login page
    public function login(bool $loginError = false) {
        return view('users.login', compact('loginError'));
    }
    //Validate login credentials, then compare to database
    public function entry(UserLoginRequest $request) {
        $validated = $request->validated();
        //Get the login details of the username from the database.
        $user = User::where('username',$validated['username'])->first();
        //Check if $user is not null and the password is valid.
        if($user != null && Hash::check($validated['password'], $user->password)){
            //Assign user to this session.
            Session::put(['user_id' => $user->id, 'username' => $user->username, 'premium' => $user->premium_user]);
            return redirect()->route('articles.index');
        } else {
            return $this->login(true);
        }
    }
    //Log the user out.
    public function logout() {
        Session::flush();
        return redirect()->route('users.login');
    }
    //Get all the articles of the user
    public function articles() {
        $articles = Article::with('user')->where('user_id', Session::get('user_id'))->get();
        return view('users.articles', compact('articles'));
    }
    //Point to the article editor
    public function edit(Article $article){
        $categories = Category::all();
        return view('users.edit', compact('article', 'categories'));
    }
    //Destroy function to delete the article.
    public function destroy(Article $article){
        $article->delete();
        return redirect()->route('users.articles');
    }
    //Points to the confirmation page for deletion
    public function destroyConfirm(Article $article){
        return view('users.delete', compact('article'));
    }
    //Points to the upgrade to premium page.
    public function premium(){
        return view('users.premium');
    }
    //Update the current user's premium status in the database
    public function upgrade(){
        //Update the database
        User::where('id', Session::get('user_id'))->update(['premium_user' => true]);
        //Update the session aswell
        Session::put(['premium' => true]);
        return redirect()->route('articles.index');
    }
    //Change the article's premium status depending on the boolean given in the array.
    public function exclusivity(Article $article, bool $mutator){
        if($mutator == true){
            $article->update(['premium_article' =>true]);
        } else {
            $article->update(['premium_article' =>false]);
        }
        return redirect()->route('users.articles');
    }
}
