@php
    $dynamicBackground = auth()->user() ? 'bg-red-600' : 'bg-zinc-900';
@endphp

<footer class="{{ $dynamicBackground }}">
    <div class="max-w-screen-2xl mx-auto px-10">
        <div class="flex justify-center items-center max-w-2xl mx-auto">
            <div class="text-center py-10 text-white">
                <h1 class="sm:text-4xl text-3xl font-medium sm:mb-8 mb-4">Art Gallery Website</h1>
                <p class="sm:text-lg text-sm leading-tight">Discover a captivating world of artistic expression on our website, showcasing a diverse collection of masterpieces across genres, created by talented artists worldwide.</p>
            </div>
        </div>
    </div>
</footer>