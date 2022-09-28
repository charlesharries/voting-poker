<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @if (isset($head))
            {{ $head }}
        @endif
    </head>

    <body>
        <div>
            @include('layouts.navigation')

            @if(Auth::check())
                <input
                    id="current_user"
                    type="hidden"
                    value="{{ current_user()->id }}"
                    name="current_user"
                    data-user-id="{{ current_user()->id }}"
                    data-username="{{ current_user()->name }}"
                />
            @endif

            <!-- Page Heading -->
            <header>
                {{ $header }}
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
