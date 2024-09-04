<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    /**
     * Create a new policy instance.
     */
    public function update(User $user, Article $article)
    {
        //Check if the user's the same as the author
        return $user->id == $article->user_id;
    }
}
