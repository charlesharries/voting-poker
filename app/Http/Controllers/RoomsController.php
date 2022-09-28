<?php

namespace App\Http\Controllers;

use App\Events\RoomJoined;
use App\Events\UserKicked;
use App\Events\VotingFinished;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomsController extends Controller
{
    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['string', 'max:255', 'required'],
        ]);

        /** @var Room */
        $room = Room::create($attributes + ['uuid' => Str::uuid()]);
        $room->users()->attach(current_user()->id, ['is_admin' => true]);

        return redirect(route('rooms.show', $room->uuid));
    }

    public function show(Room $room)
    {
        $isInRoom = $room->users->pluck("id")->contains(current_user()->id);
        $room->users()->syncWithoutDetaching(current_user()->id);
        $room->refresh();

        if (!$isInRoom) {
            event(new RoomJoined($room, current_user()));
        }

        return view('rooms.show', compact('room'));
    }

    public function finish(Room $room)
    {
        abort_if(!current_user()->can('update-room', $room), 403);

        $room->finishVoting();
        event(new VotingFinished($room, current_user()));
        return redirect()->back();
    }

    public function boot(Room $room, User $user)
    {
        abort_if(!current_user()->can('update-room', $room), 403);


        // Get rid of the user
        $copy = $user->toArray(); // copy for event
        $room->users()->detach($user->id);
        $user->refresh();
        if (!$user->rooms()->exists()) {
            $user->delete();
        }

        event(new UserKicked($room, $copy));
        $room->refresh();

        return redirect()->route('rooms.show', $room);
    }
}
