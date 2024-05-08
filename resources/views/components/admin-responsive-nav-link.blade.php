@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex w-full ps-3 pe-4 py-2 border-l-4 border-admin-main-color text-start text-base font-medium text-admin-main-color bg-admin-sub-color-lighter focus:outline-none focus:text-admin-main-color focus:bg-admin-sub-color focus:border-admin-main-color transition duration-150 ease-in-out'
            : 'flex w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-admin-main-color hover:bg-admin-sub-color-lighter hover:border-admin-main-color focus:outline-none focus:text-admin-main-color focus:bg-admin-sub-color-lighter focus:border-admin-main-color transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
