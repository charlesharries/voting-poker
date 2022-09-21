<x-app-layout>
    <x-slot name="header">
        <h1>{{ $room->name }}</h1>
    </x-slot>

    <h2>Members</h2>
    <ul>
        @foreach ($room->users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
</x-app-layout>
