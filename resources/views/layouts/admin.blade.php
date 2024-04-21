<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

        {{-- Livewire
        @livewireStyles --}}
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.admin_navigation')

            <div class="flex pt-10">
                <!-- Navigatiton -->
                <nav class="fixed bg-gray-700 w-48 h-full z-10">
                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                        <x-nav-link :href="route('admin.shift.create')" :active="request()->routeIs('admin.shift.create')">
                            <div class="w-5"><img src="{{ asset('img/nav-calendar.png') }}" alt="カレンダーのアイコン"></div>
                            <p class="pl-2">シフト管理</p>
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            <div class="w-5"><img src="{{ asset('img/nav-employee.png') }}" alt="スタッフのアイコン"></div>
                            <p class="pl-2">スタッフ管理</p>
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            <div class="pl-5"></div>
                            <p class="pl-2">協働NGリスト</p>
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            <div class="pl-5"></div>
                            <p class="pl-2">スタッフ管理テスト</p>
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:flex">
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            <div class="w-5"><img src="{{ asset('img/nav-setting.png') }}" alt="歯車のアイコン"></div>
                            <p class="pl-2">設定</p>
                        </x-nav-link>
                    </div>
                    <div class="flex justify-end w-48 pr-4 bg-gray-800 py-4 fixed -bottom-0">
                        <img class="w-6" src="{{ asset('img/nav-opened-arrow.png') }}" alt="右矢印">
                    </div>
                </nav>

            </div>
            <!-- Page Content -->
            <main class="ml-48">
                {{ $slot }}
            </main>
        </div>
        {{-- Livewire
        @livewireScripts --}}

    </body>
</html>
