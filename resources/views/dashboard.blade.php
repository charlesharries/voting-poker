<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        Hey there, {{ current_user()->name }}!
    </div>

    <h2>Your rooms</h2>
    <ul>
        @foreach($rooms as $room)
            <x-room-item :room="$room" />
        @endforeach
    </ul>

    <a href="{{ route('rooms.new') }}">+ New room</a>
</x-app-layout>
