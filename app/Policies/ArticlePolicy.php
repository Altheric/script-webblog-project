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
    public function create()
    {
        //Check if the user's logged in, as anyone can make an article
        return Auth::check();
    }
    public function update(User $user, Article $article)
    {
        //Check if the user's the same as the author
        return $user->id == $article->user_id;
    }
}
