<div class="mt-10">
    @if ($queries->count())
    <h1 class="text-2xl font-medium mb-5">All Query for this Artwork</h1>

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Mobile Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    View Info
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
                <td class="px-6 py-4">
                    <a href="{{ route('query.show', ['artwork' => $query->artwork->id, 'query' => $query->id]) }}" class="bg-zinc-900 text-sm px-4 py-1 rounded text-white">Show</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h1 class="text-center font-medium text-4xl mt-20">Artwork don't have Queries yet.</h1>
    @endif
</div>