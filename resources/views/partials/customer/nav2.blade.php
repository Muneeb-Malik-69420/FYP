<nav id="navbar" 
    class="fixed top-0 left-0 w-full z-[100] bg-white/95 backdrop-blur-md text-gray-800 shadow-md px-10 flex items-center justify-between py-2.5 transition-all duration-300">

    <a href="{{ route('Home') }}" class="flex items-center gap-3 shrink-0 z-50">
        <div class="w-10 h-10 bg-gradient-to-br from-[#52c234] to-[#0f711c] rounded-full flex items-center justify-center text-white shadow-lg">
            <i class="fas fa-leaf text-lg"></i>
        </div>
        <span class="font-extrabold text-2xl tracking-tighter text-gray-800">
            Eco<span class="text-[#52c234]">Bite</span>
        </span>
    </a>

    <div class="hidden lg:flex items-center flex-1 max-w-2xl mx-12">
        @livewire('customer-search')
    </div>

    <div class="flex items-center gap-8">
        
        <div class="hidden md:block group relative cursor-pointer text-gray-800">
            <div class="flex items-center gap-2 hover:text-[#52c234] transition-colors font-extrabold text-xs uppercase">
                <i class="fas fa-globe text-base"></i>
                <span>EN</span>
            </div>
            <div class="absolute right-0 top-full mt-2 w-28 bg-white shadow-2xl rounded-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all border border-gray-100 text-gray-800 z-50">
                <a href="#" class="block px-4 py-2 hover:bg-green-50 text-[#0f711c] font-bold text-xs">English</a>
                <a href="#" class="block px-4 py-2 hover:bg-gray-50 text-xs text-gray-500">Urdu</a>
            </div>
        </div>

        <div class="flex items-center gap-6 text-gray-800">
            <a href="#" class="relative hover:text-[#52c234] transition-colors group">
                <i class="far fa-bell text-xl"></i>
                <span class="absolute -top-1 -right-1 flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                </span>
            </a>

            <a href="#" class="hover:text-red-500 transition-colors">
                <i class="far fa-heart text-xl"></i>
            </a>

            <a href="#" class="relative hover:text-[#52c234] transition-colors">
                <i class="fas fa-shopping-cart text-xl"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-black h-5 w-5 rounded-full flex items-center justify-center border-2 border-white">0</span>
            </a>
        </div>

        <div class="relative pl-2 border-l border-gray-200" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                <div class="w-10 h-10 rounded-full border-2 border-transparent group-hover:border-[#52c234] transition-all overflow-hidden shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0f711c&color=fff" class="w-full h-full">
                </div>
                <i class="fas fa-chevron-down text-[10px] text-gray-400 group-hover:text-gray-800 transition-transform" :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open" x-cloak x-transition
                class="absolute right-0 mt-4 w-60 bg-white border border-gray-100 rounded-2xl shadow-2xl py-2 z-50 text-gray-800">
                
                <div class="px-5 py-4 border-b border-gray-50 mb-1">
                    <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest leading-none">Logged in as</p>
                    <p class="text-[13px] font-bold truncate mt-1.5 text-gray-800">{{ auth()->user()->name }}</p>
                </div>

                <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm font-semibold hover:bg-green-50 transition-colors">
                    <i class="far fa-user w-5 text-[#52c234]"></i> Profile
                </a>
                <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm font-semibold hover:bg-green-50 transition-colors">
                    <i class="fas fa-receipt w-5 text-[#52c234]"></i> My Orders
                </a>
                
                <div class="border-t border-gray-50 my-1"></div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-3 px-5 py-3 text-sm font-bold text-red-500 hover:bg-red-50 transition-colors">
                        <i class="fas fa-sign-out-alt w-5"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>