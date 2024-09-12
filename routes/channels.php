<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('users.{id}', function (User $user, int $id) {
    return $user->id === $id;
});

Broadcast::channel('chat', function ($user) {});
