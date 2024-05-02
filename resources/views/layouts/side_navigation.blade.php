<!-- Side Navigatiton -->
<!-- 閉じているとき -->
<nav id="closedSideNav" class="hidden fixed bg-gray-700 w-12 h-full z-10 text-center sm:block">
    <x-closed-nav-link :href="route('shift.index')" :active="request()->routeIs('shift.index')">
        <div class="w-5 mx-auto"><img src="{{ asset('img/nav-calendar.png') }}" alt="カレンダーのアイコン"></div>
        <p class="text-[7px]">シフト確認</p>
    </x-closed-nav-link>
    <x-closed-nav-link :href="route('submit-shift.index')" :active="request()->routeIs('submit-shift.index')">
        <div class="w-5 mx-auto"><img src="{{ asset('img/nav-calendar.png') }}" alt="カレンダーのアイコン"></div>
        <p class="text-[7px]">シフト提出</p>
    </x-closed-nav-link>
    <div class="flex justify-end w-12 pr-4 bg-gray-800 py-4 fixed -bottom-0">
        <img onclick="openSideNav()" class="w-6 cursor-pointer" src="{{ asset('img/nav-closed-arrow.png') }}" alt="左矢印">
    </div>
</nav>

<!-- 開いているとき -->
<nav id="openedSideNav" class="hidden fixed bg-gray-700 w-48 h-full z-10 sm:hidden">
    <x-opened-nav-link :href="route('shift.index')" :active="request()->routeIs('shift.index')">
        <div class="w-5"><img src="{{ asset('img/nav-calendar.png') }}" alt="カレンダーのアイコン"></div>
        <p class="pl-2">シフト確認</p>
    </x-opened-nav-link>
    <x-opened-nav-link :href="route('submit-shift.index')" :active="request()->routeIs('submit-shift.index')">
        <div class="w-5"><img src="{{ asset('img/nav-calendar.png') }}" alt="カレンダーのアイコン"></div>
        <p class="pl-2">シフト提出</p>
    </x-opened-nav-link>
    <div class="flex justify-end w-48 pr-4 bg-gray-800 py-4 fixed -bottom-0">
        <img onclick="closeSideNav()" class="w-6 cursor-pointer" src="{{ asset('img/nav-opened-arrow.png') }}" alt="右矢印">
    </div>
</nav>
