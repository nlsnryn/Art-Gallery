<x-layout>
    <div>
        <div class="max-w-screen-sm mx-auto h-max py-24 text-gray-900">
            <div class="p-10 rounded">
                <header class="text-center">
                    <h2 class="text-2xl font-bold uppercase mb-5">
                        Login
                    </h2>
                </header>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
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
                        <button
                            type="submit"
                            class="text-white bg-zinc-900 rounded py-2 px-4 hover:bg-black"                        >
                            Sign In
                        </button>
                    </div>

                    <div class="mt-8">
                        <p>
                            Don't have an account?
                            <a href="/register" class="text-zinc-900 font-semibold"
                                >Register</a
                            >
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

