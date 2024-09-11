<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    //Check if the user isn't already logged in.
    public function login(User $user = null)
    {
        return $user == null;
    }
}
