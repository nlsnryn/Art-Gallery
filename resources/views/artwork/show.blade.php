<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="flex lg:flex-row lg:flex-shrink-0 flex-col gap-5 text-zinc-900">
            @if ($artwork->image)
            <div class="w-full 500:w-1/2 image">
                <img src="{{ asset("storage/$artwork->image") }}" alt="Artwork" class="w-full object-fill h-80 lg:h-auto rounded">
            </div>
            @endif
        
            <div class="bg-gray-100 w-full lg:w-1/2 rounded p-5 500:p-20">
                <h1 class="font-medium text-2xl uppercase tracking-tight">{{ $artwork->title }}</h1>
                <p class="font-normal text-lg leading-tight mt-5">{{ $artwork->description }}</p>
                <h4 class="uppercase font-medium text-sm tracking-wide mt-5">Date publish: {{ $artwork->created_at->format('F d Y') }}</h4>
                <h4 class="uppercase font-medium text-sm tracking-wide mt-1">Price: ₱{{ number_format($artwork->price, 2) }}</h4>

                <div class="artist-info mt-5">
                    <h1 class="font-medium text-xl uppercase tracking-tight">{{ $artwork->artist->user->name }}</h1>
                    <h4 class="uppercase font-medium text-sm tracking-wide mt-1">{{ $artwork->artist->location }}</h4> 
                    <h4 class="uppercase font-medium text-sm tracking-wide mt-1">Member since: {{ $artwork->artist->created_at->format('F d Y') }}</h4> 
                </div>
                
                @if (auth()->user())
                <div class="mt-10 flex gap-2">
                    <a href="{{ route('artwork.edit', $artwork->id) }}" class="px-10 bg-zinc-900 hover:bg-zinc-800 text-white rounded py-1">Edit</a>
                    <form action="{{ route('artwork.destroy', $artwork->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-10 bg-red-600 hover:bg-red-500 text-white rounded py-1">Delete</button>
                    </form>
                </div>

                <div class="my-5 mb-28">
                    <a href="{{ route('query.history', $artwork->id) }}" class="px-10 bg-zinc-900 hover:bg-zinc-800 text-white rounded py-1">Query History</a>
                </div>

                <div class="text-start">
                    @if(auth()->user()->user_level == 'admin' || 'super admin')
                    <a href="{{ route('artist.show', $artwork->artist->id) }}" class="text-zinc-900 font-medium hover:underline">Back to Your Artworks</a>
                    @else
                    <a href="{{ route('artwork.index') }}" class="text-zinc-900 font-medium hover:underline">Back to Your Artworks</a>
                    @endif
                </div>
                @else
                    @include('partials.query-form')
                @endif
            </div>
        </div>

        @if(auth()->user())
            <div class="text-zinc-900 mt-10">
                @include('partials.query-table', ['queries' => $artwork->queries])
            </div>
        @endif
    </main>
</x-layout>