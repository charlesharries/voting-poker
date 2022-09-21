<x-guest-layout>
    <!-- Validation Errors -->
    <x-auth-validation-errors :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-text-input id="name" type="text" name="name" :value="old('name')" required
                autofocus />
        </div>

        <div>
            <x-button class="ml-4" type="submit">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</x-guest-layout>
