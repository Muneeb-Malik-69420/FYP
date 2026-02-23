<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false" 
    x-transition:opacity
    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 lg:hidden">
</div>

<aside 
    :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full lg:translate-x-0 lg:w-20'" 
    class="fixed lg:static inset-y-0 left-0 bg-white border-r border-gray-100 flex flex-col transition-all duration-300 ease-in-out z-50 transform shadow-sm">
    
    <div class="p-6 flex items-center gap-3 overflow-hidden">
        <div class="min-w-[40px] h-[40px] bg-gradient-to-br from-[#52c234] to-[#0f711c] rounded-full flex items-center justify-center text-white shadow-md">
            <i class="fa-solid fa-leaf text-lg"></i>
        </div>
        <span x-show="sidebarOpen" x-transition.opacity class="text-2xl font-extrabold tracking-tight text-gray-800 whitespace-nowrap">
            Eco<span class="text-[#52c234]">Bite</span>
        </span>
    </div>

    <nav class="flex-1 px-4 mt-4 space-y-1 overflow-y-auto">
        @php
            $navItems = [
                ['name' => 'Dashboard', 'icon' => 'fa-table-cells-large', 'route' => 'supplier.dashboard', 'locked' => false],
                ['name' => 'Food Listings', 'icon' => 'fa-utensils', 'route' => '#', 'locked' => true],
                ['name' => 'Orders', 'icon' => 'fa-file-lines', 'route' => '#', 'locked' => true],
                ['name' => 'Analytics', 'icon' => 'fa-chart-simple', 'route' => '#', 'locked' => true],
                ['name' => 'Notifications', 'icon' => 'fa-bell', 'route' => '#', 'locked' => true],
                ['name' => 'Profile', 'icon' => 'fa-user', 'route' => '#', 'locked' => true],
                ['name' => 'Settings', 'icon' => 'fa-gear', 'route' => '#', 'locked' => true],
            ];
        @endphp

        @foreach($navItems as $item)
            @php
                $isLocked = ($status !== 'approved' && $item['locked']);
                $isActive = request()->routeIs($item['route']);
            @endphp

            <a href="{{ $isLocked ? 'javascript:void(0)' : ($item['route'] !== '#' ? route($item['route']) : '#') }}" 
               class="flex items-center group px-4 py-3 rounded-xl transition-all duration-200 relative
               {{ $isLocked 
                  ? 'text-gray-300 cursor-not-allowed opacity-70' 
                  : ($isActive 
                    ? 'bg-green-50 text-[#0f711c]' 
                    : 'text-gray-600 hover:bg-gray-50 hover:text-[#52c234]') 
               }}">
                
                <div class="min-w-[30px] flex justify-start items-center">
                    <i class="fa-solid {{ $item['icon'] }} text-lg {{ $isActive ? 'text-[#52c234]' : '' }}"></i>
                </div>
                
                <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-bold text-[15px] tracking-wide whitespace-nowrap">
                    {{ $item['name'] }}
                </span>

                @if($isLocked)
                    <i x-show="sidebarOpen" class="fa-solid fa-lock text-[10px] ml-auto text-gray-400"></i>
                @endif

                <div x-show="!sidebarOpen" class="fixed left-20 bg-gray-800 text-white text-xs font-bold py-1.5 px-3 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-[60] pointer-events-none lg:block hidden">
                    {{ $item['name'] }}
                </div>
            </a>
        @endforeach
    </nav>

    <div class="p-4 border-t border-gray-100">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all group font-bold text-[15px]">
                <div class="min-w-[30px] flex justify-start items-center">
                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                </div>
                <span x-show="sidebarOpen" class="ml-3">Log out</span>
            </button>
        </form>
    </div>
</aside>