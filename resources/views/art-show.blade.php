<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="flex flex-shrink-0 gap-5 text-zinc-900">
            @if ($artwork->image)
                <div class="w-1/2 image">
                    <img src="{{ asset("storage/$artwork->image") }}" alt="Artwork" class="w-full object-fill h-auto rounded">
                </div>
            @endif
        
            <div class="bg-gray-100 w-1/2 rounded p-20">
                <h1 class="font-medium text-2xl uppercase tracking-tight">{{ $artwork->title }}</h1>
                <p class="font-normal text-lg leading-tight mt-5">{{ $artwork->description }}</p>
                <h4 class="uppercase font-medium text-sm tracking-wide mt-5">Date publish: {{ $artwork->created_at->format('F d Y') }}</h4>
                <h4 class="uppercase font-medium text-sm tracking-wide mt-1">Price: ₱{{ number_format($artwork->price, 2) }}</h4>

                <div class="artist-info mt-5">
                    <h1 class="font-medium text-xl uppercase tracking-tight">{{ $artwork->artist->user->name }}</h1>
                    <h4 class="uppercase font-medium text-sm tracking-wide mt-1">{{ $artwork->artist->location }}</h4> 
                    <h4 class="uppercase font-medium text-sm tracking-wide mt-1">Member since: {{ $artwork->artist->created_at->format('F d Y') }}</h4> 
                </div>

                @include('partials.query-form')
            </div>
        </div>
    </main>
</x-layout>