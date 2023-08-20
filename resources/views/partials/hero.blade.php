@php
    $dynamicBackground = auth()->user() ? 'bg-red-600' : 'bg-zinc-900';
@endphp

<section
    class="h-72 flex flex-col justify-center align-center text-center space-y-4 {{ $dynamicBackground }}"
>
    <div>
        <h1 class="text-6xl font-bold uppercase text-white">
            Art<span class="text-orange-500"> Gallery</span>
        </h1>
        <p class="text-2xl text-gray-200 font-bold my-4 uppercase">
            Find or post Arts
        </p>
    </div>
</section>