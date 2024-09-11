<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function store(User $user)
    {
        //Check if the user's id is the same as the one logged in.
        return $user->id == Auth::id();
    }
}
