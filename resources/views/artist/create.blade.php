<x-layout>
    <div class="bg-gray-100">
        <div class="max-w-screen-sm mx-auto h-max py-24 text-gray-900">
            <div class="p-10 rounded">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-1">
                        Create Artist Account
                    </h2>
                </header>

                <form id="store-artist" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="inline-block text-lg mb-2">
                            Name
                        </label>
                        <input
                            type="text"
                            class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                            name="name"
                            value="{{ old('name') }}"
                        />

                        <div id="error-name">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="email" class="inline-block text-lg mb-2"
                            >Email</label
                        >
                        <input
                            type="email"
                            class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                            name="email"
                            value="{{ old('email') }}"
                        />
                        
                         <div id="error-email">
                        </div>

                        {{-- @error('email')
                            <p class="error text-red-500 mt-1 text-xs"></p>
                        @enderror --}}
                    </div>

                    <div class="mb-6">
                        <label
                            for="password"
                            class="inline-block text-lg mb-2"
                        >
                            Password
                        </label>
                        <input
                            type="password"
                            class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                            name="password"
                            value="{{ old('password') }}"
                        />

                         <div id="error-password">
                        </div>

                        {{-- @error('password')
                            <p class="error text-red-500 mt-1 text-xs"></p>
                        @enderror --}}
                    </div>

                    <div class="mb-6">
                        <label
                            for="password2"
                            class="inline-block text-lg mb-2"
                        >
                            Confirm Password
                        </label>
                        <input
                            type="password"
                            class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                            name="password_confirmation"
                            value="{{ old('password_confirmation') }}"
                        />

                        <div id="error-password_confirmation">
                        </div>

                        {{-- @error('password_confirmation')
                            <p class="error text-red-500 mt-1 text-xs"></p>
                        @enderror --}}
                    </div>

                    <div class="mb-6">
                        <label
                            for="location"
                            class="inline-block text-lg mb-2"
                        >
                            Location
                        </label>
                        <input
                            type="text"
                            class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                            name="location"
                            value="{{ old('location') }}"
                        />

                        <div id="error-location">
                        </div>

                        {{-- @error('location')
                            <p class="error text-red-500 mt-1 text-xs"></p>
                        @enderror --}}
                    </div>

                    <div class="mb-10">
                        <label
                            for="image"
                            class="inline-block text-lg mb-2"
                        >
                            Artist Picture
                        </label>
                        <input
                            type="file"
                            class="border border-gray-200 rounded-md px-6 p-2 w-full bg-gray-300"
                            name="image"
                        />

                        <div id="error-image">
                        </div>

                        {{-- @error('image')
                            <p class="error text-red-500 mt-1 text-xs"></p>
                        @enderror --}}
                    </div>

                    <div class="mb-6">
                        <button
                            type="submit"
                            class="bg-laravel text-white bg-zinc-900 rounded py-2 px-4 hover:bg-black"
                        >
                            Register
                        </button>
                        <a href="{{ URL::previous() }}" class="bg-laravel text-white bg-zinc-500 rounded py-2.5 px-6 hover:bg-black">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#store-artist').submit(function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);
                storeArtist(formData);
            });

            function storeArtist(formData) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('artist.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        window.location.href = "{{ route('artist.index') }}";
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