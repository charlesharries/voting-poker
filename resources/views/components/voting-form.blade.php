@props([
    'room'
])

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
    <h2>Finish voting</h2>
    <form action="{{ route('rooms.finish', $room) }}" method="POST">
        @csrf

        <button type="submit">Finish</button>
    </form>
@endif
