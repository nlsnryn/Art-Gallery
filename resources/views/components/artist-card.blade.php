<div class="bg-gray-100 rounded flex 2xl:flex-row flex-col text-zinc-900 font-medium my-4 sm:my-0">
    <div>
        <img src="{{ asset("storage/$artist->image") }}" alt="artist" class="2xl:w-auto w-full object-cover 2xl:h-40 h-60">
    </div>

    <div class="p-6 w-full">
        <h1 class="text-xl">{{ $artist->user->name }}</h1>
        <h2 class="text-sm">Member since: {{ $artist->created_at->format('F d Y') }}</h2>
        <h2 class="text-sm">Number of art works: {{ $artist->artworks->count() }}</h2>
        <h2 class="text-sm"></h2>

        <div class="flex justify-end mt-5 gap-2">
            @if (auth()->user())
                <a href="{{ route('artist.show', $artist->id) }}" class="bg-zinc-900 px-6 py-1 rounded text-white">View Info</a>
                <a href="{{ route('artist.edit', $artist->id) }}" class="bg-red-500 px-6 py-1 rounded text-white">Edit</a>
            @else
                <a href="{{ route('guest.artist.show', $artist->id) }}" class="bg-zinc-900 px-6 py-1 rounded text-white">View Info</a>
            @endif
        </div>
    </div>
</div>

