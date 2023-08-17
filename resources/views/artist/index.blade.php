<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="text-zinc-900 py-10 text-center">
            <h1 class="text-xl md:text-3xl lg:text-4xl font-medium uppercase tracking-tighter">Manage Artist, Artwork and Queries</h1>
        </div>

        @include('partials.search')

        <div class="flex justify-end">
            <a href="{{ route('artist.create') }}" class="bg-zinc-900 rounded px-5 py-2 font-semibold uppercase text-sm tracking-wide hover:bg-zinc-800">
                Add Artist
            </a>
        </div>

        <h1 class="text-3xl text-zinc-900 font-semibold tracking-tighter mb-10">Artists</h1>

        <div class="sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-3 gap-4 mx-4">
            @foreach ($artists as $artist)
                <x-artist-card :artist="$artist"/>    
            @endforeach
        </div>

        @unless ($artists->count())
            <h1 class="text-center text-zinc-900 font-medium text-5xl mt-20 uppercase tracking-tighter">No Artist Record yet.</h1>
        @endunless
    </main>
</x-layout>