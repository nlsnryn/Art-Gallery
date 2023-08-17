<x-layout>
    <div>
        <div class="max-w-screen-sm mx-auto h-max py-24 text-gray-900">
            <div class="p-10 rounded">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-1">
                        Create Admin Account
                    </h2>
                </header>

                <form method="POST" action="{{ route('admin.index') }}">
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
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
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
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
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
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                        @enderror
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
                            value="{{ old('password_confirmation') }}"
                        />

                        @error('password_confirmation')
                            <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
                        @enderror
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="bg-laravel text-white bg-zinc-900 rounded py-2 px-6 hover:bg-black"
                        >
                            Save
                        </button>
                        <a href="{{ URL::previous() }}" class="bg-laravel text-white bg-zinc-500 rounded py-2.5 px-6 hover:bg-black">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>