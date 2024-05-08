<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-2/3 inline-flex items-center justify-center px-4 py-2 bg-user-main-color border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:opacity-70 focus:opacity-70 active:bg-user-main-color focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
