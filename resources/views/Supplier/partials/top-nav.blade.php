<header class="h-16 bg-white border-b border-gray-100 px-8 flex items-center justify-between sticky top-0 z-40 shadow-sm">
    
    <div class="flex items-center">
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-[#52c234] transition-colors p-2 rounded-xl hover:bg-green-50">
            <i class="fa-solid fa-bars-staggered text-xl"></i>
        </button>
    </div>

    <div class="flex-1 flex justify-center max-w-2xl mx-auto px-4">
        <div class="relative w-full max-w-md group">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-[#52c234] transition-colors">
                <i class="fa-solid fa-magnifying-glass text-sm"></i>
            </span>
            <input 
                type="text" 
                placeholder="Search products, orders..." 
                class="w-full bg-gray-100 border-transparent rounded-2xl py-2.5 pl-11 pr-4 text-sm focus:bg-white focus:ring-2 focus:ring-[#52c234]/20 focus:border-[#52c234] transition-all placeholder:text-gray-500 text-gray-800"
            >
        </div>
    </div>

    <div class="flex items-center gap-6">
        <button class="relative text-gray-500 hover:text-[#52c234] transition-all hover:scale-110 p-2">
            <i class="fa-regular fa-bell text-xl"></i>
            <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 border-2 border-white rounded-full"></span>
        </button>

        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="flex items-center gap-3 pl-2 cursor-pointer group focus:outline-none">
                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-transparent group-hover:border-[#52c234] transition-all shadow-sm">
                    <img 
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0f711c&color=fff" 
                        alt="Avatar" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="hidden md:flex items-center gap-2">
                    <span class="text-sm font-bold text-gray-800 tracking-tight">Supplier</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 group-hover:text-[#52c234] transition-transform duration-300" :class="open ? 'rotate-180' : ''"></i>
                </div>
            </button>

            <div 
                x-show="open" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="transform opacity-0 translate-y-4"
                x-transition:enter-end="transform opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="transform opacity-100 translate-y-0"
                x-transition:leave-end="transform opacity-0 translate-y-4"
                class="absolute right-0 mt-4 w-60 bg-white border border-gray-100 rounded-2xl shadow-2xl py-2 z-50 overflow-hidden"
            >
                <div class="px-5 py-3 border-b border-gray-50 bg-gray-50/50">
                    <p class="text-[10px] text-[#0f711c] uppercase tracking-[0.1em] font-black">Account Management</p>
                </div>

                <div class="p-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-green-50 hover:text-[#0f711c] rounded-xl transition-all">
                        <i class="fa-regular fa-user text-[#52c234]"></i> View Profile
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-green-50 hover:text-[#0f711c] rounded-xl transition-all">
                        <i class="fa-regular fa-id-card text-[#52c234]"></i> Account Settings
                    </a>
                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-green-50 hover:text-[#0f711c] rounded-xl transition-all">
                        <i class="fa-regular fa-credit-card text-[#52c234]"></i> Billing
                    </a>
                </div>

                <div class="border-t border-gray-50 mt-1 p-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-red-500 hover:bg-red-50 rounded-xl transition-all">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>