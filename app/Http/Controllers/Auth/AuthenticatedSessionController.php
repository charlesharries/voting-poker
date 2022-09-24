<?php

namespace App\Http\Controllers\Auth;

use App\Events\RoomLeft;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = current_user();

        Auth::guard('web')->logout();

        // TODO: All of this probably belongs in an event listener.
        $user->rooms->each(function ($room) use ($user) {
            event(new RoomLeft($room, $user));
            if ($user->isAdmin($room)) {
                $room->delete();
            }
        });

        if ($user instanceof User) {
            $user->delete();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
