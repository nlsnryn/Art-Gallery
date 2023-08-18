{{-- @if(request()->ajax())
    <div id="art" class="bg-gray-100 my-4 sm:my-0 lg:w-72 rounded p-2">
    </div>
@else --}}
    <x-card>
        @if (auth()->user())
        <a href="{{ route('artwork.show', $artwork->id) }}">
        @else
        <a href="{{ route('guest.art.show', $artwork->id) }}">
        @endif
            @if($artwork->image)
            <div class="image">
                <img src="{{ asset("storage/$artwork->image") }}" alt="download" class="object-cover h-60 w-full">
            </div>
            @endif
            <div class="text-zinc-900 px-2 py-2">
                <h1 class="font-medium">{{ $artwork->title }}</h1>
                <p class="text-sm">{{ $artwork->description }}</p>

                <div class="flex justify-between mt-4">
                    <div>
                        <h2 class="font-medium">{{ $artwork->artist->user->name }}</h2>
                        <h2 class="text-sm">{{ $artwork->artist->location }}</h2>
                        <h2 class="text-sm font-medium">Query: {{ $artwork->queries->count() }}</h2>
                    </div>
                    <h1 class="font-medium">₱{{ number_format($artwork->price, 2) }}</h1>
                </div>
            </div>
        </a>
    </x-card>
{{-- @endif --}}
