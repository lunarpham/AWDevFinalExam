<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TodoPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Todo $todo): Response
    {
        return $todo->user_id == $user->id
        ? Response::allow()
        : Response::deny('You do not own this post.');
    }
}
