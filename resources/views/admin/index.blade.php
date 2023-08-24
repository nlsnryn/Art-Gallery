<x-layout>    
    <main class="max-w-screen-2xl mx-auto p-10">
        <div class="text-zinc-900 py-10 text-center">
            <div class="space-y-2 sm:space-y-0 sm:space-x-2 mt-5 flex flex-col sm:flex-row justify-center items-center">
                <a href="{{ route('admin.index') }}" class="text-xl font-medium uppercase border-2 border-zinc-900 px-4 py-1 rounded-md cursor-pointer hover:bg-red-500 hover:text-gray-100 hover:border-red-500 tracking-tighter transition-all ease-in-out duration-150">Manage Admin</a>
                <a href="{{ route('artist.index') }}" class="text-xl font-medium uppercase border-2 border-zinc-900 px-4 py-1 rounded-md cursor-pointer hover:bg-red-500 hover:text-gray-100 hover:border-red-500 tracking-tighter transition-all ease-in-out duration-150">Manage Artist</a>
            </div>

            <h1 class="sm:text-4xl text-2xl font-medium uppercase tracking-tighter mt-10">Admin management</h1>
        </div>

        <form id="auth-search-admin" action="" class="pb-8 bg-transparent px-0 sm:px-10">
            <x-search :placeholder="'Admin Name or Email'"/>
        </form>

        <div class="text-zinc-900">
            <div class="flex justify-end mb-5">
                <a href="{{ route('admin.create') }}" class="bg-zinc-900 text-white text-xs sm:text-base px-4 py-2 rounded hover:bg-zinc-800">Create Admin Account</a>
                <a href="{{ route('admin.restore.index') }}" class="bg-red-600 text-white ml-2 px-3 py-1 rounded">
                    <i class="fa-solid fa-trash text-lg mt-1.5"></i>
                </a>
            </div>

            <div class="overflow-x-auto overflow-hidden">
                <div id="auth-admin">
                </div>

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
                                    <form id="delete-admin" method="POST" action="{{ route('admin.destroy', $admin->id) }}">
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

                <div id="no-fetch" class="text-zinc-900 uppercase">
                </div>

                @unless ($admins->count())
                <h1 id="no-admin" class="text-center text-zinc-900 font-medium text-5xl mt-20 uppercase tracking-tighter">No Admin Account Record yet.</h1>
                @endunless
            </div>
        </div>
    </main>

    <script>
        $(document).ready(function () {
            // Search Admin for Authenticated
            $('#auth-search-admin').submit(function(event) {
                event.preventDefault();
                $value=$('[name="search"]').val();

                console.log($value);
                fetchAuthAdmin($value);
            });

 
            function fetchAuthAdmin($value) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('auth.search.admins') }}",
                    dataType: "json",
                    data: {'search':$value},
                    success: function (response) {
                        if(response.admins.length > 0) {
                            $('#no-fetch').empty();
                            $('tbody').empty().append(response.admins);
                            $('thead').empty().append(`
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
                            `);
                        } else {
                            $('tbody').empty();
                            $('#no-admin').empty();
                            $('#no-fetch').empty().append('<h1 class="text-center font-medium text-3xl mt-5">No Admin Record found.</h1>');
                            $('#search-input').val('');
                            $('thead').empty();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error:", error);
                        console.log(xhr.responseText);
                    }
                });
            }

            // Delete Admin

            $('body').on('submit', '#delete-admin', function(event) {
                event.preventDefault();
                var form = $(this);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Admin account will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#18181b',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Admin Account has been deleted.',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        deleteAdmin(form)
                    }
                })
            });

            function deleteAdmin(form) {
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response.message);
                        window.location.href = "{{ route('admin.index') }}";
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error:", error);
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
</x-layout>