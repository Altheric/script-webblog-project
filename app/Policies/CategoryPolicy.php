<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CategoryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function create()
    {
        //Check if the user's logged in, as anyone can make a category.
        return Auth::check();
    }
}
