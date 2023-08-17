<div class="rounded text-zinc-900 mt-20">
    <header class="text-start">
        <h2 class="text-2xl font-bold uppercase mb-10">
            Send Inquiries
        </h2>
    </header>

    <form method="POST" action="{{ route('query.store', $artwork->id) }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="inline-block text-lg mb-2">
                Name
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                name="client_name"
                value="{{ old('client_name') }}"
            />

            @error('client_name')
                <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label
                for="email"
                class="inline-block text-lg mb-2"
            >
                Email
            </label>
            <input
                type="email"
                class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                name="client_email"
                value="{{ old('client_email') }}"
            />

            @error('client_email')
                <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label
                for="contact_number"
                class="inline-block text-lg mb-2"
            >
                Contact Number
            </label>
            <input
                type="number"
                class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                name="contact_number"
                value="{{ old('contact_number') }}"
            />

            @error('contact_number')
                <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="location" class="inline-block text-lg mb-2">
                Location
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                name="location"
                value="{{ old('location') }}"
            />

            @error('location')
                <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="message" class="inline-block text-lg mb-2"
                >Message</label
            >
            <textarea
                class="border border-gray-200 rounded p-2 w-full bg-gray-300"
                name="message"
                rows="3"
            >{{ old('message') }}</textarea>
            
            @error('message')
                <p class="text-red-500 mt-1 text-xs">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                type="submit"
                class="bg-laravel text-white bg-zinc-900 rounded py-2 px-6 uppercase hover:bg-black"
            >
                Send
            </button>
        </div>
    </form>
</div>