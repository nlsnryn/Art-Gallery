<x-layout>    
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="text-zinc-900 py-10 text-center">
            <h1 class="sm:text-4xl text-2xl font-medium uppercase tracking-wide">Super Admin! Manage all</h1>
            <div class="space-y-2 sm:space-y-0 sm:space-x-2 mt-5 flex flex-col sm:flex-row justify-center items-center">
                <a href="{{ route('admin.index') }}" class="text-xl font-medium uppercase border-2 border-zinc-900 px-4 py-1 rounded-md cursor-pointer hover:bg-red-500 hover:text-gray-100 hover:border-red-500 tracking-tighter transition-all ease-in-out duration-150">Manage Admin</a>
                <a href="{{ route('artist.index') }}" class="text-xl font-medium uppercase border-2 border-zinc-900 px-4 py-1 rounded-md cursor-pointer hover:bg-red-500 hover:text-gray-100 hover:border-red-500 tracking-tighter transition-all ease-in-out duration-150">Manage Artist</a>
            </div>
        </div>

        @include('partials.search')

        <div class="text-zinc-900">
            <div class="flex justify-end mb-5">
                <a href="{{ route('admin.create') }}" class="bg-zinc-900 text-white text-xs sm:text-base px-4 py-2 rounded hover:bg-zinc-800">Create Admin Account</a>
            </div>

            <div class="overflow-x-auto">
                @if ($admins->count())
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
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($admins as $admin)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $admin->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $admin->email }}
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.edit', $admin->id) }}" class="bg-zinc-900 text-sm px-4 py-1 rounded text-white">Edit</a>
                                <form method="POST" action="{{ route('admin.destroy', $admin->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-700 text-sm px-4 py-1 rounded text-white">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif

                @unless ($admins->count())
                <h1 class="text-center text-zinc-900 font-medium text-5xl mt-20 uppercase tracking-tighter">No Admin Account Record yet.</h1>
                @endunless
            </div>
        </div>
    </main>
</x-layout>