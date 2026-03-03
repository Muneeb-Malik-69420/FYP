<div class="animate-fadeIn bg-[#f5f5f0] overflow-hidden font-sans">

    {{-- ═══════════════════════════════════════
         1. HERO SECTION — cinematic, layered
    ═══════════════════════════════════════ --}}
    <div class="relative h-[52vh] min-h-[360px] w-full bg-gray-900 overflow-hidden">

        {{-- Background image with subtle zoom-in on load --}}
        <img src="{{ $supplier->cover_photo ? asset('storage/' . $supplier->cover_photo) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600' }}"
            class="w-full h-full object-cover opacity-50 scale-105 animate-hero-zoom"
            alt="{{ $supplier->business_name }}">

        {{-- Multi-stop gradient for depth --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/20 to-black/90"></div>

        {{-- Subtle noise texture overlay --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"300\" height=\"300\"><filter id=\"n\"><feTurbulence type=\"fractalNoise\" baseFrequency=\"0.9\" numOctaves=\"4\"/></filter><rect width=\"300\" height=\"300\" filter=\"url(%23n)\" opacity=\"1\"/></svg>');"></div>

        {{-- Top-left: Breadcrumb --}}
        <div class="absolute top-6 left-0 w-full">
            <div class="max-w-7xl mx-auto px-6">
                <nav class="flex items-center gap-3 text-white/50">
                    <button wire:click="closeRestaurant"
                        class="text-[9px] font-black uppercase tracking-[0.25em] hover:text-[#52c234] transition-colors duration-200">
                        Explore
                    </button>
                    <svg class="w-2 h-2 opacity-40" fill="currentColor" viewBox="0 0 6 10"><path d="M1 1l4 4-4 4"/></svg>
                    <span class="text-[9px] font-black uppercase tracking-[0.25em] text-white/80">{{ $supplier->business_name }}</span>
                </nav>
            </div>
        </div>

        {{-- Bottom: Main hero content --}}
        <div class="absolute bottom-0 left-0 w-full pb-8 pt-16">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-end justify-between gap-6">

                    {{-- Left: Title + Meta --}}
                    <div class="text-white max-w-3xl">

                        {{-- Badge row --}}
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <span class="inline-flex items-center gap-1.5 bg-[#027d51] px-3 py-1 rounded-sm">
                                <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 16 16"><path d="M8 .5a7.5 7.5 0 100 15A7.5 7.5 0 008 .5zm0 2a5.5 5.5 0 110 11A5.5 5.5 0 018 2.5z"/></svg>
                                <span class="text-[9px] font-black uppercase tracking-[0.2em]">Eco-Partner</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm border border-white/20 px-3 py-1 rounded-sm">
                                <i class="fas fa-star text-amber-400 text-[9px]"></i>
                                <span class="text-[9px] font-black tracking-widest">{{ $supplier->rating ?? '4.9' }}</span>
                                <span class="text-[9px] text-white/50">({{ $supplier->review_count ?? '500+' }} Reviews)</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm border border-white/20 px-3 py-1 rounded-sm">
                                <i class="fas fa-map-marker-alt text-[#52c234] text-[9px]"></i>
                                <span class="text-[9px] font-bold tracking-widest text-white/90">{{ $supplier->business_location }}</span>
                            </span>
                        </div>

                        {{-- Business name — condensed slab feel --}}
                        <h1 class="text-4xl md:text-6xl font-black uppercase leading-[0.9] tracking-tight mb-1"
                            style="font-stretch: condensed; text-shadow: 0 2px 40px rgba(0,0,0,0.5);">
                            {{ $supplier->business_name }}
                        </h1>

                        @if($supplier->tagline ?? false)
                            <p class="text-sm text-white/60 mt-3 font-medium tracking-wide max-w-lg">{{ $supplier->tagline }}</p>
                        @endif
                    </div>

                    {{-- Right: Wishlist button --}}
                    <button
                        x-data="{ liked: false }"
                        x-on:click="liked = !liked"
                        :class="liked ? 'bg-red-500 border-red-500' : 'bg-white/10 border-white/30 hover:bg-white/20'"
                        class="shrink-0 h-14 w-14 rounded-full flex items-center justify-center border backdrop-blur-sm transition-all duration-300 transform hover:scale-110 group shadow-xl">
                        <i :class="liked ? 'fas text-white' : 'far text-white group-hover:text-red-400'"
                           class="fa-heart text-lg transition-all duration-200"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         2. STICKY SEARCH + CATEGORY BAR
    ═══════════════════════════════════════ --}}
    <div class="sticky top-[56px] z-40 bg-white/95 backdrop-blur-md border-b border-gray-200/80 shadow-sm transition-all duration-300"
         x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 80)">
        <div class="max-w-7xl mx-auto px-6 py-2.5 flex items-center gap-6 w-full">

            {{-- Search --}}
            <div class="relative w-72 shrink-0 group">
                <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#027d51] transition-colors text-[10px]"></i>
                <input wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="FIND A DEAL..."
                    class="w-full bg-gray-100/80 border border-gray-200 rounded-md py-2 pl-9 pr-4 text-[10px] font-black tracking-[0.15em] text-gray-800 placeholder-gray-400 focus:ring-0 focus:border-[#027d51] focus:bg-white transition-all outline-none uppercase">
            </div>

            {{-- Divider --}}
            <div class="h-5 w-px bg-gray-200 shrink-0 hidden md:block"></div>

            {{-- Category pills --}}
            <nav class="flex items-center gap-1 overflow-x-auto no-scrollbar scroll-smooth flex-1">
                @foreach ($categories as $cat)
                    <button wire:click="setCategory('{{ $cat }}')"
                        class="relative shrink-0 px-3.5 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.18em] transition-all duration-200
                               {{ $activeCategory === $cat
                                    ? 'bg-[#027d51] text-white shadow-sm shadow-green-900/20'
                                    : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </nav>

            {{-- Deals count pill --}}
            @if(isset($dealsCount))
            <div class="shrink-0 hidden md:flex items-center gap-1.5 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                <span class="bg-[#027d51]/10 text-[#027d51] px-2 py-0.5 rounded-full">{{ $dealsCount }}</span>
                <span>deals</span>
            </div>
            @endif
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         3. MAIN CONTENT: DEALS + BASKET
    ═══════════════════════════════════════ --}}
    <div class="bg-[#ededea]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-start gap-0">

                {{-- ── LEFT: Deals feed ── --}}
                <div class="w-full lg:flex-grow lg:pr-10 pt-8 pb-24
                            lg:h-[calc(100vh-130px)] lg:overflow-y-auto custom-scrollbar">

                    {{-- Section heading --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-[11px] font-black uppercase tracking-[0.25em] text-gray-800">
                                @if($activeCategory && $activeCategory !== 'All')
                                    {{ $activeCategory }}
                                @else
                                    All Deals
                                @endif
                            </h2>
                            @if($search)
                            <p class="text-[9px] text-gray-400 mt-0.5 tracking-wide">Results for "{{ $search }}"</p>
                            @endif
                        </div>

                    </div>

                    <div id="deals-container" class="mb-16">
                        @livewire('deals-profile', ['supplier_id' => $supplier->id])
                    </div>
                </div>

                {{-- ── RIGHT: Basket sidebar ── --}}
                <aside class="hidden lg:block lg:w-[420px] lg:h-[calc(100vh-130px)] lg:sticky lg:top-[130px]">
                    @livewire('restaurant-basket')
                </aside>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         4. MOBILE FLOATING BASKET BUTTON
         (visible only on mobile/tablet)
    ═══════════════════════════════════════ --}}
    <div class="lg:hidden fixed bottom-6 left-1/2 -translate-x-1/2 z-50"
         x-data="{ count: 0 }"
         x-on:basket-updated.window="count = $event.detail.count">
        <button class="bg-[#111827] text-white px-6 py-3.5 rounded-full shadow-2xl flex items-center gap-3
                       border border-white/10 hover:bg-[#027d51] transition-all duration-300 transform hover:scale-105
                       text-[10px] font-black uppercase tracking-widest">
            <i class="fas fa-shopping-bag text-sm"></i>
            <span>View Basket</span>
            <span x-show="count > 0"
                  class="bg-[#52c234] text-white text-[9px] font-black w-5 h-5 rounded-full flex items-center justify-center"
                  x-text="count"></span>
        </button>
    </div>

    {{-- ═══════════════════════════════════════
         5. TOAST NOTIFICATION
    ═══════════════════════════════════════ --}}
    <div
        x-data="{ show: false, message: '', type: 'success' }"
        x-on:show-toast.window="
            message = $event.detail.message;
            type = $event.detail.type ?? 'success';
            show = true;
            setTimeout(() => show = false, 3000)
        "
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-6 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-6 scale-95"
        class="fixed bottom-24 lg:bottom-10 left-1/2 -translate-x-1/2 z-[100] pointer-events-none"
        style="display: none;"
    >
        <div class="bg-[#111827] text-white px-5 py-3 rounded-full shadow-2xl flex items-center gap-3
                    border border-white/10 pointer-events-auto max-w-xs">
            <div :class="type === 'success' ? 'bg-[#52c234]' : 'bg-red-500'"
                 class="rounded-full w-5 h-5 flex items-center justify-center shrink-0">
                <i :class="type === 'success' ? 'fa-check' : 'fa-times'" class="fas text-[9px] text-white"></i>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest leading-tight" x-text="message"></span>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         STYLES
    ═══════════════════════════════════════ --}}
    <style>
        /* Hero zoom-in on load */
        @keyframes hero-zoom {
            from { transform: scale(1.08); }
            to   { transform: scale(1.0); }
        }
        .animate-hero-zoom {
            animation: hero-zoom 6s ease-out forwards;
        }

        /* Quantity badge pulse */
        @keyframes qty-pulse {
            0%   { transform: scale(1); }
            50%  { transform: scale(1.35); color: #52c234; }
            100% { transform: scale(1); }
        }
        .animate-qty-pulse {
            display: inline-block;
            animation: qty-pulse 0.3s ease-out;
        }

        /* Basket icon pop */
        @keyframes basket-pop {
            0%   { transform: scale(1); }
            40%  { transform: scale(1.4); }
            60%  { transform: scale(0.88); }
            80%  { transform: scale(1.08); }
            100% { transform: scale(1); }
        }
        .animate-pop {
            animation: basket-pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Page fade in */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.4s ease-out forwards;
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar       { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d4d4d0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #027d51; }

        /* Hide scrollbar for category nav */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        html { scroll-behavior: smooth; }
    </style>
</div>