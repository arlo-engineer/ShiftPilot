@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex w-full ps-3 pe-4 py-2 border-l-4 border-my-main-color text-start text-base font-medium text-my-main-color bg-my-sub-color-lighter focus:outline-none focus:text-my-main-color focus:bg-my-sub-color focus:border-my-main-color transition duration-150 ease-in-out'
            : 'flex w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-my-main-color hover:bg-my-sub-color-lighter hover:border-my-main-color focus:outline-none focus:text-my-main-color focus:bg-my-sub-color-lighter focus:border-my-main-color transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
