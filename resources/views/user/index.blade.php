<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instagram') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-2 sm:p-4 bg-white shadow sm:rounded-lg inline-flex ">

                <form method="get" action="{{ route('users') }}" id="searcher">
                    <div class="row">
                        <div class="form-group col">
                            <input type="text" id="search" class="form-control" />
                        </div>
                        <div class="form-group col btn-search">
                            <input type="submit" value="Buscar" />
                        </div>
                    </div>
                </form>


            </div>

            @foreach ($users as $user)
                <div id="user" class="sm:rounded-lg flex shadow-[0_3px_10px_rgb(0,0,0,0.2)]">

                    @if ($user->image)
                        <div x-show="avatarPreview" class="size-40 mr-4 flex items-center">
                            <img src="{{ route('profile.avatar', ['filename' => $user->image]) }}" alt="Current Photo"
                                class="rounded-full">
                        </div>
                    @endif
                    <div class="p-2">
                        <p class="text-3xl">{{ __('@' . $user->nick) }}</p>
                        <p>{{ $user->name . ' ' . $user->surname }}</p>
                        <p class="text-sm text-gray-600">
                            {{ 'Joined: ' . $user->created_at->diffForHumans(null, false, false, 1) }}</p>

                        <div class="pt-2">
                            <x-secondary-button><a href="{{ route('profile', ['id' => $user->id]) }}"
                                    class="flex items-center">{{ __('View Profile') }}</a></x-secondary-button>
                        </div>
                    </div>

                </div>
            @endforeach

            {{-- PAGINATION --}}
            <div class="clearfix"></div>

            <div class="pt-2 flex justify-center">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>




</x-app-layout>
