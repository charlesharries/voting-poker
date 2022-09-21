<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Vote;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function store(Room $room, Request $request)
    {
        $attributes = $request->validate([
            'value' => [Rule::in(Vote::$options), 'required', 'numeric'],
        ]);

        $room->votes()->updateOrCreate(
            ['user_id' => current_user()->id],
            $attributes + ['user_id' => current_user()->id]
        );

        return redirect()->back();
    }

    public function reset(Room $room)
    {
        if ($room->owner->id !== current_user()->id) {
            session()->flash('info', "You're not allowed to do that.");
            return redirect()->back();
        }

        $room->votes()->delete();
        return redirect()->back();
    }
}
