<x-layout>
    <main class="max-w-screen-sm mx-auto px-10">
        <div class="p-10 rounded text-zinc-900">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Create and Post an Artwork
                </h2>
                <p class="mb-4">Create an artwork</p>
            </header>
          
            <form id="store-artwork" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="inline-block text-lg mb-2">
                        Title
                    </label>
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                        name="title"
                        value="{{ old('title') }}"
                    />

                    <div id="error-title">
                    </div>

                    {{-- @error('title')
                        <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                    @enderror --}}
                </div>

                <div class="mb-4">
                    <label for="description" class="inline-block text-lg mb-2"
                        >Description</label
                    >
                    <textarea
                        class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                        name="description"
                        rows="3"
                    >{{ old('description') }}</textarea>
                    
                    <div id="error-description">
                    </div>

                    {{-- @error('description')
                        <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                    @enderror --}}
                </div>

                <div class="mb-4">
                    <label
                        for="Price"
                        class="inline-block text-lg mb-2"
                    >
                        Price
                    </label>
                    <input
                        type="number"
                        class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                        name="price"
                        value="{{ old('price') }}"
                    />

                    <div id="error-price">
                    </div>

                    {{-- @error('price')
                        <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                    @enderror --}}
                </div>

                <div class="mb-4">
                    <label
                        for="category"
                        class="inline-block text-lg mb-2"
                    >
                        Category
                    </label>
                    <select name="category" class="block bg-gray-300 rounded w-full p-2">
                        <option disabled selected class="uppercase font-medium text-sm tracking-wide">Choose category</option>
                        <option value="paintings" class="uppercase font-medium text-sm tracking-wide">Paintings</option>
                        <option value="drawings" class="uppercase font-medium text-sm tracking-wide">Drawings</option>
                        <option value="digital arts" class="uppercase font-medium text-sm tracking-wide">Digital Art</option>
                        <option value="sculptures" class="uppercase font-medium text-sm tracking-wide">Sculptures</option>
                    </select>

                    <div id="error-category">
                    </div>

                    {{-- @error('category')
                        <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                    @enderror --}}
                </div>

                <div class="mb-10">
                    <label
                        for="image"
                        class="inline-block text-lg mb-2"
                    >
                        Art Image
                    </label>
                    <input
                        type="file"
                        class="border border-gray-200 px-6 rounded-md p-2 w-full bg-gray-300"
                        name="image"
                    />

                    <div id="error-image">
                    </div>

                    {{-- @error('image')
                        <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                    @enderror --}}
                </div>

                <div class="mb-6">
                    <button
                        type="submit"
                        class="bg-laravel text-white bg-zinc-900 rounded py-2 px-6 uppercase hover:bg-black"
                    >
                        Post
                    </button>
                </div>

                <div class="mt-8">
                    <p>
                        Change of mind?
                        @if (auth()->user()->user_level == 'artist')
                        <a href="{{ route('artwork.index') }}" class="text-zinc-900 font-semibold"
                            >Back</a
                        >
                        @else
                        <a href="{{ route('artist.show', request()->query('artist_id')) }}" class="text-zinc-900 font-semibold"
                            >Back</a
                        >
                        @endif
                   </p>
                </div>
            </form>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('#store-artwork').submit(function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);
                storeArtwork(formData);
            });

            var authArtist = "{{ auth()->user()->user_level == 'artist' ? 'true' : 'false' }}";

            function storeArtwork(formData) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('artwork.store', ['artist_id' => request()->query('artist_id')]) }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(authArtist == 'true');
                        if (authArtist == 'true') {
                            window.location.href = "{{ route('artwork.index') }}";
                        } else {
                            window.location.href = "{{ route('artwork.index', ['artist' => request()->query('artist_id')]) }}";
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error:", error);
                        console.log(xhr.responseText);

                        var responseErrors = JSON.parse(xhr.responseText);

                        // Loop through the validation errors and display them
                        $.each(responseErrors.errors, function (key, value) {
                            $('#error-' + key).empty();
                            $('#error-' + key).append('<p class="error text-red-500 mt-1 text-sm">' + value + '</p>');
                        });
                    }
                });
            }
        });
    </script>
</x-layout>