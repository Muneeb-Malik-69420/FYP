<div class="animate-fadeIn bg-[#f5f5f0] overflow-hidden font-sans">

    {{-- ═══════════════════════════════════════
         1. HERO SECTION
    ═══════════════════════════════════════ --}}
    <div class="relative h-[52vh] min-h-[360px] w-full bg-gray-900 overflow-hidden">

        <img src="{{ $supplier->cover_photo ? asset('storage/' . $supplier->cover_photo) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600' }}"
            class="w-full h-full object-cover opacity-50 scale-105 animate-hero-zoom"
            alt="{{ $supplier->business_name }}">

        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/20 to-black/90"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"300\" height=\"300\"><filter id=\"n\"><feTurbulence type=\"fractalNoise\" baseFrequency=\"0.9\" numOctaves=\"4\"/></filter><rect width=\"300\" height=\"300\" filter=\"url(%23n)\" opacity=\"1\"/></svg>');"></div>

        {{-- Breadcrumb --}}
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

        {{-- Hero content --}}
        <div class="absolute bottom-0 left-0 w-full pb-8 pt-16">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-end justify-between gap-6">
                    <div class="text-white max-w-3xl">

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

                        <h1 class="text-4xl md:text-6xl font-black uppercase leading-[0.9] tracking-tight mb-1"
                            style="font-stretch: condensed; text-shadow: 0 2px 40px rgba(0,0,0,0.5);">
                            {{ $supplier->business_name }}
                        </h1>

                        @if($supplier->tagline ?? false)
                            <p class="text-sm text-white/60 mt-3 font-medium tracking-wide max-w-lg">{{ $supplier->tagline }}</p>
                        @endif
                    </div>

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
    <div class="sticky top-[56px] z-40 bg-white/95 backdrop-blur-md border-b border-gray-200/80 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-2.5 flex items-center gap-6 w-full">

            {{-- Search --}}
            <div class="relative w-72 shrink-0 group">
                <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-[10px] transition-colors duration-200
                          {{ $search ? 'text-[#027d51]' : 'text-gray-400 group-focus-within:text-[#027d51]' }}"></i>

                <input wire:model.live.debounce.300ms="search"
                    type="text"
                    placeholder="FIND A DEAL..."
                    class="w-full bg-gray-100/80 border border-gray-200 rounded-md py-2 pl-9 pr-8 text-[10px] font-black
                           tracking-[0.15em] text-gray-800 placeholder-gray-400 focus:ring-0 focus:border-[#027d51]
                           focus:bg-white transition-all outline-none uppercase">

                @if($search)
                    <button wire:click="$set('search', '')"
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-300 hover:text-gray-500 transition-colors">
                        <i class="fas fa-times text-[9px]"></i>
                    </button>
                @endif
            </div>

            <div class="h-5 w-px bg-gray-200 shrink-0 hidden md:block"></div>

            {{-- Category pills --}}
            <nav class="flex items-center gap-1 overflow-x-auto no-scrollbar scroll-smooth flex-1">
                @foreach($categories as $cat)
                    <button wire:click="setCategory('{{ $cat }}')"
                        class="shrink-0 px-3.5 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.18em] transition-all duration-200
                               {{ $activeCategory === $cat
                                    ? 'bg-[#027d51] text-white shadow-sm'
                                    : 'text-gray-500 hover:text-gray-900 hover:bg-gray-100' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </nav>

            {{-- Live result count --}}
            <div class="shrink-0 hidden md:flex items-center gap-1.5 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                <span class="bg-[#027d51]/10 text-[#027d51] px-2 py-0.5 rounded-full">{{ $foodItems->count() }}</span>
                <span>deals</span>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         3. MAIN CONTENT: DEALS + BASKET
    ═══════════════════════════════════════ --}}
    <div class="bg-[#ededea]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-start">

                {{-- LEFT: Deals grid --}}
                <div class="w-full lg:flex-grow lg:pr-10 pt-8 pb-24 lg:h-[calc(100vh-130px)] lg:overflow-y-auto custom-scrollbar">

                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-[11px] font-black uppercase tracking-[0.25em] text-gray-800">
                                {{ $activeCategory === 'All Deals' ? 'All Deals' : $activeCategory }}
                            </h2>
                            @if($search)
                                <p class="text-[9px] text-gray-400 mt-0.5 tracking-wide">Results for "{{ $search }}"</p>
                            @endif
                        </div>
                    </div>

                    {{-- Loading skeleton --}}
                    <div wire:loading wire:target="search, setCategory" class="w-full">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 animate-pulse">
                            @for($i = 0; $i < 4; $i++)
                                <div class="bg-white rounded-2xl h-[180px] border border-gray-100 shadow-sm"></div>
                            @endfor
                        </div>
                    </div>

                    {{-- Deals grid --}}
                    <div wire:loading.remove wire:target="search, setCategory"
                         class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">

                        @forelse($foodItems as $item)
                            @php
                                $isSoldOut  = $item->quantity <= 0;
                                $isLowStock = !$isSoldOut && $item->quantity < 5;
                                $percentage = (!$isSoldOut && $item->original_price > 0 && $item->discounted_price < $item->original_price)
                                    ? round((($item->original_price - $item->discounted_price) / $item->original_price) * 100)
                                    : 0;
                                $imageSrc = $item->image_path
                                    ? asset('storage/' . $item->image_path)
                                    : asset('images/placeholder-food.jpg');
                            @endphp

                            <div wire:key="deal-{{ $item->id }}"
                                 class="group bg-white rounded-2xl border border-gray-100 p-4 flex justify-between min-h-[180px]
                                        transition-all duration-300 ease-out
                                        {{ $isSoldOut ? 'opacity-60 cursor-not-allowed' : 'hover:shadow-xl hover:-translate-y-1.5 active:scale-[0.98] cursor-pointer' }}">

                                {{-- Left: Text --}}
                                <div class="flex flex-col justify-between py-1 pr-2 flex-1 min-w-0">
                                    <div>
                                        <div class="flex flex-wrap gap-1.5 mb-2">
                                            @if($isSoldOut)
                                                <span class="bg-gray-100 text-gray-500 text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded border border-gray-200">
                                                    Sold Out
                                                </span>
                                            @elseif($percentage > 0)
                                                <span class="bg-[#52c234]/10 text-[#437836] text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded border border-[#52c234]/20">
                                                    {{ $percentage }}% OFF
                                                </span>
                                            @endif

                                            @if($isLowStock)
                                                <span class="bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded border border-red-100">
                                                    <i class="fas fa-fire-alt mr-0.5"></i> Only {{ $item->quantity }} left
                                                </span>
                                            @endif
                                        </div>

                                        <h3 class="text-[#111827] font-bold text-base leading-tight mb-1 truncate">
                                            {{ $item->item_name }}
                                        </h3>
                                        <p class="text-[#4B5563] font-normal text-xs line-clamp-2 leading-snug italic">
                                            {{ $item->description }}
                                        </p>
                                    </div>

                                    <div class="mt-3">
                                        @if(!$isLowStock && !$isSoldOut)
                                            <p class="text-[11px] font-semibold uppercase tracking-tight text-[#437836] mb-1">
                                                <i class="fas fa-layer-group mr-1"></i> {{ $item->quantity }} available
                                            </p>
                                        @endif

                                        <div class="flex items-center gap-2">
                                            <span class="text-lg font-extrabold text-[#111111] tracking-tighter">
                                                Rs.&nbsp;{{ number_format($item->discounted_price) }}
                                            </span>
                                            @if(!$isSoldOut && $item->original_price > $item->discounted_price)
                                                <span class="text-[11px] text-[#9CA3AF] font-medium line-through">
                                                    Rs.&nbsp;{{ number_format($item->original_price) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Right: Image + Add button --}}
                                <div class="relative flex-shrink-0 w-28 h-28 self-center overflow-hidden rounded-xl bg-gray-50 border border-gray-100 shadow-sm">
                                    <img src="{{ $imageSrc }}"
                                         alt="{{ $item->item_name }}"
                                         loading="lazy"
                                         class="w-full h-full object-cover transition-transform duration-500 {{ $isSoldOut ? '' : 'group-hover:scale-110' }}"
                                         onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=200&auto=format&fit=crop'">

                                    @if($isSoldOut)
                                        <div class="absolute inset-0 bg-white/70 flex items-center justify-center rounded-xl">
                                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 rotate-[-20deg]">Sold Out</span>
                                        </div>
                                    @else
                                        <button
                                            wire:click="addToBasket({{ $item->id }})"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-75"
                                            wire:target="addToBasket({{ $item->id }})"
                                            aria-label="Add {{ $item->item_name }} to basket"
                                            class="absolute bottom-1 right-1 bg-white w-9 h-9 rounded-full shadow-lg
                                                   flex items-center justify-center text-[#437836]
                                                   hover:bg-[#52c234] hover:text-white hover:scale-110
                                                   active:scale-95 transition-all duration-150 z-10
                                                   disabled:opacity-50 disabled:cursor-not-allowed
                                                   focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#52c234]">
                                            <i class="fas fa-plus text-xs"
                                               wire:loading.remove wire:target="addToBasket({{ $item->id }})"></i>
                                            <div wire:loading wire:target="addToBasket({{ $item->id }})"
                                                 class="w-3.5 h-3.5 border-2 border-[#52c234] border-t-transparent rounded-full animate-spin"></div>
                                        </button>
                                    @endif
                                </div>
                            </div>

                        @empty
                            <div class="col-span-full py-24 flex flex-col items-center gap-4 text-center">
                                <div class="w-16 h-16 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center shadow-inner">
                                    <i class="fas fa-search text-xl text-gray-300"></i>
                                </div>
                                <div>
                                    <p class="text-[11px] font-black uppercase tracking-[0.4em] text-gray-300">No matching deals found</p>
                                    <p class="text-xs text-gray-300 mt-1">
                                        @if($search)
                                            No results for "{{ $search }}" —
                                            <button wire:click="$set('search', '')" class="underline hover:text-gray-500 transition-colors">clear search</button>
                                        @else
                                            Try a different category
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- RIGHT: Basket --}}
                <aside class="hidden lg:block lg:w-[420px] lg:h-[calc(100vh-130px)] lg:sticky lg:top-[130px]">
                    @livewire('restaurant-basket')
                </aside>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         4. MOBILE FLOATING BASKET
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
         5. TOAST
    ═══════════════════════════════════════ --}}
    <div
        x-data="{ show: false, message: '', type: 'success' }"
        x-on:show-toast.window="message = $event.detail.message; type = $event.detail.type ?? 'success'; show = true; setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-6 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-6 scale-95"
        class="fixed bottom-24 lg:bottom-10 left-1/2 -translate-x-1/2 z-[100] pointer-events-none"
        style="display: none;">
        <div class="bg-[#111827] text-white px-5 py-3 rounded-full shadow-2xl flex items-center gap-3 border border-white/10 pointer-events-auto max-w-xs">
            <div :class="type === 'success' ? 'bg-[#52c234]' : 'bg-red-500'"
                 class="rounded-full w-5 h-5 flex items-center justify-center shrink-0">
                <i :class="type === 'success' ? 'fa-check' : 'fa-times'" class="fas text-[9px] text-white"></i>
            </div>
            <span class="text-[10px] font-black uppercase tracking-widest leading-tight" x-text="message"></span>
        </div>
    </div>

    <style>
        @keyframes hero-zoom { from { transform: scale(1.08); } to { transform: scale(1.0); } }
        .animate-hero-zoom { animation: hero-zoom 6s ease-out forwards; }

        @keyframes basket-pop { 0% { transform: scale(1); } 40% { transform: scale(1.4); } 60% { transform: scale(0.88); } 80% { transform: scale(1.08); } 100% { transform: scale(1); } }
        .animate-pop { animation: basket-pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d4d4d0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #027d51; }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        html { scroll-behavior: smooth; }
    </style>
</div>