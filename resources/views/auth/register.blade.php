<x-layout>
    <div>
        <div class="max-w-screen-sm mx-auto h-max py-24 text-gray-900">
            <div class="p-10 rounded">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-1">
                        Register
                    </h2>
                    <p class="mb-4">Create an account</p>
                </header>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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

                        @error('name')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
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
                        
                        @error('email')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
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

                        @error('password')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
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

                        @error('password_confirmation')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
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

                        @error('location')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
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
                            value="{{ old('image') }}"
                        />

                        @error('image')
                            <p class="text-red-500 mt-1 text-sm">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <button
                            type="submit"
                            class="bg-laravel text-white bg-zinc-900 rounded py-2 px-4 hover:bg-black"
                        >
                            Sign Up
                        </button>
                    </div>

                    <div class="mt-8">
                        <p>
                            Already have an account?
                            <a href="/login" class="text-zinc-900 font-semibold"
                                >Login</a
                            >
                       </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>