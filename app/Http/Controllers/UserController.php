<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //Show user page for editing articles and such
    public function index() {
        //Didn't work. Tried Auth::id() and Auth::getUser() too. Doesn't return a User collection either way.
        // $articles = Auth::user()->articles;

        $articles = Article::with('user')->where('user_id', Auth::id())->get();
        return view('users.index', compact('articles'));
    }
    //Show login page
    public function login(bool $loginMismatch = false) {
        return view('users.login', compact('loginMismatch'));
    }
    //Validate login credentials, then compare to database
    public function entry(UserLoginRequest $request) {
        $validated = $request->validated();
        //Get the login details of the username from the database.
        $user = User::where('username',$validated['username'])->first();
        //Check if $user is not null and the password is valid.
        if($user != null && Hash::check($validated['password'], $user->password)){
            //Assign user to the Auth
            Auth::login($user);
            //Write premium status to the session so we don't need to call the database every time we need to check this.
            Session::put('premium_user', $user->premium_user);
            return redirect()->route('articles.index');
        } else {
            return $this->login(true);
        }
    }
    //Log the user out.
    public function logout() {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect()->route('users.login');
    }
   
    //Points to the upgrade to premium page.
    public function premium(){
        return view('users.premium');
    }
    //Update the current user's premium status in the database and session
    public function upgrade(){
        User::where('id', Auth::id())->update(['premium_user' => true]);
        Session::put('premium_user', true);
        return redirect()->route('articles.index');
    }
}