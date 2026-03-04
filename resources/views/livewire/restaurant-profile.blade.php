<div class="animate-fadeIn bg-gray-200 overflow-hidden font-sans">

    {{-- ═══════════════════════════════════════
        1. HERO SECTION
    ═══════════════════════════════════════ --}}
    <div class="relative h-[38vh] min-h-[280px] w-full bg-gray-900 overflow-hidden">

        <img src="{{ $supplier->cover_photo ? asset('storage/' . $supplier->cover_photo) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600' }}"
            class="w-full h-full object-cover opacity-50 scale-105 animate-hero-zoom"
            alt="{{ $supplier->business_name }}">

        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/20 to-black/90"></div>
        <div class="absolute inset-0 opacity-[0.03]"
            style="background-image: url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"300\" height=\"300\"><filter id=\"n\"><feTurbulence type=\"fractalNoise\" baseFrequency=\"0.9\" numOctaves=\"4\"/></filter><rect width=\"300\" height=\"300\" filter=\"url(%23n)\" opacity=\"1\"/></svg>');">
        </div>

        {{-- Breadcrumb --}}
        <div class="absolute top-6 left-0 w-full">
            <div class="max-w-7xl mx-auto px-6">
                <nav class="flex items-center gap-3 text-white/50">
                    <button wire:click="closeRestaurant"
                        class="text-[10px] font-black uppercase tracking-widest hover:text-white transition-colors duration-200">
                        Explore
                    </button>
                    <svg class="w-2 h-2 opacity-40" fill="currentColor" viewBox="0 0 6 10">
                        <path d="M1 1l4 4-4 4" />
                    </svg>
                    <span
                        class="text-[11px] font-black uppercase tracking-widest text-white/80">{{ $supplier->business_name }}</span>
                </nav>
            </div>
        </div>

        {{-- Hero content --}}
        <div class="absolute bottom-0 left-0 w-full pb-6">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-end justify-between gap-6">
                    <div class="text-white max-w-3xl">

                        <h1 class="text-4xl md:text-6xl font-black uppercase leading-[0.9] tracking-tight mb-4"
                            style="font-stretch: condensed; text-shadow: 0 2px 40px rgba(0,0,0,0.5);">
                            {{ $supplier->business_name }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-2">
                            <span
                                class="inline-flex items-center gap-1.5 bg-[#52c234] text-gray-800 px-3 py-1 rounded-sm">
                                <span class="text-[10px] font-black uppercase tracking-wider">Eco-Partner</span>
                            </span>

                            <span
                                class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm border border-white/20 px-3 py-1 rounded-sm">
                                <i class="fas fa-star text-amber-400 text-[10px]"></i>
                                <span
                                    class="text-[10px] font-black tracking-widest">{{ $supplier->rating ?? '4.9' }}</span>
                                <span class="text-[10px] text-white/50">({{ $supplier->review_count ?? '500+' }}
                                    Reviews)</span>
                            </span>

                            <span
                                class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm border border-white/20 px-3 py-1 rounded-sm">
                                <i class="fas fa-map-marker-alt text-white/70 text-[10px]"></i>
                                <span
                                    class="text-[10px] font-bold tracking-widest text-white/90">{{ $supplier->business_location }}</span>
                            </span>
                        </div>

                        @if ($supplier->tagline ?? false)
                            <p class="text-sm text-white/60 mt-3 font-medium tracking-wide max-w-lg">
                                {{ $supplier->tagline }}</p>
                        @endif
                    </div>

                    <button x-data="{ liked: false }" x-on:click="liked = !liked"
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

            <div class="relative w-72 shrink-0 group">
                <i
                    class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-[10px] transition-colors duration-200
                        {{ $search ? 'text-black' : 'text-gray-400 group-focus-within:text-black' }}"></i>

                <input wire:model.live.debounce.300ms="search" type="text" placeholder="FIND A DEAL..."
                    class="w-full bg-gray-100/80 border border-gray-200 rounded-md py-2 pl-9 pr-8 text-[10px] font-black
                        tracking-widest text-gray-800 placeholder-gray-400 focus:ring-0 focus:border-black
                        focus:bg-white transition-all outline-none uppercase">

                @if ($search)
                    <button wire:click="$set('search', '')"
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-800 hover:text-gray-500 transition-colors">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                @endif
            </div>

            <div class="h-5 w-px bg-white shrink-0 hidden md:block"></div>

            <nav class="flex items-center gap-1 overflow-x-auto no-scrollbar scroll-smooth flex-1">
                @foreach ($categories as $cat)
                    <button wire:click="setCategory('{{ $cat }}')"
                        class="shrink-0 px-3.5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider transition-all duration-200
                            {{ $activeCategory === $cat
                                ? 'bg-[#52c234] text-gray-800 shadow-sm'
                                : 'text-gray-800 hover:text-gray-900 hover:bg-gray-100' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </nav>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
        3. MAIN CONTENT: DEALS + BASKET
    ═══════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto ">
        <div class="flex flex-col lg:flex-row items-start gap-4">

            {{-- LEFT: Deals grid --}}
            <div
                class="w-full lg:w-[70%] lg:pr-4 pt-7 pb-24 lg:h-[calc(100vh-121.5px)] lg:overflow-y-auto no-scrollbar">

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2.5">
                        <h2 class="text-[13px] font-black uppercase tracking-widest text-gray-800">
                            {{ $activeCategory === 'All Deals' ? 'All Deals' : $activeCategory }}
                        </h2>
                        <span
                            class="bg-[#52c234] text-gray-800 text-[9px] font-black
                                     w-5 h-5 rounded-full flex items-center justify-center leading-none">
                            {{ $foodItems->count() > 9 ? '9+' : $foodItems->count() }}
                        </span>
                    </div>
                    @if ($search)
                        <p class="text-[11px] text-gray-400 tracking-wide">Results for "{{ $search }}"</p>
                    @endif
                </div>

                {{-- Loading skeleton --}}
                <div wire:loading wire:target="search, setCategory" class="w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 lg:gap-6 animate-pulse">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="bg-white rounded-sm h-[150px] border border-gray-100"></div>
                        @endfor
                    </div>
                </div>

                {{-- Deals grid --}}
                <div wire:loading.remove wire:target="search, setCategory"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 lg:gap-6">

                    @forelse($foodItems as $item)
                        @php
                            $isSoldOut = $item->quantity <= 0;
                            $isLowStock = !$isSoldOut && $item->quantity < 5;
                            $percentage =
                                !$isSoldOut &&
                                $item->original_price > 0 &&
                                $item->discounted_price < $item->original_price
                                    ? round(
                                        (($item->original_price - $item->discounted_price) / $item->original_price) *
                                            100,
                                    )
                                    : 0;

                            // Check if image physically exists on disk
                            $imagePath = $item->image_path;
                            $hasImage =
                                $imagePath && Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath);
                        @endphp

                        <div wire:key="deal-{{ $item->id }}"
                            class="group bg-white rounded-sm border-0 shadow-none p-4 flex justify-between min-h-[150px]
                                transition-all duration-300 ease-out
                                {{ $isSoldOut ? 'opacity-60 cursor-not-allowed' : 'hover:shadow-lg hover:border-gray-200 hover:-translate-y-1.5 active:scale-[0.98] cursor-pointer' }}">

                            <div class="flex flex-col justify-between py-1 pr-2 flex-1 min-w-0">
                                <div>
                                    <div class="flex flex-wrap gap-1.5 mb-2">
                                        @if ($isSoldOut)
                                            <span
                                                class="bg-gray-100 text-gray-500 text-[11px] font-black uppercase tracking-wider px-2 py-0.5 rounded border border-gray-200">
                                                Sold Out
                                            </span>
                                        @elseif($percentage > 0)
                                            <span
                                                class="bg-[#52c234] text-gray-800 text-[11px] font-black uppercase tracking-wider px-2 py-0.5 rounded">
                                                {{ $percentage }}% OFF
                                            </span>
                                        @endif
                                        @if ($isLowStock)
                                            <span
                                                class="bg-red-50 text-red-600 text-[11px] font-black uppercase tracking-wider px-2 py-0.5 rounded border border-red-100">
                                                <i class="fas fa-fire-alt mr-0.5"></i> Only {{ $item->quantity }} left
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="text-gray-900 font-bold text-sm leading-tight mb-1 truncate">
                                        {{ $item->item_name }}</h3>
                                    <p class="text-gray-500 font-normal text-xs line-clamp-2 leading-snug">
                                        {{ $item->description }}</p>
                                </div>
                                <div class="mt-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-base font-extrabold text-gray-900 tracking-tighter">
                                            Rs. {{ number_format($item->discounted_price) }}
                                        </span>
                                        @if (!$isSoldOut && $item->original_price > $item->discounted_price)
                                            <span class="text-[11px] text-gray-300 font-normal line-through">
                                                Rs. {{ number_format($item->original_price) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Image Container with Fallback logic --}}
                            <div class="flex flex-col items-center gap-2 shrink-0">
                                <div
                                    class="relative w-20 h-20 overflow-hidden rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center">
                                    @if ($hasImage)
                                        <img src="{{ asset('storage/' . $imagePath) }}"
                                            class="w-full h-full object-cover transition-transform duration-500 {{ $isSoldOut ? '' : 'group-hover:scale-110' }}"
                                            alt="{{ $item->item_name }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=200"
                                     class="w-full h-full object-cover"
                                     alt="{{ $item['name'] }}"
                                     loading="lazy">
                                    @endif
                                </div>

                                @if (!$isSoldOut)
                                    <button wire:click="addToBasket({{ $item->id }})"
                                        class="w-full flex items-center justify-center gap-1 bg-[#52c234] hover:bg-green-500
                                               text-gray-800 text-[9px] font-black uppercase tracking-wider
                                               px-3 py-1.5 rounded-lg transition-all duration-200">
                                        <i class="fas fa-plus text-[8px]"></i>
                                        Add
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center">
                            <p class="text-gray-400 text-xs font-black uppercase tracking-widest">No items found</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- RIGHT: Basket --}}
            <aside class="hidden lg:flex lg:w-[30%] lg:h-[calc(100vh-130px)] lg:sticky lg:top-[130px] flex-col">
                <div class="w-full h-full">
                    @livewire('restaurant-basket')
                </div>
            </aside>
        </div>
    </div>

    {{-- MOBILE FLOATING BASKET --}}
    <div class="lg:hidden fixed bottom-6 left-1/2 -translate-x-1/2 z-50" x-data="{ count: 0 }"
        x-on:basket-updated.window="count = $event.detail.count">
        <button
            class="bg-black text-white px-6 py-3.5 rounded-full shadow-2xl flex items-center gap-3
                    border border-white/10 hover:opacity-90 transition-all duration-300 transform hover:scale-105
                    text-[11px] font-black uppercase tracking-widest">
            <i class="fas fa-shopping-bag text-sm"></i>
            <span>View Basket</span>
            <span x-show="count > 0"
                class="bg-white text-black text-xs font-black w-5 h-5 rounded-full flex items-center justify-center"
                x-text="count"></span>
        </button>
    </div>

    {{-- TOAST --}}
    <div x-data="{ show: false, message: '', type: 'success' }"
        x-on:show-toast.window="message = $event.detail.message; type = $event.detail.type ?? 'success'; show = true; setTimeout(() => show = false, 3000)"
        x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-6 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-6 scale-95"
        class="fixed bottom-24 lg:bottom-10 left-1/2 -translate-x-1/2 z-[100] pointer-events-none"
        style="display: none;">
        <div
            class="bg-black text-white px-5 py-3 rounded-full shadow-2xl flex items-center gap-3 border border-white/10 pointer-events-auto max-w-xs">
            <div :class="type === 'success' ? 'bg-white' : 'bg-red-500'"
                class="rounded-full w-5 h-5 flex items-center justify-center shrink-0">
                <i :class="type === 'success' ? 'fa-check text-black' : 'fa-times text-white'"
                    class="fas text-[9px]"></i>
            </div>
            <span class="text-[11px] font-black uppercase tracking-widest leading-tight" x-text="message"></span>
        </div>
    </div>

    <style>
        @keyframes hero-zoom {
            from {
                transform: scale(1.08);
            }

            to {
                transform: scale(1.0);
            }
        }

        .animate-hero-zoom {
            animation: hero-zoom 6s ease-out forwards;
        }

        @keyframes basket-pop {
            0% {
                transform: scale(1);
            }

            40% {
                transform: scale(1.4);
            }

            60% {
                transform: scale(0.88);
            }

            80% {
                transform: scale(1.08);
            }

            100% {
                transform: scale(1);
            }
        }

        .animate-pop {
            animation: basket-pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.4s ease-out forwards;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</div>
