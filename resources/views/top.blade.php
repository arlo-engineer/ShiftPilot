<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <nav x-data="{ open: false }" class="w-full fixed z-10">
            <div class="mx-auto sm:px-6 lg:px-6">
                <div class="flex justify-between sm:h-16 h-10 items-center">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('top') }}">
                            <div class="sm:w-44 w-28"><img src="{{ asset('img/ShiftPilot-logo.png') }}" alt="ShiftPilot"></div>
                        </a>
                    </div>
                    <!-- Button -->
                    <div class="flex justify-center items-center">
                        @if (Route::has('login'))
                            <a href="{{ route('admin.top') }}" class="text-center py-2 sm:text-sm text-xs text-my-text-color uppercase tracking-widest hover:opacity-70 transition ease-in-out duration-150">管理者の方はこちら</a>
                            <a href="{{ route('login') }}" class="hidden sm:block ml-3 w-36 text-center py-2 bg-user-main-color border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:opacity-70 transition ease-in-out duration-150">ログイン</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hidden sm:block ml-3 w-36 text-center py-2 font-semibold border border-user-main-color rounded-full text-sm text-user-main-color uppercase tracking-widest hover:opacity-70 transition ease-in-out duration-150">アカウント登録</a>
                            @endif
                        @endif

                        <!-- Hamburger -->
                        <div class="flex items-center sm:hidden">
                            <button @click="open = ! open" id="navButton" class="ml-2 inline-flex items-center justify-center p-2 text-white bg-user-main-color">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" id="navContent" class="hidden sm:hidden bg-white">
                    <div class="pt-2 pb-3 space-y-1 text-center">
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="sm:hidden inline-block w-32 text-center py-2 bg-user-main-color border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:opacity-70 transition ease-in-out duration-150">ログイン</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="sm:hidden inline-block w-32 text-center py-2 font-semibold border border-user-main-color rounded-full text-xs text-user-main-color uppercase tracking-widest hover:opacity-70 transition ease-in-out duration-150">アカウント登録</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </nav>


        <div class="h-screen w-screen flex justify-center items-center">
            <p class="text-lg">※後ほど作成するページです。</p>
        </div>

    </body>
</html>
