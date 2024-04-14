<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pixel Pioneer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'comment-created')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-green-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Comment Send') }}
                    </div>
                </div>
            @elseif (session('status') === 'comment-deleted')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-green-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Comment Deleted') }}
                    </div>
                </div>
            @elseif (session('status') === 'comment-not-deleted')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-red-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Comment Not Deleted') }}
                    </div>
                </div>
            @elseif (session('status') === 'post-updated')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-green-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Post Updated') }}
                    </div>
                </div>
            @endif

            <div class="sm:rounded-lg bg-white shadow ">

                {{-- USER --}}
                <div class="pl-2 py-2 max-auto flex items-center bg-gray-200 ">

                    {{-- <a href="{{ route('profile', ['id' => $image->user->id]) }}" class="flex items-center"> --}}

                    @if ($image->user->image)
                        <div class="mr-1">
                            <img src="{{ route('profile.avatar', ['filename' => $image->user->image]) }}"
                                alt="Profile Photo" class="h-8 w-8 rounded-full">
                        </div>
                    @else
                        <div x-show="defaultAvatarPreview" class="mr-1">
                            <img src="{{ asset('img/defaultprofile.png') }}" alt="Default Photo"
                                class="h-8 w-8 rounded-full">
                        </div>
                    @endif

                    <div>
                        {{ $image->user->name . ' ' . $image->user->surname }}
                    </div>
                    <p class="pl-2 text-sm text-gray-600">
                        {{ __('@' . $image->user->nick) }}
                    </p>
                    {{-- </a> --}}


                </div>

                {{-- IMAGE --}}
                <div>
                    <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="Post"
                        class="w-full" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1)">
                </div>

                {{-- DESCRIPTION --}}
                <div class="pl-2 pt-2">
                    <strong>{{ __('@' . $image->user->nick) }} </strong> {{ $image->description }}
                </div>

                {{-- BUTTON EDIT AND DELETE --}}
                @if (Auth::user() && Auth::user()->id == $image->user->id)
                    <div class="pl-2 pt-2 actions">
                        {{-- Edit button --}}
                        <a
                            href="{{ route('image.edit', ['id' => $image->id]) }}"><x-aux-button>{{ __('Edit') }}</x-aux-button></a>
                        {{-- Delete button --}}
                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-image-deletion')">{{ __('Delete') }}</x-danger-button>

                        <x-modal name="confirm-image-deletion" focusable>
                            <form method="post" action="{{ route('image.delete', ['id' => $image->id]) }}"
                                class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Are you sure you want to delete your post?') }}
                                </h2>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        {{ __('Delete Post') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>

                    </div>
                @endif

                {{-- INTERACTON --}}
                <div class="pl-2 pt-2 flex items-center">
                    <div class="pr-2">
                        {{-- IF USER LIKE --}}
                        <?php $user_like = false; ?>

                        @foreach ($image->likes as $like)
                            @if ($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach

                        <div class="flex items-center">
                            <div class="pr-1">
                                @if ($user_like)
                                    <img src="{{ asset('img/arrowUpOn.png') }}" data-id="{{ $image->id }}"
                                        alt="Likes" class="btn-like like_image_{{ $image->id }}"
                                        style="width: 25px">
                                @else
                                    <img src="{{ asset('img/arrowUpOff.png') }}" data-id="{{ $image->id }}"
                                        alt="Undolike" class="btn-like like_image_{{ $image->id }}"
                                        style="width: 25px">
                                @endif
                            </div>
                            <strong id='count-likes'>{{ count($image->likes) }}</strong>
                        </div>
                    </div>

                    <div>
                        {{-- IF USER DISLIKE --}}
                        <?php $user_dislike = false; ?>

                        @foreach ($image->dislikes as $dislike)
                            @if ($dislike->user->id == Auth::user()->id)
                                <?php $user_dislike = true; ?>
                            @endif
                        @endforeach

                        <div class="flex items-center">
                            <div class="pr-2">
                                @if ($user_dislike)
                                    <img src="{{ asset('img/arrowDownOn.png') }}" data-id="{{ $image->id }}"
                                        alt="Dislikes" class="btn-dislike dislike_image_{{ $image->id }}"
                                        style="width: 25px">
                                @else
                                    <img src="{{ asset('img/arrowDownOff.png') }}" data-id="{{ $image->id }}"
                                        alt="undo_Dislikes" class="btn-dislike dislike_image_{{ $image->id }}"
                                        style="width: 25px">
                                @endif
                            </div>
                            <strong id='count-dislikes'>{{ count($image->dislikes) }}</strong>
                        </div>
                    </div>
                </div>

                {{-- COMMENT --}}
                <div class="pl-2 py-2">
                    <span class="pb-1">
                        Comments ({{ count($image->comments) }})
                    </span>

                    @foreach ($image->comments as $comment)
                        <div id="comment" class="flex flex-col md:flex-row items-start">
                            <div class="flex-grow w-full md:w-4/5">

                                <strong class="mr-1 md:mr-2">{{ __('@' . $comment->user->nick) }}</strong>
                                <span class="flex-grow">{{ $comment->content }}</span>
                            </div>
                            <div class="flex-grow w-full md:w-1/5 flex items-center justify-end">

                                <div class="text-sm text-gray-600">
                                    {{ $comment->created_at->diffForHumans(null, false, false, 1) }}
                                </div>
                                @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                    <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="pl-3">
                                        <img src="{{ asset('img/trash-9-64(1).png') }}" alt="Likes"
                                            class="img-fluid" style="width: 25px">
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- MAKE A COMMENT --}}
                <div class="pl-2 pb-2">
                    <form action="{{ route('comment.save') }}" method="post">
                        @csrf
                        <input type="hidden" name="image_id" value="{{ $image->id }}">

                        <div class="pr-2">
                            <textarea name="content" id="content" required autofocus autocomplete="content"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full h-10 shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>

                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role"alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="py-2">
                            <x-primary-button>{{ __('Send') }}</x-primary-button>
                        </div>
                    </form>
                </div>

                {{-- DATE --}}
                <div class="pl-2 pb-2  text-sm text-gray-600">
                    <span>
                        {{-- DOCUMENTATION https://carbon.nesbot.com/docs/#api-humandiff --}}
                        Posted {{ $image->created_at->diffForHumans(null, false, false, 1) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
