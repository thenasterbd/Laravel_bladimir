<div id="timeLine" class="sm:rounded-lg bg-white shadow ">

    {{-- USER --}}
    <div id="user" class="pl-2 py-2 max-auto flex items-center bg-gray-200 ">

        <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="flex items-center">

            @if ($image->user->image)
                <div class="mr-1">
                    <img src="{{ route('profile.avatar', ['filename' => $image->user->image]) }}" alt="Profile Photo"
                        class="h-8 w-8 rounded-full">
                </div>
            @endif

            <div>
                {{ $image->user->name . ' ' . $image->user->surname }}
            </div>
            <p class="pl-2 text-sm text-gray-600">
                {{ __('@' . $image->user->nick) }}
            </p>
        </a>

    </div>

    {{-- IMAGE --}}
    <div class="">
        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="Post" class="w-full"
            style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1)">
    </div>

    {{-- INTERACTON --}}
    <div class="pl-2 pt-2 flex items-center">


        <div>
            {{-- IF USER LIKE --}}
            <?php $user_like = false; ?>

            @foreach ($image->likes as $like)
                @if ($like->user->id == Auth::user()->id)
                    <?php $user_like = true; ?>
                @endif
            @endforeach

            @if ($user_like)
                <img src="{{ asset('img/hearts-64(1).png') }}" data-id="{{ $image->id }}" alt="Likes"
                    class="btn-like" style="width: 25px">
            @else
                <img src="{{ asset('img/favorite-3-64.png') }}" data-id="{{ $image->id }}" alt="Likes"
                    class="btn-dislike" style="width: 25px">
            @endif
        </div>

        <div class="pl-4">
            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                <img src="{{ asset('img/comments-64.png') }}" alt="Likes" class="img-fluid" style="width: 25px">
            </a>
        </div>

    </div>

    {{-- LIKES COUNT --}}
    <div class="pl-2 pt-2 ">

        @if (count($image->likes) == 1)
            <span id="image_like_{{ $image->id }}">{{ count($image->likes) }} Like</span>
        @else
            <span id="image_like_{{ $image->id }}">{{ count($image->likes) }} Likes</span>
        @endif

    </div>

    {{-- DESCRIPTION --}}
    <div class="pl-2 pt-2">
        <strong>{{ __('@' . $image->user->nick) }} </strong> {{ $image->description }}
    </div>

    {{-- COMMENT --}}
    <div class="pl-2 py-2">
        <span class="pb-1">
            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                @if (count($image->comments) == 0)
                    <span>Be the first comment</span>
                @elseif (count($image->comments) == 1)
                    <span> View {{ count($image->comments) }} comment</span>
                @else
                    <span> View all {{ count($image->comments) }} comments</span>
                @endif
            </a>
        </span>

    </div>

    {{-- DATE --}}
    <div class="pl-2 pb-2  text-sm text-gray-600">
        <span>
            {{-- DOCUMENTATION https://carbon.nesbot.com/docs/#api-humandiff --}}
            Posted {{ $image->created_at->diffForHumans(null, false, false, 1) }}
        </span>
    </div>
</div>
