<?php

namespace App\Observer;

use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->created_by = auth()->user()->id ?? null;
    }

    public function updating(User $user)
    {
        $user->updated_by = auth()->user()->id ?? null;
    }
}
