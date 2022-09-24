<x-app-layout>
    <x-slot name="header">
        <h1>{{ $room->name }}</h1>
    </x-slot>

    <x-slot name="head">
        @vite(['resources/js/room.js'])
    </x-slot>

    <h2>Members</h2>
    <ul id="users">
        @foreach ($room->users as $user)
            <li data-id="{{ $user->id }}" class="{{ $user->voteFor($room) ? "voted" : "" }}">
                {{ $user->name }}
            </li>
        @endforeach
    </ul>

    <h2>Vote</h2>
    <form action="{{ route('rooms.votes', $room) }}" method="POST">
        @csrf

        @foreach (\App\Models\Vote::$options as $option)
            <x-vote :value="$option" :voted="current_user()->voteFor($room)" />
        @endforeach
    </form>

    @if (current_user()->isAdmin($room))
        <h2>Reset</h2>

        <form action="{{ route('rooms.votes', $room) }}" method="POST">
            @csrf
            @method("DELETE")

            <button type="submit">Reset room</button>
        </form>
    @endif

</x-app-layout>
