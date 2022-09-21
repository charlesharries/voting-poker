<li class="room">
    <a href="{{ route('rooms.show', $room) }}">
    <strong>{{ $room->name }}</strong> &bull;
    <span>{{ $room->owner->name }}</span>
</li>
