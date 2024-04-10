<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Include or Edit Photo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Submit or update your profile photo.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- AVATAR --}}
    <h3 class="text-lg font-small text-gray-900 ">
        {{ __('Current Photo') }}
    </h3>
    @include('includes.avatar')

    <form method="post" action="{{ route('profile.updatePhoto') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        {{-- @method('post') --}}

        <div x-data="{ imagePreview: '' }">
            <label for="image_path" class="block font-medium text-sm text-gray-700">Select Photo</label>
            <input id="image_path" name="image_path" type="file" class="mt-1 block w-full"
                x-on:change="imagePreview = URL.createObjectURL($event.target.files[0])" accept="image/*">
            <div x-show="imagePreview">
                <h3 class="text-lg font-small text-gray-900 ">
                    {{ __('New Photo') }}
                </h3>
                <img :src="imagePreview" alt="Preview" class="mt-2 max-w-xs">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'photo-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>


    </form>
</section>
