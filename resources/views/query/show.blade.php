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
                        <form id="approve" action="{{ route('query.update', [$artwork->id, $query->id]) }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="approved" />
                            <button class="text-white bg-zinc-900 px-5 py-1 rounded hover:bg-zinc-800">Approve</button>
                        </form>
                        <form id="reject" action="{{ route('query.update', [$artwork->id, $query->id]) }}" method="post">
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

    <script>
        $(document).ready(function() {
            $('#approve').on('submit', function (event) {
                event.preventDefault();
                var form = $(this);
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Query will be approve!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#18181b',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, approve it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Query has been approved.',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        approve(form);
                    }
                })
            });

            $('#reject').on('submit', function (event) {
                event.preventDefault();
                var form = $(this);
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Query will be reject!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#18181b',
                    cancelButtonColor: '#ef4444',
                    confirmButtonText: 'Yes, reject it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Query has been rejected.',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        reject(form);
                    }
                })
            })

            function approve(form) {
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response.message);
                        window.location.href = "{{ route('artwork.show', $artwork->id) }}";
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error:", error);
                        console.log(xhr.responseText);
                    }
                });
            }

            function reject(form) {
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        console.log(response.message);
                        window.location.href = "{{ route('artwork.show', $artwork->id) }}";
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