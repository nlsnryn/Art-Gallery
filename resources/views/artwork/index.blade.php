<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="text-zinc-900 py-10 text-center">
            <h1 class="text-4xl font-medium uppercase tracking-tighter">Showcase your Art Works</h1>
        </div>

        @include('partials.search')

        <div class="flex justify-end">
            <a href="{{ route('artwork.create') }}" class="text-gray-100 font-medium px-5 py-2 bg-zinc-900 rounded hover:bg-zinc-800">Add Artwork</a>
        </div>

        <h1 class="text-3xl text-zinc-900 font-semibold tracking-tighter mb-10">Your Art Works</h1>
        
        <div class="card-container sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-3 xl:grid xl:grid-cols-4 gap-4 mx-4">
            @foreach ($artworks as $artwork)
                <x-art-card :artwork="$artwork"/>
            @endforeach
        </div>

        @unless ($artworks->count())
            <h1 class="text-center text-zinc-900 font-medium text-5xl mt-20 uppercase tracking-tighter">No Artwork Record yet.</h1>
        @endunless
    </main>
</x-layout>