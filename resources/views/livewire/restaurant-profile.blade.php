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
                            <div class="flex items-center gap-2 bg-[#52c234] px-3 py-1 rounded-sm shadow-lg">
                                <i class="fas fa-leaf text-[10px] text-white"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest text-white">Eco-Partner</span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-white/90">
                                <i class="fas fa-star text-orange-400"></i>
                                <span class="font-black text-white">4.9</span>
                                <span class="text-white/50">(500+ Reviews)</span>
                            </div>
                            <div class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-white/90">
                                <i class="fas fa-map-marker-alt text-[#52c234]"></i>
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
            
            {{-- Pro Search Input --}}
            <div class="relative w-80 shrink-0 group">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-green-600 transition-colors text-xs"></i>
                <input type="text" 
                    placeholder="FIND A DEAL..."
                    class="w-full bg-gray-50 border-2 border-gray-200 rounded-lg py-2.5 pl-11 pr-4 text-[11px] font-black tracking-widest text-black placeholder-gray-400 focus:ring-0 focus:border-black focus:bg-white transition-all outline-none uppercase shadow-inner"
                >
            </div>

            <div class="h-8 w-px bg-gray-200 hidden md:block"></div>

            {{-- Category Nav --}}
            <nav class="flex items-center gap-8 overflow-x-auto no-scrollbar scroll-smooth h-full">
                @foreach ($categories as $cat)
                <a href="#{{ Str::slug($cat) }}"
                    class="group relative whitespace-nowrap text-[10px] font-black uppercase tracking-[0.2em] text-[#1a1a1a] hover:text-[#52c234] transition-colors py-2">
                    {{ $cat }}
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#52c234] transition-all group-hover:w-full"></span>
                </a>
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
                        {{-- <h2 class="text-[11px] font-black uppercase tracking-[0.4em] text-gray-900 mb-8 flex items-center gap-4">
                            <span class="w-12 h-0.5 bg-[#52c234]"></span> Featured Deals
                        </h2> --}}

                        @livewire('deals-profile', ['supplier_id' => $supplier->id])
                    </div>
                </div>

                {{-- RIGHT COLUMN: Fixed Basket Sidebar --}}
                <aside class="hidden lg:block lg:w-[420px] lg:h-[calc(100vh-130px)] lg:sticky lg:top-[130px]">
                    <div class="h-full py-8 lg:pl-12 lg:border-l lg:border-gray-300 flex flex-col">
                        <div class="bg-white border border-gray-300 p-8 shadow-sm flex flex-col h-full rounded-sm">
                            <div class="flex items-center justify-between mb-8 border-b border-gray-100 pb-5">
                                <h2 class="text-[11px] font-black uppercase tracking-[0.3em] text-gray-900">Your Basket</h2>
                                <i class="fas fa-shopping-basket text-xs text-gray-300"></i>
                            </div>

                            <div class="flex-grow overflow-y-auto no-scrollbar mb-6">
                                <div class="py-12 text-center border border-dashed border-gray-200 mb-8 bg-[#f9f9f9]">
                                    <p class="text-[9px] font-black uppercase tracking-widest text-gray-400">Basket is empty</p>
                                </div>
                            </div>

                            <div class="mt-auto pt-5 border-t border-gray-100">
                                <div class="flex justify-between text-lg font-black uppercase tracking-tighter text-gray-900 mt-2">
                                    <span>Total</span>
                                    <span>Rs. 0</span>
                                </div>
                                <button class="w-full bg-black text-white mt-10 py-5 text-[10px] font-black uppercase tracking-[0.3em] hover:bg-green-500 transition-all rounded-sm shadow-lg">
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #ececec; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d1d1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #52c234; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        html { scroll-behavior: smooth; }
    </style>
</div>