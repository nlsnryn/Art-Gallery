<x-layout>
    @include('partials.hero')
    
    <form id="search-artwork" action="" class="pb-8 bg-red-500 px-5">
        <x-search :placeholder="'Artwork Title or Categories'"/>
    </form>

    @include('partials.categories')
    <main class="text-gray-800 ">
        <div class="max-w-screen-2xl mx-auto px-10 py-10">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 uppercase">Featured Art</h1>
            </div>

            <div id="artwork-container" class="card-container sm:grid sm:grid-cols-2 md:grid-cols-2 lg:grid lg:grid-cols-3 xl:grid xl:grid-cols-4 gap-6 mx-0 overflow-hidden">
                @foreach ($artworks as $artwork)
                    <x-art-card id="art-card" :artwork="$artwork" />
                @endforeach
            </div>

            <div id="no-fetch" class="">
            </div>
            @if (!$artworks->count())
                <h1 class="text-center font-medium text-3xl mt-5">No Artwork Record yet.</h1>
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

            @if (!$artists->count())
            <h1 class="text-center font-medium text-3xl mt-5">No Artist Record yet.</h1>
            @endif
        </div>
    </main>

    <script>
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

