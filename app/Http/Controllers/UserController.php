<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            return redirect()->route('articles.index');
        } else {
            return $this->login(true);
        }
    }
}
