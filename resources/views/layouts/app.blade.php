<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HabitApp') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="g-[#FAFBFC] text-[#172B4D]">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <main class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
