<!-- Side Navigatiton -->
<!-- 閉じているとき -->
<nav id="closedSideNav" class="hidden fixed bg-gray-700 w-12 h-full z-10 text-center sm:block">
    <x-closed-nav-link :href="route('admin.shift.index')" :active="request()->routeIs('admin.shift.index')">
        <div class="w-5 mx-auto"><img src="{{ asset('img/nav-calendar.png') }}" alt="シフト管理"></div>
        <p class="text-[7px]">シフト管理</p>
    </x-closed-nav-link>
    <x-closed-nav-link :href="route('admin.employees.index')" :active="request()->routeIs('admin.employees.index', 'admin.employees.create')">
        <div class="w-5 mx-auto"><img src="{{ asset('img/nav-employee.png') }}" alt="スタッフ管理"></div>
        <p class="text-[7px]">スタッフ管理</p>
    </x-closed-nav-link>
    <x-closed-nav-link :href="route('admin.profile.edit')" :active="request()->routeIs('admin.profile.edit')">
        <div class="w-5 mx-auto"><img src="{{ asset('img/nav-setting.png') }}" alt="設定"></div>
        <p class="text-[7px]">設定</p>
    </x-closed-nav-link>
    <div class="flex justify-end w-12 pr-4 bg-gray-800 py-4 fixed -bottom-0">
        <img onclick="openSideNav()" class="w-6 cursor-pointer" src="{{ asset('img/nav-closed-arrow.png') }}" alt="左矢印">
    </div>
</nav>

<!-- 開いているとき -->
<nav id="openedSideNav" class="hidden fixed bg-gray-700 w-48 h-full z-10 sm:hidden">
    <x-opened-nav-link :href="route('admin.shift.index')" :active="request()->routeIs('admin.shift.index')">
        <div class="w-5"><img src="{{ asset('img/nav-calendar.png') }}" alt="シフト管理"></div>
        <p class="pl-2">シフト管理</p>
    </x-opened-nav-link>
    <x-opened-nav-link :href="route('admin.employees.index')" :active="request()->routeIs('admin.employees.index', 'admin.employees.create')">
        <div class="w-5"><img src="{{ asset('img/nav-employee.png') }}" alt="スタッフ管理"></div>
        <p class="pl-2">スタッフ管理</p>
    </x-opened-nav-link>
    {{-- <x-opened-nav-link :href="route('admin.shift.index')" :active="request()->routeIs('admin.shift.index')">
        <div class="pl-5"></div>
        <p class="pl-2">協働NGリスト</p>
    </x-opened-nav-link>
    <x-opened-nav-link :href="route('admin.shift.index')" :active="request()->routeIs('admin.shift.index')">
        <div class="pl-5"></div>
        <p class="pl-2">スタッフ管理テスト</p>
    </x-opened-nav-link> --}}
    <x-opened-nav-link :href="route('admin.profile.edit')" :active="request()->routeIs('admin.profile.edit')">
        <div class="w-5"><img src="{{ asset('img/nav-setting.png') }}" alt="設定"></div>
        <p class="pl-2">設定</p>
    </x-opened-nav-link>
    <div class="flex justify-end w-48 pr-4 bg-gray-800 py-4 fixed -bottom-0">
        <img onclick="closeSideNav()" class="w-6 cursor-pointer" src="{{ asset('img/nav-opened-arrow.png') }}" alt="右矢印">
    </div>
</nav>
