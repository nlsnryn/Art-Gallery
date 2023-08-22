<x-layout>
    <main class="max-w-screen-2xl mx-auto p-5 sm:p-10">
        <div class="bg-gray-100 rounded-md px-5 sm:px-10 text-zinc-900">
            <div class="flex 890:flex-row flex-col">
                <div class="lg:w-1/4">
                    <img src="{{ asset("storage/$artist?->image") }}" alt="artist" class="object-cover w-full 890:w-80 h-auto rounded-md py-5">
                </div>

                <div class="lg:w-3/4 pb-5 890:py-10 890:px-10">
                    <h1 class="font-medium text-3xl 890:text-5xl tracking-tighter">{{ $artist?->user?->name }}</h1>
                    <p class="text-sm sm:text-lg text-zinc-900 font-medium tracking-tighter uppercase">Artist</p>
                    <h1 class="font-medium text-xl 890:text-3xl tracking-tighter mt-2">{{ $artist?->location }}</h1>
                    <h1 class="font-medium 890:text-xl tracking-tighter">Member since: {{ $artist?->created_at->format('F d Y') }}</h1>
                    <h1 class="font-medium text-lg tracking-tighter">Number of sold artworks: {{ $sold ? $sold : 0 }}</h1>
                    <h1 class="font-medium 890:text-lg tracking-tighter">Number of artworks: {{ $artist?->artworks?->count() }}</h1>
                </div>            
            </div>
        </div>

        <div class="mt-5 sm:px-10">
            <div class="flex justify-end">
                <a href="{{ route('artwork.create', ['artist_id' => $artist?->id]) }}" class="text-gray-100 font-medium px-5 py-1 bg-zinc-900 rounded hover:bg-zinc-800">Add Artwork</a>
            </div>
            
            <h1 class="text-zinc-900 text-2xl uppercase tracking-tight font-medium">Artworks</h1>

            <div class="card-container sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-3 xl:grid xl:grid-cols-4 gap-4 sm:mx-4 mt-5">
                @forelse ($artist->artworks as $artwork)
                    <x-art-card :artwork="$artwork"/>
                @empty
                    <h1 class="text-center text-zinc-900 font-medium text-2xl mt-20 uppercase tracking-tighter">No Artwork Record yet.</h1>
                @endforelse
            </div>
        </div>
    </main>
</x-layout>