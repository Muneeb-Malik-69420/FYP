<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false" 
    x-transition:opacity
    class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 lg:hidden">
</div>

<aside 
    :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full lg:translate-x-0 lg:w-20'" 
    class="fixed lg:static inset-y-0 left-0 bg-white border-r border-gray-100 flex flex-col transition-all duration-300 ease-in-out z-50 transform">
    
    <div class="p-6 flex items-center gap-3 overflow-hidden">
        <div class="min-w-[32px] flex items-center justify-center text-emerald-500">
            <i class="fa-solid fa-leaf text-2xl"></i>
        </div>
        <span x-show="sidebarOpen" x-transition.opacity class="text-2xl font-bold tracking-tight text-slate-800 whitespace-nowrap">
            EcoBite
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
                ['name' => 'Profile', 'icon' => 'fa-user', 'route' => '#', 'locked' => true], // Profile usually unlocked
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
                  ? 'text-slate-300 cursor-not-allowed opacity-70' 
                  : ($isActive ? 'bg-emerald-50 text-emerald-600' : 'text-slate-500 hover:bg-gray-50 hover:text-slate-700') 
               }}">
                
                <div class="min-w-[30px] flex justify-start items-center">
                    <i class="fa-solid {{ $item['icon'] }} text-lg"></i>
                </div>
                
                <span x-show="sidebarOpen" x-transition.opacity class="ml-3 font-medium text-[15px] whitespace-nowrap">
                    {{ $item['name'] }}
                </span>

                @if($isLocked)
                    <i x-show="sidebarOpen" class="fa-solid fa-lock text-[10px] ml-auto text-slate-400"></i>
                @endif

                <div x-show="!sidebarOpen" class="fixed left-20 bg-slate-800 text-white text-xs py-1.5 px-3 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap z-[60] pointer-events-none lg:block hidden">
                    {{ $item['name'] }} @if($isLocked) (Locked) @endif
                </div>
            </a>
        @endforeach
    </nav>

    <div class="p-4 border-t border-gray-50">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all group">
                <div class="min-w-[30px] flex justify-start items-center">
                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                </div>
                <span x-show="sidebarOpen" class="ml-3 font-medium text-[15px]">Log out</span>
            </button>
        </form>
    </div>
</aside>