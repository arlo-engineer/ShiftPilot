@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex w-full ps-3 pe-4 py-2 border-l-4 border-user-main-color text-start text-base font-medium text-user-main-color bg-user-sub-color-lighter focus:outline-none focus:text-user-main-color focus:bg-user-sub-color focus:border-user-main-color transition duration-150 ease-in-out'
            : 'flex w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-user-main-color hover:bg-user-sub-color-lighter hover:border-user-main-color focus:outline-none focus:text-user-main-color focus:bg-user-sub-color-lighter focus:border-user-main-color transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
