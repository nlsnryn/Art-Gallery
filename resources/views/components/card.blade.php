@if (auth()->user())
<div id="card-template" class="bg-gray-100 my-4 sm:my-0 lg:w-72 rounded p-2 h-full">
    {{ $slot }}
</div>
@else
<div id="card-template" class="bg-gray-100 hover:bg-zinc-900 my-4 sm:my-0 rounded p-2 space-y-4 transition-all duration-150 ease-out text-zinc-900 hover:text-white">
    {{ $slot }}
</div>
@endif