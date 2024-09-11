<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticlePolicy
{
    /**
     * Create a new policy instance.
     */
    public function store(User $user)
    {
        //Check if the user given is the same as the logged in user.
        return $user->id == Auth::id();
    }
    public function update(User $user, Article $article)
    {
        //Check if the user's the same as the author
        return $user->id == $article->user_id;
    }
}