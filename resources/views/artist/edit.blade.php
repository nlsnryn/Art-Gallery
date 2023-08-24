<x-layout>
    <div class="bg-gray-100">
        <div class="max-w-screen-sm mx-auto h-max py-24 text-gray-900">
            <div class="p-10 rounded">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-1">
                        Edit Artist Account
                    </h2>
                </header>

                <form id="update-artist" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="name" class="inline-block text-lg mb-2">
                            Name
                        </label>
                        <input
                            type="text"
                            class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                            name="name"
                            value="{{ $artist->user->name }}"
                        />

                        <div id="error-name">
                        </div>

                        {{-- @error('name')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                        @enderror --}}
                    </div>

                    <div class="mb-6">
                        <label for="email" class="inline-block text-lg mb-2"
                            >Email</label
                        >
                        <input
                            type="email"
                            class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                            name="email"
                            disabled
                            value="{{ $artist->user->email }}"
                        />

                        <div id="error-email">
                        </div>
                        
                        {{-- @error('email')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
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
                            value="{{ $artist->user->password }}"
                            placeholder="*********"
                        />

                        <div id="error-password">
                        </div>

                        {{-- @error('password')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
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
                            value="{{ $artist->user->password }}"
                            placeholder="*********"
                        />

                        {{-- @error('password_confirmation')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
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
                            value="{{ $artist->location }}"
                        />

                        <div id="error-location">
                        </div>

                        {{-- @error('location')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                        @enderror --}}
                    </div>

                    <div class="mb-3">
                        <label
                            for="image"
                            class="inline-block text-lg mb-2"
                        >
                           Edit Artist Picture
                        </label>
                        <input
                            type="file"
                            class="border border-gray-200 rounded-md px-6 p-2 w-full bg-gray-300"
                            name="image"
                        />

                        <div id="error-image">
                        </div>

                        {{-- @error('image')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                        @enderror --}}
                    </div>

                    <div class="mb-10">
                        <img src="{{ asset("storage/$artist->image") }}" alt="Artwork" class="h-60 w-full rounded-md">
                    </div>

                    <div class="mb-2">
                        <button
                            type="submit"
                            class="text-white bg-zinc-900 rounded py-1 sm:py-2 px-2 sm:px-5 hover:bg-zinc-800"
                        >
                            Update
                        </button>
                    </div>
                </form>
                <form id="delete-artist" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-700 text-white py-1 sm:py-2 px-2 sm:px-5 rounded hover:bg-red-600">Delete Account</button>

                    <a href="{{ route('artist.index') }}" class="bg-laravel text-white bg-zinc-500 rounded py-1.5 sm:py-2 px-2 sm:px-5 hover:bg-black">
                        Back
                    </a>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#update-artist').submit(function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);
                updateArtist(formData);
            });

            $('#delete-artist').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Artist account will be deleted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#18181b',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Artist Account has been deleted.',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        deleteArtist();
                    }
                })
            });

            function updateArtist(formData) {
                formData.append('_method', 'PUT');

                $.ajax({
                    type: "POST",
                    url: "{{ route('artist.update', $artist->id) }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
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

            function deleteArtist() 
            {
                $.ajax({
                    type: "POST",
                    url: "{{ route('artist.destroy', $artist->id) }}",
                    dataType: "json",
                    data: {
                        _method: "DELETE",
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        console.log(response);
                        window.location.href = "{{ route('artist.index') }}";
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error:", error);
                        console.log(xhr.responseText);
                    }
                })
            }
        });
    </script>
</x-layout>