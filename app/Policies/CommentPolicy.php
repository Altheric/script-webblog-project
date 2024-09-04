<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create()
    {
        //Check if the user's logged in, as anyone logged in can make a comment.
        return Auth::check();
    }
}
