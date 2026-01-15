<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'TicketManager') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<div class="min-h-screen">
    @include('layouts.navigation')

    @isset($header)
        <header class="bg-white border-b">
            <div class="max-w-6xl mx-auto px-4 py-4">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="py-6">
        <div class="max-w-6xl mx-auto px-4">
            {{ $slot }}
        </div>
    </main>
</div>

</body>
</html>
