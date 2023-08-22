<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="bg-gray-100 rounded-md px-5 sm:px-10 text-zinc-900">
            <div class="flex 890:flex-row flex-col">
                <div class="lg:w-1/4">
                    <img src="{{ asset("storage/$artist->image") }}" alt="artist" class="object-cover w-full 890:w-80 h-auto rounded-md py-5">
                </div>

                <div class="lg:w-3/4 pb-5 890:py-10 890:px-10">
                    <h1 class="font-medium text-3xl 890:text-5xl tracking-tighter">{{ $artist->user->name }}</h1>
                    <p class="text-sm sm:text-lg text-zinc-900 font-medium tracking-tighter uppercase">Artist</p>
                    <h1 class="font-medium text-xl 890:text-3xl tracking-tighter mt-2">{{ $artist->location }}</h1>
                    <h1 class="font-medium 890:text-xl tracking-tighter">Member since: {{ $artist->created_at->format('F d Y') }}</h1>
                    <h1 class="font-medium 890:text-lg tracking-tighter">Number of artworks: {{ $artist->artworks->count() }}</h1>
                </div>            
            </div>
        </div>

        <div class="mt-5 px-10">   
            <h1 class="text-zinc-900 text-2xl uppercase tracking-tight font-medium">Artworks</h1>

            <div class="card-container sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-3 xl:grid xl:grid-cols-4 gap-4 mx-4 mt-5">
                @foreach ($artist->artworks as $artwork)
                        <a href="{{ route('guest.art.show', $artwork->id) }}">
                        @if($artwork->image)
                        <div class="image">
                            <img src="{{ asset("storage/$artwork->image") }}" alt="download" class="object-cover h-60 w-full">
                        </div>
                        @endif
                        <div class="text-zinc-900 px-2 py-2 flex flex-col justify-between">
                            <div class="flex-grow">
                                <h1 class="font-medium">{{ $artwork->title }}</h1>
                                <p class="text-sm line-clamp-2">{{ $artwork->description }}</p>
                            </div>
            
                            <div class="flex justify-between mt-4">
                                <div>
                                    <h2 class="font-medium">{{ $artwork->artist->user->name }}</h2>
                                    <h2 class="text-xs font-medium">{{ $artwork->artist->location }}</h2>
                                    <h2 class="text-xs font-medium">Query: {{ $artwork->queries->count() }}</h2>
                                </div>
                                <h1 class="font-medium">₱{{ number_format($artwork->price, 2) }}</h1>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
</x-layout>