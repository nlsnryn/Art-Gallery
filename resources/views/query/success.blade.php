<x-layout>
    <main class="max-w-screen-md mx-auto p-10">
        <div class="flex justify-center items-center h-screen -mt-28">
            <div class="bg-gray-100 text-zinc-900 rounded-md p-28">
                <h1 class="text-3xl text-zinc-900 font-semibold uppercase tracking-tight">Sent Successfully</h1>
                <p class="text-center font-medium">Kindly wait for artist approval</p>
                <div class="flex flex-col justify-center items-center mt-5">
                    <i class="fa-solid fa-circle-check text-5xl text-zinc-800"></i>
                </div>

                <div class="mt-10 flex justify-center items-center">
                    <a href="{{ route('guest.art.show', $artwork) }}" class="bg-zinc-900 hover:bg-zinc-800 rounded-md px-10 py-2 text-white text-center">Return to Artwork</a>
                </div>
            </div>
        </div>
    </main>
</x-layout>