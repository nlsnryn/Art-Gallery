<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="bg-gray-100 rounded-md px-10 text-zinc-900">
            <div class="flex">
                <div class="w-1/4">
                    <img src="{{ asset("storage/$artist->image") }}" alt="artist" class="object-cover w-80 h-auto rounded-md p-5">
                </div>

                <div class="w-3/4 p-5 py-10">
                    <h1 class="font-medium text-5xl tracking-tighter">{{ $artist->user->name }}</h1>
                    <h1 class="font-medium text-3xl tracking-tighter mt-2">{{ $artist->location }}</h1>
                    <h1 class="font-medium text-xl tracking-tighter">Member since: {{ $artist->created_at->format('F d Y') }}</h1>
                    {{-- <h1 class="font-medium text-lg tracking-tighter">Number of sold artworks: </h1> --}}
                    <h1 class="font-medium text-lg tracking-tighter">Number of artworks: {{ $artist->artworks->count() }}</h1>
                </div>            
            </div>
        </div>

        <div class="mt-5 px-10">   
            <h1 class="text-zinc-900 text-2xl uppercase tracking-tight font-medium">Artworks</h1>

            <div class="card-container sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-3 xl:grid xl:grid-cols-4 gap-4 mx-4 mt-5">
                @foreach ($artist->artworks as $artwork)
                    <x-art-card :artwork="$artwork"/>
                @endforeach
            </div>
        </div>
    </main>
</x-layout>