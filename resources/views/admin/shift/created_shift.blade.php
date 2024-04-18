<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            シフトの作成
        </h2>
    </x-slot>

    {{-- @livewire('modal') --}}

    <div class="py-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.shift.store') }}" class="modal">
                @csrf
                @include('admin.shift.partials.calendar')
                <button type="submit">確定する</button>
            </form>
        </div>
    </div>

    {{-- <form method="POST" action="{{ route('admin.shift.store') }}" class="modal">
        @csrf
        <div class="py20">
            @include('admin.shift.partials.modal')
        </div>
        <button type="submit">確定する</button>
    </form> --}}

</x-admin-layout>
