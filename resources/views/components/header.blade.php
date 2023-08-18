<header class="bg-red-600">
    <nav class="max-w-screen-2xl mx-auto py-5">
        <div class="text-gray-100 flex justify-between items-center px-10">
            <div id="logo" class="">
                <h1 class="text-xl md:text-4xl font-medium tracking-tight">Art Gallery</h1>
            </div>
            
            <button id="nav-hamburger" class="sm:hidden text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <button id="nav-ekis" class="hidden text-white">
                <i class="fa-solid fa-xmark"></i>
            </button>
                        
            <div class="hidden sm:block">
            @if (auth()->user())
                <div class="flex items-center gap-5">
                    <h1 class="hidden md:block mt-0.5 text-white text-sm lg:text-lg font-medium uppercase tracking-wide">Hello! {{ auth()->user()->user_level }}, Nelson Ryan</h1>

                    @if (auth()->user()->user_level == 'super admin')
                        <a href="{{ route('admin.index') }}">
                            <button class="text-white text-sm lg:text-lg font-medium uppercase tracking-wide hover:underline cursor-pointer">DASHBOARD</button>
                        </a>
                    @elseif (auth()->user()->user_level == 'admin')
                        <a href="{{ route('artist.index') }}">
                            <button class="text-white text-sm lg:text-lg font-medium uppercase tracking-wide hover:underline cursor-pointer">DASHBOARD</button>
                        </a>
                    @else 
                        <a href="{{ route('artwork.index') }}">
                            <button class="text-white text-sm lg:text-lg font-medium uppercase tracking-wide hover:underline cursor-pointer">DASHBOARD</button>
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white text-sm lg:text-lg font-medium uppercase tracking-wide hover:underline cursor-pointer">Logout</button>
                    </form>
                </div>
            @else
                <div class="space-x-4">
                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-block text-white rounded-xl uppercase mt-2 hover:underline cursor-pointer tracking-tighter font-medium"
                        >Artworks and artist</a
                    >
                    <a
                        href="{{ route('login') }}"
                        class="inline-block text-white rounded-xl uppercase mt-2 hover:underline cursor-pointer tracking-tighter font-medium"
                        >Sign In</a
                    >
                    <a
                        href="{{ route('register') }}"
                        class="inline-block text-white rounded-xl uppercase mt-2 hover:underline cursor-pointer tracking-tighter font-medium"
                        >Sign Up to Post Art</a
                    >
                </div>
            @endif
            </div>    

        </div>
    </nav>
</header>

<nav id="nav-menu" class="bg-red-600 px-10 py-5 absolute inset-x-0 hidden transition-all duration-150 ease-out">
    @if (auth()->user())
        <div class="flex items-center justify-center gap-5">
            <h1 class="mt-0.5 text-white text-sm lg:text-lg font-medium uppercase tracking-wide">Hello! {{ auth()->user()->user_level }}, Nelson Ryan</h1>

            @if (auth()->user()->user_level == 'super admin')
                <a href="{{ route('admin.index') }}">
                    <button class="text-white text-sm lg:text-lg font-medium uppercase tracking-wide hover:underline cursor-pointer">DASHBOARD</button>
                </a>
            @elseif (auth()->user()->user_level == 'admin')
                <a href="{{ route('artist.index') }}">
                    <button class="text-white text-sm lg:text-lg font-medium uppercase tracking-wide hover:underline cursor-pointer">DASHBOARD</button>
                </a>
            @else 
                <a href="{{ route('artwork.index') }}">
                    <button class="text-white text-sm lg:text-lg font-medium uppercase tracking-wide hover:underline cursor-pointer">DASHBOARD</button>
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white text-sm lg:text-lg font-medium uppercase tracking-wide hover:underline cursor-pointer">Logout</button>
            </form>
        </div>
    @else
    <div class="space-x-4 flex justify-center items-center">
        <a
            href="{{ route('dashboard') }}"
            class="inline-block text-white rounded-xl uppercase mt-2 hover:underline cursor-pointer tracking-tighter font-medium"
            >Dashboard</a
        >
        <a
            href="{{ route('login') }}"
            class="inline-block text-white rounded-xl uppercase mt-2 hover:underline cursor-pointer tracking-tighter font-medium"
            >Sign In</a
        >
        <a
            href="{{ route('register') }}"
            class="inline-block text-white rounded-xl uppercase mt-2 hover:underline cursor-pointer tracking-tighter font-medium"
            >Sign Up to Post Art</a
        >
    </div>
    @endif
</nav>


