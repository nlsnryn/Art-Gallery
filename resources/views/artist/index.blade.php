<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="text-zinc-900 py-10 text-center">
            <h1 class="text-xl md:text-3xl lg:text-4xl font-medium uppercase tracking-tighter">Manage Artist, Artwork and Queries</h1>
        </div>

        <form id="auth-search-artist" action="" class="pb-8 bg-transparent px-0 sm:px-10">
            <x-search :placeholder="'Artist Name'"/>
        </form>

        <div class="flex justify-end">
            <a href="{{ route('artist.create') }}" class="bg-zinc-900 text-white rounded px-5 py-2 font-semibold uppercase text-sm tracking-wide hover:bg-zinc-800">
                Add Artist
            </a>
        </div>

        <h1 id="artist-title" class="text-3xl text-zinc-900 font-semibold tracking-tighter mb-10">Artists</h1>

        <div id="auth-artist" class="sm:grid sm:grid-cols-2 lg:grid lg:grid-cols-3 gap-4 mx-4">
            @foreach ($artists as $artist)
                <x-artist-card :artist="$artist"/>    
            @endforeach
        </div>

        <div id="no-fetch" class="text-zinc-900 uppercase">
        </div>

        @unless ($artists->count())
            <h1 class="text-center text-zinc-900 font-medium text-5xl mt-20 uppercase tracking-tighter">No Artist Record yet.</h1>
        @endunless
    </main>

    <script>
        $(document).ready(function () {
            // Search Artist for Authenticated
            $('#auth-search-artist').submit(function(event) {
                event.preventDefault();
                $value=$('[name="search"]').val();

                console.log($value);
                fetchAuthArtist($value);
            });

 
            function fetchAuthArtist($value) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('auth.search.artists') }}",
                    dataType: "json",
                    data: {'search':$value},
                    success: function (response) {
                        if(response.artists.length > 0) {
                            $('#no-fetch').empty();
                            $('#auth-artist').empty().append(response.artists);
                            $('#artist-title').empty().append('Your Art Works')
                        } else {
                            $('#auth-artist').empty();
                            $('#no-fetch').empty().append('<h1 class="text-center font-medium text-3xl mt-5">No Artist Record found.</h1>');
                            $('#search-input').val('');
                            $('#artist-title').empty();
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