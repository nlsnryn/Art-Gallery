<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ $admin->name }}
    </td>

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