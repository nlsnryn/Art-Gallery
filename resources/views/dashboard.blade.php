@php
    $dynamicBackground = auth()->user() ? 'bg-red-600' : 'bg-zinc-900';
@endphp

<x-layout>
    @include('partials.hero')
    
    <form id="search-artwork" action="" class="pb-8 px-5 {{ $dynamicBackground }}">
        <x-search :placeholder="'Artwork Title or Categories'"/>
    </form>

    <div class="flex lg:flex-row">
        <div class="mt-1 lg:mt-24">
            @include('partials.categories')
        </div>
        <main class="text-gray-800 mt-16 lg:mt-0">
            <div class="max-w-screen-2xl mx-auto px-10 py-10">
                <div class="mb-6">
                    <h1 class="text-4xl font-semibold text-gray-900 uppercase">Featured Art</h1>
                </div>

                @if(auth()->user())
                    <div id="artwork-container" class="card-container sm:grid sm:grid-cols-2 md:grid-cols-2 lg:grid lg:grid-cols-3 xl:grid xl:grid-cols-4 gap-6 mx-0 overflow-hidden">
                        @foreach ($artworks as $artwork)
                            <x-art-card id="art-card" :artwork="$artwork" />
                        @endforeach
                    </div>
                @else
                    <div id="artwork-container" class="card-container space-y-4 w-full">
                        @foreach ($artworks as $artwork)
                            <x-art-card id="art-card" :artwork="$artwork" />
                        @endforeach
                    </div>
                @endif

                <div id="no-fetch" class="">
                </div>
                @if (!$artworks->count())
                    <h1 class="text-center font-medium text-3xl mt-5 uppercase tracking-tighter">No Artwork Record yet.</h1>
                @endif
            </div>

            <div class="max-w-screen-2xl mx-auto px-10 py-10">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-gray-900 uppercase">Artist</h1>
                </div>

                <div class="sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-3 gap-4 mx-4">
                    @foreach ($artists as $artist)
                        @if ($artist->artworks->count() >= 1)
                            <x-artist-card :artist="$artist" />
                        @endif
                    @endforeach
                </div>

                @if (!$artists->count() && !$artworks->count())
                <h1 class="text-center font-medium text-3xl mt-5 uppercase tracking-tighter -ml-10">No Artist Record yet.</h1>
                @endif
            </div>
        </main>
    </div>
    <script>
        //Dashboard Categories
        // document.getElementById('category-hamburger').addEventListener('click', function () {
        //     document.getElementById('category-menu').classList.toggle('hidden');
        //     document.getElementById('category-ekis').classList.toggle('hidden');
        //     document.getElementById('category-hamburger').classList.toggle('hidden');
        // });

        // document.getElementById('category-ekis').addEventListener('click', function () {
        //     document.getElementById('category-menu').classList.toggle('hidden');
        //     document.getElementById('category-ekis').classList.toggle('hidden');
        //     document.getElementById('category-hamburger').classList.toggle('hidden');
        // });

        $('#category-hamburger').on('click', function () {
            $('#category-menu').toggleClass('hidden');
            $('#category-ekis').toggleClass('hidden');
            $(this).toggleClass('hidden');
        });

        $('#category-ekis').on('click', function () {
            $('#category-menu').toggleClass('hidden');
            $(this).toggleClass('hidden');
            $('#category-hamburger').toggleClass('hidden');
        });

        $(document).ready(function () {
            // Search Artwork for Guest
            $('#search-artwork').submit(function(event) {
                event.preventDefault();
                $value=$('[name="search"]').val();

                console.log($value);
                fetchGuestArtwork($value);
            });

            function fetchGuestArtwork($value) {
                $.ajax({
                    type: "GET",
                    url: "/search-artworks",
                    dataType: "json",
                    data: {'search':$value},
                    success: function (response) {
                        if(response.artworks.length > 0) {
                            $('#no-fetch').empty();
                            $('#artwork-container').empty().append(response.artworks);
                        } else {
                            $('#artwork-container').empty();
                            $('#no-fetch').empty().append('<h1 class="text-center font-medium text-3xl mt-5">No Artwork Record found.</h1>');
                            $('#search-input').val('');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error:", error);
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
</x-layout>

