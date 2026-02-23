<header class="h-20 bg-white border-b border-gray-100 px-6 flex items-center justify-between sticky top-0 z-40">
    <div class="flex items-center">
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-emerald-600 transition-colors p-2 rounded-lg hover:bg-slate-50">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>
    </div>

    <div class="flex-1 flex justify-center max-w-2xl mx-auto">
        <div class="relative w-full max-w-md group">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                <i class="fa-solid fa-magnifying-glass text-sm"></i>
            </span>
            <input 
                type="text" 
                placeholder="Search products, orders..." 
                class="w-full bg-slate-50 border-none rounded-xl py-2.5 pl-11 pr-4 text-sm focus:ring-2 focus:ring-emerald-500/20 transition-all placeholder:text-slate-400"
            >
        </div>
    </div>

    <div class="flex items-center gap-4">
        <button class="relative text-slate-500 hover:text-emerald-500 transition-colors p-2">
            <i class="fa-regular fa-bell text-xl"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
        </button>

        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" class="flex items-center gap-3 pl-2 cursor-pointer group focus:outline-none">
                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-transparent group-hover:border-emerald-100 transition-all">
                    <img 
                        src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=fed7aa&color=ea580c" 
                        alt="Avatar" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="hidden md:flex items-center gap-2">
                    <span class="text-sm font-semibold text-slate-700">Supplier</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 group-hover:text-slate-600 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                </div>
            </button>

            <div 
                x-show="open" 
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-xl shadow-xl py-2 z-50"
            >
                <div class="px-4 py-2 border-b border-gray-50 mb-1">
                    <p class="text-xs text-slate-400 uppercase tracking-wider font-bold">Account</p>
                </div>

                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                    <i class="fa-regular fa-user w-4"></i> View Profile
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                    <i class="fa-regular fa-id-card w-4"></i> Account Settings
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                    <i class="fa-regular fa-credit-card w-4"></i> Billing
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-colors">
                    <i class="fa-solid fa-rotate w-4"></i> Switch Account
                </a>

                <div class="border-t border-gray-50 mt-1 pt-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors">
                            <i class="fa-solid fa-arrow-right-from-bracket w-4"></i> Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>