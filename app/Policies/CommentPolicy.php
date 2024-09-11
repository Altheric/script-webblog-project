<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function store(User $user)
    {
        //Check if the user given is the same as the logged in user.
        return $user->id == Auth::id();
    }
}