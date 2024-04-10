<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instagram') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-2 sm:p-4 bg-white shadow sm:rounded-lg text-center">
                ✨ List of Favorites ✨
            </div>

            @foreach ($likes as $like)
                @include('includes.image', ['image' => $like->image])
            @endforeach


            {{-- PAGINATION --}}
            <div class="clearfix"></div>

            <div class="pt-2 flex justify-center">
                {{ $likes->links('pagination::tailwind') }}
            </div>

        </div>
    </div>

</x-app-layout>
