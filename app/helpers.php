<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

function current_user(): User|null
{
    if (!Auth::check()) {
        return null;
    }

    return Auth::user();
}
