@php
    $dynamicOverflow = $artists->count() ? 'overflow-x-auto' : ''
@endphp

<x-layout>
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="text-zinc-900 mt-10">
            <h1 class="font-medium text-4xl text-center uppercase tracking-tighter mb-20">Artist Account Restore Management</h1>

            <div class="{{ $dynamicOverflow }}">
                @if ($artists->count())
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 snap-x">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date Deleted
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artists as $artist)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $artist->user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $artist->user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $artist->deleted_at->format('F d, Y') }}
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <form id="restore-artist" method="POST" action="{{ route('artist.restore', $artist) }}">
                                    @csrf
                                    <button type="submit" class="bg-zinc-900 hover:bg-zinc-800 text-sm px-4 py-1 rounded text-white">Restore</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <h1 class="text-center text-zinc-900 font-medium text-5xl mt-20 uppercase tracking-tighter">No Artist Account available to restore.</h1>
                @endif
            </div>

            <div id="no-fetch" class="text-zinc-900 uppercase">
            </div>

            <div class="text-end mt-10">
                <a href="{{ route('artist.index') }}" class="text-zinc-900 hover:underline uppercase tracking-tighter mr-20 font-medium">Back</a>
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            $('#restore-artist').on('submit', function(event) {
                event.preventDefault();
                var form = $(this);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Artist account will be restore.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#18181b',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, restore it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Artist Account has been restored.',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        restoreArtist(form);
                    }
                })
            });
            
            function restoreArtist(form) {
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response.message);
                        window.location.href = "{{ route('artist.restore.index') }}"
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error:", error);
                        console.log(xhr.responseText);
                    }
                });
            }
        })
    </script>
</x-layout>