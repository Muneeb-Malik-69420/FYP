<nav id="navbar"
    x-data="{ mobileOpen: false }"
    class="sticky top-0 left-0 w-full z-[100] bg-white border-b border-gray-200/80 px-8 flex items-center justify-between py-3 transition-all duration-300">

    {{-- LEFT LOGO --}}
    <a href="{{ route('Home') }}"
       class="flex items-center gap-2.5 shrink-0 group">

        <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center
                    transition-transform duration-300 group-hover:scale-105">
            <i class="fas fa-leaf text-[#52c234] text-sm"></i>
        </div>

        <span class="font-black text-xl tracking-tight text-gray-900">
            Eco<span class="text-[#52c234]">Bite</span>
        </span>
    </a>

    {{-- CENTER SEARCH --}}
    <div class="hidden lg:flex items-center flex-1 justify-center px-6">
        <div class="w-full max-w-[600px]">
            @livewire('customer-search')
        </div>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="flex items-center gap-0.5">

        {{-- LANGUAGE --}}
        <div class="hidden md:block relative group">
            <button class="flex items-center gap-1.5 text-[10px] font-black uppercase tracking-widest text-gray-800 hover:text-gray-900 transition px-3 py-2 rounded-full hover:bg-gray-100">
                <i class="fas fa-globe text-xs"></i> EN
            </button>

            <div class="absolute right-0 mt-2 w-32 bg-white rounded-xl shadow-xl border border-gray-100
                        opacity-0 invisible group-hover:visible group-hover:opacity-100
                        transition-all duration-200 z-50">
                <a href="#" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-900 hover:bg-gray-50 rounded-t-xl">English</a>
                <a href="#" class="block px-4 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:bg-gray-50 rounded-b-xl">Urdu</a>
            </div>
        </div>

        @auth

        @php
            $iconClass = "relative w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition text-sm";
        @endphp

        {{-- NOTIFICATIONS --}}
        <a href="#" class="{{ $iconClass }}">
            <i class="far fa-bell"></i>
            <span class="absolute top-1.5 right-1.5 h-1.5 w-1.5 bg-red-500 rounded-full"></span>
        </a>

        {{-- FAVORITES --}}
        <a href="#" class="{{ $iconClass }}">
            <i class="far fa-heart"></i>
        </a>

        {{-- CART --}}
        <a href="#" class="{{ $iconClass }}">
            <i class="fas fa-shopping-cart"></i>
            @if((auth()->user()->cart_count ?? 0) > 0)
                <span class="absolute -top-0.5 -right-0.5 bg-black text-white text-[8px] font-black h-4 w-4 rounded-full flex items-center justify-center">
                    {{ auth()->user()->cart_count }}
                </span>
            @endif
        </a>

        {{-- PROFILE DROPDOWN --}}
        <div class="relative ml-1"
             x-data="{ open: false }"
             @click.away="open=false">

            <button @click="open=!open"
                    class="flex items-center gap-2 group pl-1">

                <div class="w-8 h-8 rounded-full overflow-hidden border-2 border-transparent group-hover:border-black transition duration-200">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=111111&color=fff"
                         class="w-full h-full object-cover">
                </div>

                <i class="fas fa-chevron-down text-[9px] text-gray-400 transition-transform duration-200"
                   :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 x-cloak
                 class="absolute right-0 mt-3 w-60 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">

                {{-- User info --}}
                <div class="px-5 py-3 border-b border-gray-50">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Logged in as</p>
                    <p class="text-sm font-black text-gray-900 mt-0.5 truncate">{{ auth()->user()->name }}</p>
                </div>

                <a href="#" class="flex items-center gap-3 px-5 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-800 hover:bg-gray-50 transition">
                    <i class="far fa-user text-gray-400 w-4 text-center"></i>
                    Profile
                </a>

                <a href="#" class="flex items-center gap-3 px-5 py-2.5 text-[10px] font-black uppercase tracking-widest text-gray-800 hover:bg-gray-50 transition">
                    <i class="fas fa-receipt text-gray-400 w-4 text-center"></i>
                    My Orders
                </a>

                <div class="border-t border-gray-100 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left flex items-center gap-3 px-5 py-2.5 text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-600 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt w-4 text-center"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        @else

        {{-- GUEST ICONS --}}
        <a href="#" class="relative w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition text-sm">
            <i class="far fa-heart"></i>
        </a>

        <a href="#" class="relative w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition text-sm">
            <i class="fas fa-shopping-cart"></i>
        </a>

        <div class="hidden md:flex items-center gap-2 ml-3">
            <a href="{{ route('register') }}"
               class="text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-lg border transition-all duration-200
               {{ request()->routeIs('register') ? 'bg-black text-white border-black' : 'border-gray-400 text-gray-800 hover:border-gray-800 hover:text-gray-900' }}">
                Sign Up
            </a>
            <a href="{{ route('login') }}"
               class="text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-lg border transition-all duration-200
               {{ request()->routeIs('login') ? 'bg-black text-white border-black' : 'border-gray-400 text-gray-800 hover:border-gray-800 hover:text-gray-900' }}">
                Log In
            </a>
        </div>

        @endauth

        {{-- MOBILE TOGGLE --}}
        <button @click="mobileOpen=true"
                class="lg:hidden w-9 h-9 flex items-center justify-center rounded-full text-gray-800 hover:bg-gray-100 transition ml-1">
            <i class="fas fa-bars text-sm"></i>
        </button>

    </div>

    {{-- MOBILE BACKDROP --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 bg-black/40 z-40"
         @click="mobileOpen=false"></div>

    {{-- MOBILE SLIDE PANEL --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         x-cloak
         class="fixed right-0 top-0 h-full w-72 bg-white shadow-2xl z-50 flex flex-col">

        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <span class="font-black text-lg tracking-tight">Eco<span class="text-[#52c234]">Bite</span></span>
            <button @click="mobileOpen=false" class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition text-gray-400">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <div class="flex-1 px-6 py-6 space-y-1">
            <a href="{{ route('Home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-800 hover:bg-gray-50 transition">
                <i class="fas fa-home text-gray-400 w-4 text-center"></i> Home
            </a>
            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-800 hover:bg-gray-50 transition">
                <i class="fas fa-receipt text-gray-400 w-4 text-center"></i> My Orders
            </a>
            @auth
                <div class="border-t border-gray-100 my-3"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-600 hover:bg-red-50 transition">
                        <i class="fas fa-sign-out-alt w-4 text-center"></i> Logout
                    </button>
                </form>
            @else
                <div class="border-t border-gray-100 my-3"></div>
                <a href="{{ route('login') }}"
                   class="flex items-center justify-center px-4 py-3 text-[10px] font-black uppercase tracking-widest rounded-xl transition
                   {{ request()->routeIs('login') ? 'bg-[#52c234] text-gray-800' : 'bg-black text-white hover:bg-gray-800' }}">
                    Log In
                </a>
                <a href="{{ route('register') }}"
                   class="flex items-center justify-center px-4 py-3 text-[10px] font-black uppercase tracking-widest rounded-xl transition mt-2
                   {{ request()->routeIs('register') ? 'bg-[#52c234] text-gray-800' : 'border border-gray-200 text-gray-800 hover:bg-gray-50' }}">
                    Sign Up
                </a>
            @endauth
        </div>
    </div>

</nav>