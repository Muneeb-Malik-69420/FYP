<div class="animate-fadeIn bg-[#fcfcfc] mt-[60px] overflow-hidden">
    {{-- 1. Hero Section --}}
    <div class="relative h-[40vh] w-full bg-gray-900 overflow-hidden">
        <img src="{{ $supplier->cover_photo ? asset('storage/' . $supplier->cover_photo) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600' }}"
            class="w-full h-full object-cover opacity-60" alt="{{ $supplier->business_name }}">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/95"></div>

        <div class="absolute bottom-10 left-0 w-full">
            <div class="max-w-7xl mx-auto px-6">
                <nav class="flex items-center gap-3 mb-6 text-white/60">
                    <button wire:click="closeRestaurant"
                        class="text-[10px] font-black uppercase tracking-[0.2em] hover:text-[#52c234] transition-colors">
                        Explore
                    </button>
                    <i class="fas fa-chevron-right text-[7px] opacity-50"></i>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white/90">{{ $supplier->business_name }}</span>
                </nav>

                <div class="flex items-end justify-between gap-6">
                    <div class="text-white">
                        <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter leading-none mb-6 italic">
                            {{ $supplier->business_name }}
                        </h1>
                        <div class="flex flex-wrap items-center gap-6">
                            <div class="flex items-center gap-2 bg-[#027d51] px-3 py-1 rounded-sm shadow-lg">
                                <i class="fas fa-leaf text-[10px] text-white"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest text-white">Eco-Partner</span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-white/90">
                                <i class="fas fa-star text-orange-400"></i>
                                <span class="font-black text-white">4.9</span>
                                <span class="text-white/50">(500+ Reviews)</span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-white/90">
                                <i class="fas fa-map-marker-alt text-[#027d51]"></i>
                                {{ $supplier->business_location }}
                            </div>
                        </div>
                    </div>
                    <button class="bg-white text-black h-16 w-16 rounded-full flex items-center justify-center shadow-2xl hover:bg-red-500 hover:text-white transition-all transform hover:scale-110 group">
                        <i class="far fa-heart text-xl group-hover:scale-110 transition-transform"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Tactile Sticky Search & Category Bar --}}
    <div class="sticky top-[60px] z-40 bg-white border-b border-gray-200 h-[70px] flex items-center shadow-sm">
        <div class="max-w-7xl mx-auto px-6 flex items-center gap-8 w-full">
            <div class="relative w-80 shrink-0 group">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#52c234] transition-colors text-xs"></i>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="FIND A DEAL..."
                    class="w-full bg-gray-50 border-2 border-gray-200 rounded-lg py-2.5 pl-11 pr-4 text-[11px] font-black tracking-widest text-black placeholder-gray-400 focus:ring-0 focus:border-black focus:bg-white transition-all outline-none uppercase shadow-inner">
            </div>

            <div class="h-8 w-px bg-gray-200 hidden md:block"></div>

            <nav class="flex items-center gap-8 overflow-x-auto no-scrollbar scroll-smooth h-full">
                @foreach ($categories as $cat)
                    <button wire:click="setCategory('{{ $cat }}')"
                        onclick="window.location.hash='#{{ Str::slug($cat) }}'"
                        class="group relative whitespace-nowrap text-[10px] font-black uppercase tracking-[0.2em] transition-colors py-2 {{ $activeCategory === $cat ? 'text-[#027d51]' : 'text-[#1a1a1a] hover:text-[#027d51]' }}">
                        {{ $cat }}
                        <span class="absolute bottom-0 left-0 h-0.5 bg-[#087a52] transition-all {{ $activeCategory === $cat ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </button>
                @endforeach
            </nav>
        </div>
    </div>

    {{-- 3. Main Content Split View --}}
    <div class="bg-[#ececec]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-start">
                {{-- LEFT COLUMN: Deals --}}
                <div class="w-full lg:flex-grow lg:pr-12 pt-8 pb-20 lg:h-[calc(100vh-130px)] lg:overflow-y-auto custom-scrollbar">
                    <div id="deals-container" class="mb-16">
                        @livewire('deals-profile', ['supplier_id' => $supplier->id])
                    </div>
                </div>

                {{-- RIGHT COLUMN: Fixed Basket Sidebar --}}
                <aside class="hidden lg:block lg:w-[420px] lg:h-[calc(100vh-130px)] lg:sticky lg:top-[130px]">
                    @livewire('restaurant-basket')
                </aside>
            </div>
        </div>
    </div>

    {{-- 💎 4. Floating Toast UI (Alpine.js) --}}
    <div
        x-data="{ show: false, message: '' }"
        x-on:show-toast.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-10 scale-95"
        x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 transform translate-y-10 scale-95"
        class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] pointer-events-none"
        style="display: none;"
    >
        <div class="bg-[#111827] text-white px-6 py-3 rounded-full shadow-2xl flex items-center gap-3 border border-white/10 pointer-events-auto">
            <div class="bg-[#52c234] rounded-full p-1 w-5 h-5 flex items-center justify-center">
                <i class="fas fa-check text-[10px] text-white"></i>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest" x-text="message"></span>
        </div>
    </div>

    <style>
        @keyframes qty-pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.3); color: #52c234; }
    100% { transform: scale(1); }
}

.animate-qty-pulse {
    display: inline-block;
    animation: qty-pulse 0.3s ease-out;
}
        /* 💎 Basket Pop Animation */
        @keyframes basket-pop {
            0% { transform: scale(1); }
            40% { transform: scale(1.4); }
            60% { transform: scale(0.9); }
            80% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .animate-pop {
            animation: basket-pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Custom Scrollbar Styles */
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #ececec; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d1d1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #52c234; }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        html { scroll-behavior: smooth; }
    </style>
</div>