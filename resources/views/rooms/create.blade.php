<x-app-layout>
    <x-slot name="header">
        <h1>New room</h1>
    </x-slot>

    <form action="{{ route('rooms') }}" method="POST">
        @csrf

        <div class="control">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" />
        </div>

        <div class="control">
            <button type="submit">New room</button>
        </div>
    </form>
</x-app-layout>
