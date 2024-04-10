<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center px-4 py-2 bg-blue-500
                                                        border border-blue-400 rounded-md font-semibold text-xs text-white
                                                        uppercase tracking-widest shadow-sm hover:bg-blue-400 focus:outline-none
                                                        focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25
                                                        active:bg-blue-600 transition ease-in-out duration-150',
    ]) }}>
    {{ $slot }}
</button>
