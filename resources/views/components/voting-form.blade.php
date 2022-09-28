@props([
    'room'
])

<h2>Members</h2>
<ul id="users">
    @foreach ($room->users as $user)
        <li data-id="{{ $user->id }}" class="{{ $user->voteFor($room) ? "voted" : "" }}">
            {{ $user->name }}

            @if (current_user()->isAdmin($room) && $user->id !== current_user()->id)
                <button type="submit" name="userId" value="{{ $user->id }}" form="boot">Boot</button>
            @endif
        </li>
    @endforeach
</ul>

@if (current_user()->isAdmin($room))
    <form id="boot" action="{{ route('rooms.boot', [$room]) }}" method="POST">
        @csrf
        @method("DELETE")
    </form>
@endif

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
