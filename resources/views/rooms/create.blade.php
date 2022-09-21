<form action="{{ route('rooms') }}" method="POST">
    <div class="control">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" />
    </div>

    <div class="control">
        <button type="submit">New room</button>
    </div>
</form>
