<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instagram') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'post-created')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-green-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Post Created') }}
                    </div>
                </div>
            @endif

            @if (session('status') === 'image-deleted')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-green-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Image Deleted') }}
                    </div>
                </div>
            @elseif (session('status') === 'image-not-deleted')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-red-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Image not Deleted') }}
                    </div>
                </div>
            @endif

            @foreach ($images as $image)
                @include('includes.image', ['image' => $image])
            @endforeach

            {{-- PAGINATION --}}
            <div class="clearfix"></div>

            <div class="pt-2 flex justify-center">
                {{ $images->links('pagination::tailwind') }}
            </div>
        </div>
    </div>



</x-app-layout>
