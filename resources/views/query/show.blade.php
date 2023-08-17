<x-layout>
    <main class="max-w-screen-md mx-auto p-10">
        <div class="flex justify-center items-center h-screen -mt-20">
            <div class="bg-gray-100 text-zinc-900 rounded-md p-20">
                <div class="artwork-info mb-5">
                    <h1 class="text-3xl font-medium">{{ $artwork->title }} Query Information</h1>
                    <h2 class="font-medium">{{ ucfirst($artwork->category) }}</h2>
                    <h2 class="font-medium">₱{{ number_format($artwork->price, 2) }}</h2>
                </div>
                
                <p class="font-medium">Inquirer's Information</p>
                <h1 class="text-lg">Name: {{ $query->client_name }}</h1>
                <h1 class="text-lg">Email: {{ $query->client_email }}</h1>
                <h1 class="text-lg">Contact Number: {{ $query->contact_number }}</h1>
                <h1 class="text-lg">Location: {{ $query->location }}</h1>
                <p class="text-lg">Message: <span class="block text-sm font-normal">{{ $query->message }}</span></p>

                <div class="flex justify-end gap-3 mt-10">
                    <div class="flex">
                        <form action="{{ route('query.update', [$artwork->id, $query->id]) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="approved" />
                            <button class="text-white bg-zinc-900 px-5 py-1 rounded hover:bg-zinc-800">Approve</button>
                        </form>
                        <form action="{{ route('query.update', [$artwork->id, $query->id]) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="rejected" />
                            <button class="ml-2 text-white bg-red-700 px-5 py-1 rounded hover:bg-red-600">Reject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>