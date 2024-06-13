<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <header x-data="{ open: false }" class="bg-white w-full fixed z-10" style="box-shadow: 0px 10px 10px -3px rgba(0, 0, 0, 0.1);">
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
        </header>

        <div class="sm:pt-16 pt-10">
            <div class="relative w-full h-[540px]">
                <!-- Background Image -->
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url({{ asset('img/top.jpg') }});"></div>

                <!-- Gray Overlay -->
                <div class="absolute inset-0 bg-black opacity-30"></div>

                <!-- App Name -->
                <div class="absolute sm:left-24 left-10 top-1/2 transform -translate-y-1/2 text-white text-4xl">
                    <p class="text-3xl font-bold">シフト管理をスマートに</p>
                    <h1 class="text-6xl font-bold">ShiftPilot</h1>
                </div>
            </div>
        </div>

        <section id="flow" class="bg-gray-50">
            <div class="py-16 max-w-5xl mx-auto px-2">
                <h2 class="text-center text-admin-main-color text-3xl font-bold">ShiftPilotでのシフト管理の流れ</h2>
                <ul class="pt-12 md:flex items-center justify-between">
                    <li class="text-center">
                        <div class="mx-auto flex items-center justify-center bg-white border-[0.5px] border-gray-300 rounded-full w-56 h-56 lg:w-72 lg:h-72 overflow-hidden">
                            <img src="{{ asset('img/top-shift-collect.png') }}" alt="希望シフトの収集" class="w-full px-5 object-cover">
                        </div>
                        <div class="text-admin-main-color text-lg pt-5">1. 希望シフトの収集</div>
                    </li>
                    <li class="md:block hidden w-12 pb-12">
                        <img src="{{ asset('img/top-right-arrow.png') }}" alt=">>">
                    </li>
                    <li class="text-center pt-8 md:pt-0">
                        <div class="mx-auto flex items-center justify-center bg-white border-[0.5px] border-gray-300 rounded-full w-56 h-56 lg:w-72 lg:h-72 overflow-hidden">
                            <img src="{{ asset('img/top-shift-create.png') }}" alt="シフト表の作成" class="w-full pt-8 px-8 object-cover">
                        </div>
                        <div class="text-admin-main-color text-lg pt-5">2. シフト表の作成</div>
                    </li>
                    <li class="md:block hidden w-12 pb-12">
                        <img src="{{ asset('img/top-right-arrow.png') }}" alt=">>">
                    </li>
                    <li class="text-center pt-8 md:pt-0">
                        <div class="mx-auto flex items-center justify-center bg-white border-[0.5px] border-gray-300 rounded-full w-56 h-56 lg:w-72 lg:h-72 overflow-hidden">
                            <img src="{{ asset('img/top-shift-share.png') }}" alt="スタッフとの共有" class="w-full px-5 object-cover">
                        </div>
                        <div class="text-admin-main-color text-lg pt-5">3. スタッフとの共有</div>
                    </li>
                </ul>
            </div>
        </section>

        <section id="function" class="py-16 max-w-5xl mx-auto px-2">
            <h2 class="text-center text-admin-main-color text-3xl font-bold">ShiftPilotの機能一覧</h2>
            <ul class="flex flex-wrap pt-8">
                <li class="xl:w-1/3 md:w-1/2 sm:sm:p-4 p-10 p-10">
                    <div class="rounded-md py-5 px-3" style="box-shadow: 0 0px 15px 0px rgba(0, 0, 0, 0.1)">
                        <div class="w-full inline items-center justify-center">
                            <p class="text-center border-admin-main-color border-b-2 pb-1">シフト提出</p>
                            <p class="leading-relaxed text-sm text-gray-500 pt-5">スタッフが期限までにシフトを提出します。希望日時をクリックするだけで簡単に入力や提出ができます。</p>
                        </div>
                    </div>
                </li>
                <li class="xl:w-1/3 md:w-1/2 sm:sm:p-4 p-10 p-10">
                    <div class="rounded-md py-5 px-3" style="box-shadow: 0 0px 15px 0px rgba(0, 0, 0, 0.1)">
                        <div class="w-full inline items-center justify-center">
                            <p class="text-center border-admin-main-color border-b-2 pb-1">シフト作成</p>
                            <p class="leading-relaxed text-sm text-gray-500 pt-5">スタッフからの希望シフトを元にシフトを作成できます。常にスタッフが提出した希望シフトが表示されており、転記によるミスがなくなります。</p>
                        </div>
                    </div>
                </li>
                <li class="xl:w-1/3 md:w-1/2 sm:sm:p-4 p-10 p-10">
                    <div class="rounded-md py-5 px-3" style="box-shadow: 0 0px 15px 0px rgba(0, 0, 0, 0.1)">
                        <div class="w-full inline items-center justify-center">
                            <p class="text-center border-admin-main-color border-b-2 pb-1">固定シフト時間設定</p>
                            <p class="leading-relaxed text-sm text-gray-500 pt-5">普段固定化されている出退勤時間を設定することで、スタッフのシフト提出が簡単になります。</p>
                        </div>
                    </div>
                </li>
                <li class="xl:w-1/3 md:w-1/2 sm:sm:p-4 p-10 p-10">
                    <div class="rounded-md py-5 px-3" style="box-shadow: 0 0px 15px 0px rgba(0, 0, 0, 0.1)">
                        <div class="w-full inline items-center justify-center">
                            <p class="text-center border-admin-main-color border-b-2 pb-1">お問い合わせ機能</p>
                            <p class="leading-relaxed text-sm text-gray-500 pt-5">アプリの使い方や追加機能の希望、バグの修正などをお知らせください。2~3日以内にご返信やご対応いたします。</p>
                        </div>
                    </div>
                </li>
                <li class="xl:w-1/3 md:w-1/2 sm:sm:p-4 p-10 p-10">
                    <div class="rounded-md py-5 px-3" style="box-shadow: 0 0px 15px 0px rgba(0, 0, 0, 0.1)">
                        <div class="w-full inline items-center justify-center relative">
                            <p class="text-center border-admin-main-color border-b-2 pb-1">リマインド通知機能</p>
                            <p class="leading-relaxed text-sm text-gray-500 pt-5">シフト提出の締め切りに近づいたタイミングでスタッフに通知を送ります。シフトの提出忘れを防止することができます。</p>
                            <div class= "w-full h-full bg-white bg-opacity-80 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <p class="w-fll h-full flex items-center justify-center text-xl">comming soon</p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="xl:w-1/3 md:w-1/2 sm:sm:p-4 p-10 p-10">
                    <div class="rounded-md py-5 px-3" style="box-shadow: 0 0px 15px 0px rgba(0, 0, 0, 0.1)">
                        <div class="w-full inline items-center justify-center relative">
                            <p class="text-center border-admin-main-color border-b-2 pb-1">自動シフト作成機能</p>
                            <p class="leading-relaxed text-sm text-gray-500 pt-5">必要なスタッフの人数を入力するだけで、スタッフの希望シフトを元に自動でシフトを作成します。</p>
                            <div class= "w-full h-full bg-white bg-opacity-80 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <p class="w-fll h-full flex items-center justify-center text-xl">comming soon</p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </section>

        <section id="start" class="bg-gray-50">
            <ul class="py-16 max-w-5xl mx-auto px-2">
                <h2 class="text-center text-admin-main-color text-3xl font-bold">利用開始までの流れ</h2>
                <div class="pt-12">
                    <li class="flex justify-center items-center">
                        <div class="flex items-center justify-center bg-white border-[0.5px] border-gray-300 rounded-full sm:w-56 w-40 sm:h-56 h-40 sm:w-72 sm:h-72 overflow-hidden">
                            <img src="{{ asset('img/top-register.png') }}" alt="アカウント発行" class="w-full px-5 object-cover">
                        </div>
                        <div class="border-t border-b py-10 sm:pl-12 pl-3 w-1/2 border-gray-300">
                            <h3 class="text-admin-main-color text-lg">1. アカウント発行</h3>
                            <p class="pt-8">管理者とスタッフのアカウントを発行する。<br>管理者は会社名/店舗名を入力する。</p>
                        </div>
                    </li>
                    <li class="flex justify-center items-center pt-8">
                        <div class="flex items-center justify-center bg-white border-[0.5px] border-gray-300 rounded-full sm:w-56 w-40 sm:h-56 h-40 sm:w-72 sm:h-72 overflow-hidden">
                            <img src="{{ asset('img/top-add-employee.png') }}" alt="スタッフの追加" class="w-full object-cover">
                        </div>
                        <div class="border-t border-b py-10 sm:pl-12 pl-3 w-1/2 border-gray-300">
                            <h3 class="text-admin-main-color text-lg">2. スタッフの追加</h3>
                            <p class="pt-8">管理者が会社/店舗にスタッフを登録する。</p>
                        </div>
                    </li>
                </div>
                <div class="flex justify-center pt-16">
                    @if (Route::has('admin.login'))
                        <a href="{{ route('login') }}" class="w-80 text-center bg-user-main-color border border-transparent rounded-md py-5 font-semibold text-lg text-white uppercase tracking-widest hover:opacity-70 transition ease-in-out duration-150">ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-5 w-80 text-center py-5 border border-user-main-color rounded-md font-semibold text-lg text-user-main-color uppercase tracking-widest hover:opacity-70 transition ease-in-out duration-150">アカウント登録</a>
                        @endif
                    @endif
                </div>
            </ul>
        </section>

        <section id="contact" class="py-16 max-w-5xl mx-auto px-2">
            <h2 class="text-center text-admin-main-color text-3xl font-bold">お問い合わせ</h2>
            <div class="pt-8">
                @include('layouts.contact-form')
            </div>
        </section>

        <footer class="bg-gray-800 text-gray-200 py-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap justify-between">
                    <!-- Company Information -->
                    <div class="w-full md:w-1/4 mb-6 md:mb-0">
                        <h5 class="text-xl font-bold mb-4">ShiftPilot</h5>
                        <p class="text-sm">
                            シフト管理をスマートに。<br>
                            ShiftPilotは効率的なシフト管理を提供します。
                        </p>
                    </div>

                    <!-- Navigation Links -->
                    <div class="w-full md:w-1/4 mb-6 md:mb-0">
                        <h5 class="text-xl font-bold mb-4">ナビゲーション</h5>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:underline">ホーム</a></li>
                            <li><a href="#flow" class="hover:underline">シフト管理の流れ</a></li>
                            <li><a href="#function" class="hover:underline">機能一覧</a></li>
                            <li><a href="#start" class="hover:underline">利用開始までの流れ</a></li>
                            <li><a href="#contact" class="hover:underline">お問い合わせ</a></li>
                        </ul>
                    </div>

                    <!-- Social Media Links -->
                    <div class="w-full md:w-1/4 mb-6 md:mb-0">
                        <h5 class="text-xl font-bold mb-4">ソーシャルメディア</h5>
                        <ul class="flex space-x-4">
                            <li><a href="https://x.com/fire_arlo" class="hover:text-white block w-4"><img src="{{ asset('img/logo-x.png') }}" alt="X"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <p class="text-sm">&copy; 2024 ShiftPilot. All rights reserved.</p>
                </div>
            </div>
        </footer>


    </body>
</html>
