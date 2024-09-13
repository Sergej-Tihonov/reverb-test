<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('users.{id}', function (User $user, int $id) {
    return $user->id === $id;
});

Broadcast::channel('app', function (User $user) {
    return true;
});

Broadcast::channel('room.{roomId}', function (User $user, int $roomId) {
    return $user->only(['id', 'name']);
});

Broadcast::channel('orders.{ordersId}', function (User $user, int $ordersId) {
    if ($user->id !== Order::find($ordersId)->user_id) {
        return false;
    }
    return true;
});

Broadcast::channel('chat', function ($user) {});
