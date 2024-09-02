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
        $articles = Article::with('user')->where('user_id', Session::get('user_id'))->get();
        return view('users.index', compact('articles'));
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
}
