<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instagram') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="sm:rounded-lg flex items-center">


                @if ($user->image)
                    <div x-show="avatarPreview">
                        <img src="{{ route('profile.avatar', ['filename' => $user->image]) }}" alt="Current Photo"
                            class="max-w-40  rounded-full">
                    </div>
                @endif

                <div class="ml-4">
                    <p class="text-3xl">
                        {{ __('@' . $user->nick) }}
                    </p>
                    <p>
                        {{ $user->name . ' ' . $user->surname }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ 'Joined: ' . $user->created_at->diffForHumans(null, false, false, 1) }}
                    </p>
                </div>
            </div>

            @foreach ($user->images as $image)
                @include('includes.image', ['image' => $image])
            @endforeach

            {{-- PAGINATION --}}
            {{-- <div class="clearfix"></div>

            <div class="pt-2 flex justify-center">
                {{ $images->links('pagination::tailwind') }}
            </div> --}}
        </div>
    </div>



</x-app-layout>
