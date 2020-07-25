<?php

namespace App\Policies;

use App\Models\{Motivation, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminMotivationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Motivation $motivation)
    {
        return $user->id == $motivation->user_id;
    }

    public function delete(User $user, Motivation $motivation)
    {
        return $user->id == $motivation->user_id;
    }
}
