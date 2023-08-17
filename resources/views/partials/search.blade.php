@php
    $dynamicClass = auth()->check() ? 'bg-transparent px-0 sm:px-10' : 'bg-red-500 px-5';

    $dynamicPlaceholder = (request()->getRequestUri() == '/artist' ? 'Artist Name' : 
                     ((request()->getRequestUri() == '/admin') ? 'Admin Name or Email' : 
                     ((request()->getRequestUri() == '/artwork' ? 'Artwork Title or Categories' : 
                     (request()->getRequestUri() == '/' ? 'Artwork Title or Categories' : '')))));

    $dynamicAction = (request()->getRequestUri() == '/artist') ? request()->getRequestUri() : 
                    ((request()->getRequestUri() == '/admin') ? request()->getRequestUri() : request()->getRequestUri());
@endphp

<form id="search-form" action="{{ $dynamicAction }}" class="pb-8 {{ $dynamicClass }}">
    <div class="max-w-screen-2xl mx-auto px-0 sm:px-10">
        <div class="relative border-2 border-gray-100 rounded-lg">
            <div class="absolute top-4 left-3">
                <i
                    class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                ></i>
            </div>
            <input
                type="text"
                name="search"
                class="h-14 w-full placeholder:text-zinc-900 placeholder:text-xs sm:placeholder:text-sm md:placeholder:text-base text-zinc-900 bg-white pl-10 pr-20 rounded-lg z-0 focus:shadow-none focus:outline-none"
                placeholder="Search {{ $dynamicPlaceholder }}"
            />
            <div class="absolute top-2 right-2">
                <button
                    type="submit"
                    class="h-10 w-20 text-white rounded-lg text-sm bg-red-500 hover:bg-red-600"
                >
                    Search
                </button>
            </div>
        </div>
    </div>
</form>