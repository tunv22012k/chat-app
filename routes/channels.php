<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('room.{id}', function ($user, $id) {
    // Private channel
    // return true; // user có thể join vào bất kì chatroom nào
    // Presence channel
    return $user; // giờ đây ta trả về thông tin user
});
