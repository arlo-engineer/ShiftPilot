<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            シフトの作成
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.shift.store') }}">
        @csrf
        <div class="pt-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-2">
                    @include('admin.shift.partials.calendar')
            </div>
        </div>

        <div class="py20">
            @include('admin.shift.partials.modal')
        </div>

        <div class="bg-white flex justify-end w-full fixed -bottom-0 -right-0 py-4 pr-6 border-t font-bold shadow-outline text-sm">
            <button type="submit" class="bg-my-main-color text-white px-4 py-3 rounded">下書きを確定する</button>
        </div>
    </form>

</x-admin-layout>
