<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div>
            <div>
                <div>
                    Hey there, {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
