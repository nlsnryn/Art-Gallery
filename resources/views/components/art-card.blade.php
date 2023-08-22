<x-card>
    @if (auth()->user())
        <a href="{{ route('artwork.show', $artwork?->id) }}">
            @if($artwork->image)
            <div class="image">
                <img src="{{ asset("storage/$artwork?->image") }}" alt="download" class="object-cover h-60 w-full">
            </div>
            @endif
            <div class="text-zinc-900 px-2 py-2 flex flex-col justify-between">
                <div class="flex-grow">
                    <h1 class="font-medium">{{ $artwork->title }}</h1>
                    <p class="text-sm line-clamp-2">{{ $artwork?->description }}</p>
                </div>

                <div class="flex justify-between mt-4">
                    <div>
                        <h2 class="font-medium">{{ $artwork?->artist?->user?->name }}</h2>
                        <h2 class="text-xs font-medium">{{ $artwork?->artist?->location }}</h2>
                        <h2 class="text-xs font-medium">Query: {{ $artwork?->queries?->count() }}</h2>
                    </div>
                    <h1 class="font-medium">₱{{ number_format($artwork?->price, 2) }}</h1>
                </div>
            </div>
        </a>
    @else
        <a href="{{ route('guest.art.show', $artwork->id) }}" class="flex flex-col sm:flex-row-reverse justify-between items-start w-full p-5">
            @if($artwork->image)
            <div class="image">
                <img src="{{ asset("storage/$artwork->image") }}" alt="download" class="object-cover h-48 w-full">
            </div>
            @endif
            <div class="px-2 py-2 flex flex-col justify-between w-full sm:w-1/2 2xl:max-w-xl">
                <div class="flex-grow">
                    <h1 class="font-medium text-2xl">{{ $artwork?->title }}</h1>
                    <p class="line-clamp-2 text-base">{{ $artwork?->description }}</p>
                </div>

                <div class="mt-4">
                    <h2 class="font-medium text-lg">{{ $artwork?->artist?->user?->name }}</h2>
                    <h2 class="text-base font-medium">{{ $artwork?->artist?->location }}</h2>
                    <h1 class="font-medium">₱{{ number_format($artwork?->price, 2) }}</h1>
                </div>
            </div>
        </a>
    @endif
</x-card>