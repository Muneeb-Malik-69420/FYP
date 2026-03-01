<nav id="navbar"
    x-data="{ mobileOpen: false }"
    class="sticky top-0 left-0 w-full z-[100] bg-white/90 backdrop-blur-xl text-gray-800 shadow-sm px-8 flex items-center justify-between py-2 transition-all duration-300">

    {{-- LEFT LOGO --}}
    <a href="{{ route('Home') }}"
       class="flex items-center gap-3 shrink-0 group">

        <div class="w-9 h-9 bg-gradient-to-br from-[#52c234] to-[#0f711c]
                    rounded-full flex items-center justify-center text-white shadow-md
                    transition-transform duration-300 group-hover:rotate-12 group-hover:scale-105">
            <i class="fas fa-leaf text-base"></i>
        </div>

        <span class="font-extrabold text-xl tracking-tight">
            Eco<span class="text-[#52c234]">Bite</span>
        </span>
    </a>

    {{-- CENTER SEARCH --}}
    <div class="hidden lg:flex items-center flex-1 justify-center px-10">
        <div class="w-full max-w-[650px]">
            @livewire('customer-search')
        </div>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="flex items-center gap-6">

        {{-- LANGUAGE --}}
        <div class="hidden md:block relative group">
            <button class="flex items-center gap-2 text-xs font-bold uppercase hover:text-[#52c234] transition">
                <i class="fas fa-globe"></i> EN
            </button>

            <div class="absolute right-0 mt-3 w-32 bg-white/95 backdrop-blur-xl
                        rounded-xl shadow-xl border border-gray-100
                        opacity-0 invisible group-hover:visible group-hover:opacity-100
                        transition-all duration-200">

                <a href="#" class="block px-4 py-2 text-xs font-semibold hover:bg-green-50 rounded-t-xl">
                    English
                </a>
                <a href="#" class="block px-4 py-2 text-xs text-gray-500 hover:bg-gray-50 rounded-b-xl">
                    Urdu
                </a>
            </div>
        </div>

        @auth

        @php
            $iconClass = "relative w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 transition";
        @endphp

        {{-- NOTIFICATIONS --}}
        <a href="#" class="{{ $iconClass }}">
            <i class="far fa-bell"></i>
            <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
        </a>

        {{-- FAVORITES --}}
        <a href="#" class="{{ $iconClass }}">
            <i class="far fa-heart"></i>
        </a>

        {{-- CART --}}
        <a href="#" class="{{ $iconClass }}">
            <i class="fas fa-shopping-cart"></i>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center">
                {{ auth()->user()->cart_count ?? 0 }}
            </span>
        </a>

        {{-- PROFILE --}}
        <div class="relative"
             x-data="{ open: false }"
             @click.away="open=false">

            <button @click="open=!open"
                class="flex items-center gap-2 group">

                <div class="w-9 h-9 rounded-full overflow-hidden border-2 border-transparent group-hover:border-[#52c234] transition">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0f711c&color=fff"
                         class="w-full h-full object-cover">
                </div>

                <i class="fas fa-chevron-down text-[10px] text-gray-400 transition"
                   :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open"
                 x-transition
                 x-cloak
                 class="absolute right-0 mt-4 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 py-3">

                <div class="px-5 pb-3 border-b border-gray-50">
                    <p class="text-[10px] uppercase font-black tracking-widest text-gray-400">
                        Logged in as
                    </p>
                    <p class="text-sm font-bold mt-1 truncate">
                        {{ auth()->user()->name }}
                    </p>
                </div>

                <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm hover:bg-green-50 font-semibold">
                    <i class="far fa-user text-[#52c234] w-5"></i> Profile
                </a>

                <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm hover:bg-green-50 font-semibold">
                    <i class="fas fa-receipt text-[#52c234] w-5"></i> My Orders
                </a>

                <div class="border-t border-gray-50 my-2"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left flex items-center gap-3 px-5 py-3 text-sm font-bold text-red-500 hover:bg-red-50">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        @else

        {{-- PUBLIC VIEW --}}
        <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 transition">
            <i class="far fa-heart"></i>
        </a>

        <a href="#" class="relative w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 transition">
            <i class="fas fa-shopping-cart"></i>
        </a>

       <div class="hidden md:flex items-center gap-2">
    <a href="{{ route('register') }}"
       class="text-xs font-bold px-4 py-1.5 rounded-lg transition-colors duration-300
       {{ request()->routeIs('register') ? 'bg-green-200 text-green-900' : 'hover:bg-gray-100 hover:text-gray-800' }}">
        Signup
    </a>
    <a href="{{ route('login') }}"
       class="text-xs font-bold px-4 py-1.5 rounded-lg transition-colors duration-300
       {{ request()->routeIs('login') ? 'bg-green-200 text-green-900' : 'hover:bg-gray-100 hover:text-gray-800' }}">
        Login
    </a>
</div>

        @endauth

        {{-- MOBILE TOGGLE --}}
        <button @click="mobileOpen=true"
                class="lg:hidden w-9 h-9 flex items-center justify-center rounded-full hover:bg-gray-100 transition">
            <i class="fas fa-bars"></i>
        </button>

    </div>

    {{-- MOBILE SLIDE PANEL --}}
    <div x-show="mobileOpen"
         x-transition
         x-cloak
         class="fixed inset-0 bg-black/40 z-40"
         @click="mobileOpen=false"></div>

    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed right-0 top-0 h-full w-72 bg-white shadow-2xl z-50 p-6">

        <button @click="mobileOpen=false" class="mb-6 text-gray-400 hover:text-gray-700">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="space-y-4">
            <a href="#" class="block font-semibold">Home</a>
            <a href="#" class="block font-semibold">Shop</a>
            <a href="#" class="block font-semibold">Orders</a>
        </div>
    </div>

</nav>

<script>
// window.addEventListener('scroll', function() {
//     const nav = document.getElementById('navbar');
//     if (window.scrollY > 40) {
//         nav.classList.add('shadow-md','py-1');
//     } else {
//         nav.classList.remove('shadow-md','py-1');
//     }
// });
</script>