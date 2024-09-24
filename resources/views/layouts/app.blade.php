<!DOCTYPE html>
<html x-cloak x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', value => localStorage.setItem('darkMode', value))" :class="{ 'dark': darkMode }"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-around">
                        <div class="flex-1">
                            {{ $header }}
                        </div>
                        <div class="my-1 text-right max-md:hidden">
                            <a class="text-gray-600 dark:text-gray-400" @click="darkMode = !darkMode"
                                :href="'javascript:void(0)'">
                                <span x-show="darkMode">{{ __('Try Light mode!') }}</span>
                                <span x-show="!darkMode">{{ __('Try Dark mode!') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <!-- Toast Notification -->
        @if (session('toast'))
            <x-toast :message="session('toast.message')" :type="session('toast.type')" />
        @endif
    </div>
</body>

</html>
