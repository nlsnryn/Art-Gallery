<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="text-zinc-900 py-10 text-center">
            <h1 class="text-4xl font-medium uppercase tracking-tighter">Showcase your Art Works</h1>
        </div>

        <form id="auth-search-artwork" action="" class="pb-8 bg-transparent px-0 sm:px-10">
            <x-search :placeholder="'Artwork Title or Categories'"/>
        </form>

        <div class="flex justify-end">
            <a href="{{ route('artwork.create') }}" class="text-gray-100 font-medium px-5 py-2 bg-zinc-900 rounded hover:bg-zinc-800">Add Artwork</a>
        </div>

        <h1 id="artwork-title" class="text-3xl text-zinc-900 font-semibold tracking-tighter mb-10">Your Art Works</h1>
        
        <div id="auth-artwork" class="card-container sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-3 xl:grid xl:grid-cols-4 gap-4 mx-4">
            @foreach ($artworks as $artwork)
                <x-art-card :artwork="$artwork"/>
            @endforeach
        </div>

        <div id="no-fetch" class="text-zinc-900 uppercase">
        </div>

        @unless ($artworks->count())
            <h1 class="text-center text-zinc-900 font-medium text-5xl mt-20 uppercase tracking-tighter">No Artwork Record yet.</h1>
        @endunless
    </main>

    <script>
        $(document).ready(function () {
            // Search Artwork for Authenticated
            $('#auth-search-artwork').submit(function(event) {
                event.preventDefault();
                $value=$('[name="search"]').val();

                console.log($value);
                fetchAuthArtwork($value);
            });

 
            function fetchAuthArtwork($value) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('auth.search.artworks') }}",
                    dataType: "json",
                    data: {'search':$value},
                    success: function (response) {
                        if(response.artworks.length > 0) {
                            $('#no-fetch').empty();
                            $('#auth-artwork').empty().append(response.artworks);
                            $('#artwork-title').empty().append('Your Art Works')
                        } else {
                            $('#auth-artwork').empty();
                            $('#no-fetch').empty().append('<h1 class="text-center font-medium text-3xl mt-5">No Artwork Record found.</h1>');
                            $('#search-input').val('');
                            $('#artwork-title').empty();
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