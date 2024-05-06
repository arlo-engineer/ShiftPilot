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

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.admin_navigation')

            <div class="flex pt-10">
                <!-- Side Navigation -->
                @include('layouts.admin_side_navigation')
            </div>
            <main id="widthMain" class="sm:ml-12">
                <!-- Page Content -->
                {{ $slot }}
            </main>
        </div>

        <script>
            let closedSideNavClass = document.getElementById('closedSideNav').classList;
            let openedSideNavClass = document.getElementById('openedSideNav').classList;
            let widthMainClass = document.getElementById('widthMain').classList;
            function openSideNav() {
                openedSideNavClass.add('sm:block');
                openedSideNavClass.remove('sm:hidden');
                closedSideNavClass.add('sm:hidden');
                closedSideNavClass.remove('sm:block');
                widthMainClass.add('sm:ml-48');
                widthMainClass.remove('sm:ml-12');
            }
            function closeSideNav() {
                openedSideNavClass.add('sm:hidden');
                openedSideNavClass.remove('sm:block');
                closedSideNavClass.remove('sm:hidden');
                closedSideNavClass.add('sm:block');
                widthMainClass.add('sm:ml-12');
                widthMainClass.remove('sm:ml-48');
            }
        </script>

    </body>
</html>
