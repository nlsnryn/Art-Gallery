<x-layout>
    <div class="bg-gray-100">
        <div class="max-w-screen-sm mx-auto h-max py-24 text-gray-900">
            <div class="p-10 rounded">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-1">
                        Edit Admin Account
                    </h2>
                </header>

                <form id="update-admin" method="POST">
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
                            value="{{ $admin->name }}"
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
                            value="{{ $admin->email }}"
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
                            value="{{ $admin->password }}"
                        />

                        <div id="error-password">
                        </div>

                        {{-- @error('password')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                        @enderror --}}
                    </div>

                    <div class="mb-10">
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
                            value="{{ $admin->password }}"
                        />

                        {{-- @error('password_confirmation')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                        @enderror --}}
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="bg-laravel text-white bg-zinc-900 rounded py-2 px-6 hover:bg-black"
                        >
                            Update
                        </button>
                        <a href="{{ route('admin.index') }}" class="bg-laravel text-white bg-zinc-500 rounded py-2.5 px-6 hover:bg-black">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#update-admin').submit(function(event) {
                event.preventDefault();

                var formData = new FormData($(this)[0]);
                updateAdmin(formData);
            });

            function updateAdmin(formData) {
                formData.append('_method', 'PUT');

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.update', $admin->id) }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        window.location.href = "{{ route('admin.index') }}";
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