<x-layout>
    <main class="max-w-screen-xl mx-auto p-10">

        @if ($queries->count())
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-sm sm:text-2xl font-medium text-zinc-900">History of Completion Query for this Artwork</h1>
            <a href="{{ route('artwork.show', $artwork->id) }}" class="ml-10 sm:mx-0 px-3 text-sm sm:text-base sm:px-10 bg-zinc-900 hover:bg-zinc-800 text-white rounded py-1">Back</a>
        </div>
        
        <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                       Client Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Client Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Client Mobile Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Changed By
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queries as $query)
                <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $query->client_name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $query->client_email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $query->contact_number }}
                    </td>
                    <td class="px-6 py-4">
                        {{ ucfirst($query->status) }}
                    </td>
                    <td>
                        {{ $query->user->name }} | {{ ucfirst($query->user->user_level) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @else
        <div class="mb-28 text-end">
            <a href="{{ route('artwork.show', $artwork->id) }}" class="px-10 bg-zinc-900 hover:bg-zinc-800 text-white rounded py-2">Back</a>
        </div>
        <h1 class="text-center font-medium text-4xl mt-5 text-zinc-900">Artwork don't have Complete Query yet.</h1>
        @endif
    </div>
</x-layout>