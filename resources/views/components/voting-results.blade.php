@props([
    'room'
])

<h2>Voting results</h2>

@forelse ($room->votes as $vote)
    <p>{{ $vote->user->name }}: {{ $vote->value }}</p>
@empty
    <p>No results.</p>
@endforelse
