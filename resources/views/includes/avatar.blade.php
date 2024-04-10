@if (Auth::user()->image)
    <div x-show="avatarPreview">
        <img src="{{ route('profile.avatar', ['filename' => Auth::user()->image]) }}" alt="Current Photo"
            class="mt-2 max-w-xs rounded-full">
    </div>
@else
    <p>You don't have a Photo.</p>
@endif
