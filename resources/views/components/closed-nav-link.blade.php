@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pt-4 pb-2 bg-gray-500 text-sm font-medium leading-5 text-white w-full focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'block pt-4 pb-2 border-transparent text-sm font-medium leading-5 text-white w-full hover:bg-gray-500 focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
