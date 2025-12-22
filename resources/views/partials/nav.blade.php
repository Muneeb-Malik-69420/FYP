@php
    // Detect if we are on any authentication routes to keep the navbar solid
    $isSolidNav = request()->routeIs(['login', 'register', 'password.*', 'two-factor.*']);
@endphp

<nav id="navbar" data-solid="{{ $isSolidNav ? 'true' : 'false' }}"
    class="fixed top-0 left-0 w-full z-[100] transition-all duration-300 ease-in-out px-8 flex items-center justify-between
     {{ $isSolidNav ? 'bg-white/95 backdrop-blur-md text-gray-800 shadow-md py-2' : 'bg-transparent text-white py-4' }}">

    <a href="{{ Route::has('Home') ? Route('Home') : '#' }}" class="flex items-center gap-2 cursor-pointer z-50">
        <div
            class="w-10 h-10 bg-gradient-to-br from-[#52c234] to-[#0f711c] rounded-full flex items-center justify-center text-white shadow-lg transform transition-transform duration-300 hover:scale-110">
            <i class="fas fa-leaf text-lg"></i>
        </div>
        <span class="font-extrabold text-2xl tracking-wide drop-shadow-md transition-colors duration-300"
            id="nav-logo-text">
            Eco<span class="text-[#52c234]">Bite</span>
        </span>
    </a>

    <div class="hidden lg:flex items-center gap-8 text-sm font-bold tracking-wide">

        <a href="{{ Route::has('Home') ? Route('Home') : '#' }}"
            class="hover:text-[#52c234] transition-colors relative group">
            Home
            <span
                class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#52c234] transition-all duration-300 group-hover:w-full {{ request()->routeIs('Home') ? 'w-full' : '' }}"></span>
        </a>

        <div class="group relative py-4">
            <a href="{{ Route::has('Browse') ? Route('Browse') : '#' }}"
                class="flex items-center gap-1 hover:text-[#52c234] transition-colors relative">
                Browse <i
                    class="fas fa-chevron-down text-[10px] opacity-70 group-hover:rotate-180 transition-transform duration-300"></i>
                <span
                    class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#52c234] transition-all duration-300 group-hover:w-full {{ request()->routeIs('Browse') ? 'w-full' : '' }}"></span>
            </a>

            <div
                class="absolute top-full left-1/2 -translate-x-1/2 w-[600px] bg-white text-gray-800 rounded-2xl shadow-2xl p-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-4 group-hover:translate-y-0 overflow-hidden border-t-4 border-[#0f711c]">
                <div class="grid grid-cols-12">
                    <div class="col-span-7 p-6 border-r border-gray-100">
                        <h4 class="text-[#0f711c] font-bold uppercase text-xs mb-4 tracking-wider">Explore Categories
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="#"
                                    class="flex items-center gap-3 hover:bg-green-50 p-2 rounded-lg transition-colors group/item">
                                    <span
                                        class="w-8 h-8 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center group-hover/item:bg-orange-500 group-hover/item:text-white transition-colors"><i
                                            class="fas fa-bread-slice"></i></span>
                                    <div>
                                        <span class="block font-bold text-sm">Bakeries</span>
                                        <span class="block text-[10px] text-gray-400">Pastries, Bread, Cakes</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center gap-3 hover:bg-green-50 p-2 rounded-lg transition-colors group/item">
                                    <span
                                        class="w-8 h-8 rounded-full bg-red-100 text-red-500 flex items-center justify-center group-hover/item:bg-red-500 group-hover/item:text-white transition-colors"><i
                                            class="fas fa-utensils"></i></span>
                                    <div>
                                        <span class="block font-bold text-sm">Meals</span>
                                        <span class="block text-[10px] text-gray-400">Rice, Curries, Fast Food</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center gap-3 hover:bg-green-50 p-2 rounded-lg transition-colors group/item">
                                    <span
                                        class="w-8 h-8 rounded-full bg-green-100 text-green-500 flex items-center justify-center group-hover/item:bg-green-500 group-hover/item:text-white transition-colors"><i
                                            class="fas fa-leaf"></i></span>
                                    <div>
                                        <span class="block font-bold text-sm">Vegetarian</span>
                                        <span class="block text-[10px] text-gray-400">Salads, Healthy Options</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-span-5 bg-gray-50 p-6 flex flex-col justify-between">
                        <div>
                            <h4 class="text-[#0f711c] font-bold uppercase text-xs mb-3">Trending Now 🔥</h4>
                            <div
                                class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow cursor-pointer">
                                <div class="flex gap-3">
                                    <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=100&q=60"
                                        class="w-12 h-12 rounded-lg object-cover">
                                    <div>
                                        <p class="font-bold text-xs text-gray-800">Mystery Box</p>
                                        <p class="text-[10px] text-gray-500">Gloria Jeans</p>
                                        <span
                                            class="text-[10px] font-bold text-red-500 bg-red-50 px-1.5 py-0.5 rounded">-50%
                                            OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ Route::has('Browse') ? Route('Browse') : '#' }}"
                            class="text-xs font-bold text-[#0f711c] hover:underline mt-4">View All Deals <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ Route::has('Blog') ? Route('Blog') : '#' }}"
            class="hover:text-[#52c234] transition-colors relative group">
            Blog
            <span
                class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#52c234] transition-all duration-300 group-hover:w-full {{ request()->routeIs('Blog') ? 'w-full' : '' }}"></span>
        </a>

        <a href="{{ Route::has('Contact') ? Route('Contact') : '#' }}"
            class="hover:text-[#52c234] transition-colors relative group">
            Contact
            <span
                class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#52c234] transition-all duration-300 group-hover:w-full {{ request()->routeIs('Contact') ? 'w-full' : '' }}"></span>
        </a>

        <div class="pl-4 border-l {{ $isSolidNav ? 'border-gray-300' : 'border-white/20' }} h-6 flex items-center">
            <div class="relative group">
                <input type="text" placeholder="Search..."
                    class="rounded-full pl-9 pr-4 py-1.5 w-32 text-xs focus:w-48 outline-none transition-all duration-300 shadow-sm
                       {{ $isSolidNav
                           ? 'bg-gray-100 border-transparent placeholder-gray-500 text-gray-800 focus:bg-white focus:ring-1 focus:ring-[#0f711c]'
                           : 'bg-white/20 backdrop-blur-md border border-white/30 placeholder-gray-200 focus:bg-white focus:text-gray-800 focus:placeholder-gray-500' }}"
                    id="nav-search">
                <i class="fas fa-search absolute left-3 top-2 text-[10px] transition-colors duration-300 group-focus-within:text-gray-500 {{ $isSolidNav ? 'text-gray-500' : 'text-gray-200' }}"
                    id="nav-search-icon"></i>
            </div>
        </div>
    </div>

    <div class="flex items-center gap-5">

        <div class="hidden md:block group relative py-4 cursor-pointer">
            <div class="flex items-center gap-1 hover:text-[#52c234] transition-colors">
                <i class="fas fa-globe"></i>
                <span class="text-xs font-bold uppercase">EN</span>
                <i class="fas fa-chevron-down text-[10px]"></i>
            </div>
            <div
                class="absolute right-0 top-full w-24 bg-white shadow-xl rounded-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 border border-gray-100 text-sm z-50">
                <a href="#"
                    class="block px-4 py-2 hover:bg-gray-50 text-[#0f711c] font-bold text-gray-800">English</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-gray-600">Urdu</a>
            </div>
        </div>
        <a href="#" class="relative hover:scale-110 transition-transform duration-300 group">
            <i class="fas fa-shopping-cart text-xl group-hover:text-[#52c234] transition-colors"></i>
            <span
                class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-md animate-bounce">
                0
            </span>
        </a>
        {{-- SEGMENTED TOGGLE COMPONENT --}}
        <div class="hidden md:flex items-center bg-gray-200/50 p-1 rounded-lg border border-gray-300/50 shadow-inner">
            <a href="{{ route('register') }}"
                class="px-5 py-1.5 rounded-md text-xs font-bold transition-all duration-300
               {{ request()->routeIs('register') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                Signup
            </a>
            <a href="{{ route('login') }}"
                class="px-5 py-1.5 rounded-md text-xs font-bold transition-all duration-300
               {{ request()->routeIs('login') ? 'bg-[#0f711c] text-white shadow-md' : 'text-gray-500 hover:text-gray-700' }}">
                Login
            </a>
        </div>



        <div class="lg:hidden text-2xl cursor-pointer hover:text-[#52c234] transition-colors">
            <i class="fas fa-bars"></i>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navbar = document.getElementById('navbar');
        const navSearch = document.getElementById('nav-search');
        const navSearchIcon = document.getElementById('nav-search-icon');

        if (navbar.getAttribute('data-solid') === 'true') {
            return;
        }

        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.remove('bg-transparent', 'text-white', 'py-4');
                navbar.classList.add('bg-white/95', 'backdrop-blur-md', 'text-gray-800', 'shadow-md',
                    'py-2');

                navSearch.classList.remove('bg-white/20', 'border-white/30', 'placeholder-gray-200');
                navSearch.classList.add('bg-gray-100', 'border-transparent', 'placeholder-gray-500',
                    'text-gray-800');
                navSearchIcon.classList.remove('text-gray-200');
                navSearchIcon.classList.add('text-gray-500');
            } else {
                navbar.classList.add('bg-transparent', 'text-white', 'py-4');
                navbar.classList.remove('bg-white/95', 'backdrop-blur-md', 'text-gray-800', 'shadow-md',
                    'py-2');

                navSearch.classList.add('bg-white/20', 'border-white/30', 'placeholder-gray-200');
                navSearch.classList.remove('bg-gray-100', 'border-transparent', 'placeholder-gray-500',
                    'text-gray-800');
                navSearchIcon.classList.add('text-gray-200');
                navSearchIcon.classList.remove('text-gray-500');
            }
        });
    });
</script>
