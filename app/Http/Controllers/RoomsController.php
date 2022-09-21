<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $room->users()->syncWithoutDetaching(current_user()->id);

        return view('rooms.show', compact('room'));
    }
}