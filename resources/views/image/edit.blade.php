<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Photo') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Edit your Photo and your comment') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('image.update') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}">

                            <div class="flex flex-col">
                                <div x-show="currentImagePreview">
                                    <img src="{{ route('image.file', ['filename' => $image->image_path]) }}"
                                        alt="Post" class="mt-2 max-w-xs"
                                        style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1)">
                                </div>

                                <div class="pt-4" x-data="{ imagePreview: '' }">
                                    <label for="image_path" class="block font-medium text-sm text-gray-700">Select
                                        Photo</label>
                                    <input id="image_path" name="image_path" type="file" class="mt-1 block w-full"
                                        x-on:change="imagePreview = URL.createObjectURL($event.target.files[0])"
                                        accept="image/*">
                                    <div x-show="imagePreview">
                                        <h3 class="text-lg font-small text-gray-900 ">
                                            {{ __('New Photo') }}
                                        </h3>
                                        <img :src="imagePreview" alt="Preview" class="mt-2 max-w-xs">
                                    </div>
                                </div>

                                @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role"alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-col">

                                <label for="description" class="text-sm text-gray-700">Description</label>
                                <textarea name="description" id="description"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $image->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role"alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </div>

                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
