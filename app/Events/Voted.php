<?php

namespace App\Events;

use App\Models\Room;
use App\Models\User;

class Voted extends RoomEvent
{
    public string $vote;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Room $room, User $user, string $vote)
    {
        $this->room = $room;
        $this->user = $user;
        $this->vote = $vote;
    }
}
