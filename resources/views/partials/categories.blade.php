<main class="text-gray-800 bg-zinc-900 rounded-br-md absolute lg:static transition-all duration-150 ease-in-out">
    <div class="max-w-md px-10 py-5">
        <button id="category-hamburger" class="lg:hidden text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <h1 class="text-sm uppercase tracking-tighter font-medium">Check Categories</h1>
        </button>

        <button id="category-ekis" class="hidden text-white">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div id="category-menu" class="category py-10 hidden lg:block">
            <h1 class="text-3xl font-medium text-gray-100 mb-5">Explore our Categories</h1>
            
            <ul class="uppercase px-4 flex flex-col gap-4 mx-auto text-center text-gray-100">
            {{-- <ul class="uppercase px-4 flex flex-wrap gap-2 sm:px-6 md:px-8 xl:px-0 text-lg font-medium tracking-tight grid-cols-1 md:grid sm:grid-cols-4 md:grid-cols-4 lg:grid lg:grid-cols-4 xl:grid xl:grid-cols-4 mx-auto text-center"> --}}
                <a href="/?category=paintings">
                    <li class="w-full px-3 py-2 border-2 border-gray-700 rounded cursor-pointer bg-gray-700 hover:bg-gray-500 px-30 transition-all duration-150 ease-out">
                        Paintings
                    </li>
                </a>
                <a href="/?category=drawings">
                    <li class="w-full px-3 py-2 border-2 border-gray-700 rounded cursor-pointer bg-gray-700 hover:bg-gray-500 px-30 transition-all duration-150 ease-out">
                        Drawings
                    </li>
                </a>
                <a href="/?category=digital arts">
                    <li class="w-full px-3 py-2 border-2 border-gray-700 rounded cursor-pointer bg-gray-700 hover:bg-gray-500 px-30 transition-all duration-150 ease-out">
                        Digital Arts
                    </li>
                </a>
                
                <a href="/?category=sculptures">
                    <li class="w-full px-3 py-2 border-2 border-gray-700 rounded cursor-pointer bg-gray-700 hover:bg-gray-500 transition-all duration-150 ease-out">
                        Sculptures
                    </li>
                </a>
            </ul>
            
        </div>
    </div>
</main>