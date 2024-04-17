<x-app-layout>
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

            @foreach ($user->images()->orderBy('created_at', 'desc')->get() as $image)
                @include('includes.image', ['image' => $image])
            @endforeach

        </div>
    </div>
</x-app-layout>
