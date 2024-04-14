@if (Auth::user()->image)
    <div x-show="avatarPreview">
        <img src="{{ route('profile.avatar', ['filename' => Auth::user()->image]) }}" alt="Current Photo"
            class="mt-2 max-w-xs rounded-full">
    </div>
@else
    <div x-show="defaultAvatarPreview">
        <img src="{{ asset('img/defaultprofile.png') }}" alt="Default Photo" class="mt-2 max-w-xs rounded-full">
    </div>
@endif
