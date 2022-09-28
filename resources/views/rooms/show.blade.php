<x-app-layout>
    <x-slot name="header">
        <h1>{{ $room->name }}</h1>
    </x-slot>

    <x-slot name="head">
        @vite(['resources/js/room.js'])
    </x-slot>

    @if ($room->is_finished_voting)
        <x-voting-results :room="$room" />
    @else
        <x-voting-form :room="$room" />
    @endif

    @if (current_user()->isAdmin($room))
        <h2>Reset</h2>
        <form action="{{ route('rooms.votes', $room) }}" method="POST">
            @csrf
            @method("DELETE")

            <button type="submit">Reset room</button>
        </form>
    @endif

</x-app-layout>
