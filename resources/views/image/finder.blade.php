<x-app-layout>


    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-2 sm:p-4 bg-white shadow sm:rounded-lg inline-flex ">
            <form id="search-form" method="get" action="{{ route('images') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            <input type="text" name="search" id="search" class="form-control"
                                value="{{ $search }}" placeholder="Tag" />
                        </div>
                        <div class="form-group col pt-1">
                            <select name="sort_by" class="form-control w-full">
                                <option value="default" {{ $sortBy == 'default' ? 'selected' : '' }}>- Filter -</option>
                                <option value="likes" {{ $sortBy == 'likes' ? 'selected' : '' }}>Most popular</option>
                                <option value="dislikes" {{ $sortBy == 'dislikes' ? 'selected' : '' }}>Less popular
                                </option>
                                <option value="comments" {{ $sortBy == 'comments' ? 'selected' : '' }}>Most comments
                                </option>
                                <option value="recent" {{ $sortBy == 'recent' ? 'selected' : '' }}>Recent</option>
                                <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            </select>
                        </div>
                        <div class="form-group col pt-2">
                            <x-secondary-button type="submit">Search</x-secondary-button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="search-results-info" class="p-1 mb-4 bg-gray-100 shadow sm:rounded-lg text-center"></div>

            @foreach ($images as $image)
                @include('includes.image', ['image' => $image])
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="clearfix"></div>
        <div class="mt-8 flex justify-center">
            {{ $images->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
