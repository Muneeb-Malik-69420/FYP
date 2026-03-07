<div class="animate-fadeIn bg-white overflow-hidden font-sans">

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
        <div class="absolute top-6 left-0 w-full z-10">
            <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
                <nav class="flex items-center gap-3 text-white/50" aria-label="Breadcrumb">
                    <button wire:click="closeRestaurant"
                        class="text-[10px] font-black uppercase tracking-widest hover:text-white transition-colors duration-200 focus:outline-none focus:ring-1 focus:ring-white/20 rounded"
                        aria-label="Back to Explore">
                        Explore
                    </button>
                    <svg class="w-1.5 h-1.5 opacity-30" viewBox="0 0 6 10" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 1l4 4-4 4" />
                    </svg>
                    <span class="text-[11px] font-black uppercase tracking-widest text-white/80 truncate max-w-[200px] sm:max-w-none">
                        {{ $supplier->business_name }}
                    </span>
                </nav>

                @auth
                    @php
                        $isFav = \App\Models\Favourite::where('user_id', auth()->id())
                            ->where('supplier_id', $supplier->id)
                            ->exists();
                    @endphp
                    <button wire:click="toggleFavourite" wire:loading.attr="disabled"
                        class="shrink-0 h-14 w-14 rounded-full flex items-center justify-center border backdrop-blur-sm
                               transition-all duration-300 transform hover:scale-110 shadow-xl
                               {{ $isFav ? 'bg-primary border-primary' : 'bg-white/10 border-white/30 hover:bg-white/20' }}">
                        <i class="fa-heart text-lg text-white {{ $isFav ? 'fas' : 'far' }}"></i>
                    </button>
                @else
                    <a href="{{ route('login') }}"
                        class="shrink-0 h-14 w-14 rounded-full flex items-center justify-center border border-white/30
                               bg-white/10 hover:bg-white/20 backdrop-blur-sm transition shadow-xl">
                        <i class="far fa-heart text-white text-lg"></i>
                    </a>
                @endauth
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
                            <span class="inline-flex items-center gap-1.5 bg-primary second px-3 py-1 rounded-sm">
                                <span class="text-[10px] font-black uppercase tracking-wider">Eco-Partner</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm border border-white/20 px-3 py-1 rounded-sm">
                                <i class="fas fa-star text-amber-400 text-[10px]"></i>
                                <span class="text-[10px] font-black tracking-widest">{{ $supplier->rating }}</span>
                                <span class="text-[10px] text-white/50">({{ $supplier->reviewCountLabel }} Reviews)</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 bg-white/10 backdrop-blur-sm border border-white/20 px-3 py-1 rounded-sm">
                                <i class="fas fa-map-marker-alt text-white/70 text-[10px]"></i>
                                <span class="text-[10px] font-bold tracking-widest text-white/90">{{ $supplier->business_location }}</span>
                            </span>
                        </div>
                        @if ($supplier->tagline ?? false)
                            <p class="text-sm text-white/60 mt-3 font-medium tracking-wide max-w-lg">
                                {{ $supplier->tagline }}</p>
                        @endif
                    </div>
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
                <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-[10px] transition-colors duration-200
                    {{ $search ? 'text-black' : 'text-gray-400 group-focus-within:text-black' }}"></i>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="FIND A DEAL..."
                    class="w-full bg-gray-100/80 border border-gray-200 rounded-md py-2 pl-9 pr-8 text-[10px] font-black
                           tracking-widest second placeholder-gray-400 focus:ring-0 focus:border-black
                           focus:bg-white transition-all outline-none uppercase">
                @if ($search)
                    <button wire:click="$set('search', '')"
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 second hover:text-gray-500 transition-colors">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                @endif
            </div>
            <div class="h-5 w-px bg-white shrink-0 hidden md:block"></div>
            <nav class="flex items-center gap-1 overflow-x-auto no-scrollbar scroll-smooth flex-1">
                @foreach ($categories as $cat)
                    <button wire:click="setCategory('{{ $cat }}')"
                        class="shrink-0 px-3.5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider transition-all duration-200
                               {{ $activeCategory === $cat ? 'bg-primary second shadow-sm' : 'second hover:text-gray-900 hover:bg-gray-100' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </nav>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
        3. ITEM DETAIL MODAL
    ═══════════════════════════════════════ --}}
    <div x-data="{
            open: false,
            item: {},
            qty: 1,
            show(data) {
                this.item = data;
                this.qty = 1;
                this.open = true;
                document.body.style.overflow = 'hidden';
            },
            close() {
                this.open = false;
                document.body.style.overflow = '';
            },
            increase() {
                if (this.qty < this.item.quantity) this.qty++;
            },
            decrease() {
                if (this.qty > 1) this.qty--;
            }
         }"
         x-on:keydown.escape.window="close()"
         x-on:open-item-modal.window="show($event.detail)">

        {{-- Backdrop --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak
             @click="close()"
             class="fixed z-[999]"
             style="inset:0; background:rgba(0,0,0,0.6); backdrop-filter:blur(8px); -webkit-backdrop-filter:blur(8px);">
        </div>

        {{-- Modal --}}
        <div x-show="open"
             x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-400"
             x-transition:enter-start="opacity-0 scale-90 translate-y-6"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             x-cloak
            class="fixed z-[1000] flex items-center justify-center pointer-events-none"
style="top:175px; left:0; right:0; bottom:0; padding:16px;">

            <div class="relative w-full max-w-sm bg-white rounded-3xl overflow-hidden pointer-events-auto flex flex-col"
                 style="max-height:85vh; box-shadow:0 32px 80px rgba(0,0,0,0.25);">

                {{-- Top green accent --}}
                <div class="h-[3px] shrink-0"
                     style="background:linear-gradient(90deg,#52c234,#86efac,#52c234);"></div>

                {{-- SCROLLABLE CONTENT --}}
                <div class="overflow-y-auto flex-1"
                     style="-ms-overflow-style:none; scrollbar-width:none;">

                    {{-- Hero Image --}}
                    <div class="relative w-full bg-gray-100 overflow-hidden" style="height:260px;">
                        <img :src="item.image"
                             :alt="item.name"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>

                        {{-- Badges --}}
                        <div class="absolute top-4 left-4 flex gap-2 flex-wrap">
                            <template x-if="item.percentage > 0">
                                <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-lg text-white"
                                      style="background:#52c234;">
                                    <span x-text="item.percentage + '% OFF'"></span>
                                </span>
                            </template>
                            <template x-if="item.isLowStock">
                                <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-lg bg-red-500 text-white">
                                    🔥 Only <span x-text="item.quantity"></span> left
                                </span>
                            </template>
                            <template x-if="item.isSoldOut">
                                <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-lg bg-gray-800 text-white">
                                    Sold Out
                                </span>
                            </template>
                        </div>

                        {{-- Close button --}}
                        <button @click="close()"
                                class="absolute top-4 right-4 w-9 h-9 rounded-2xl flex items-center justify-center transition-all"
                                style="background:rgba(0,0,0,0.45); backdrop-filter:blur(8px); border:1px solid rgba(255,255,255,0.2);">
                            <i class="fas fa-times text-white text-xs"></i>
                        </button>

                        {{-- Name + price overlay --}}
                        <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between gap-3">
                            <h3 class="font-black text-white uppercase leading-tight flex-1"
                                style="font-size:17px; letter-spacing:-0.01em; text-shadow:0 2px 12px rgba(0,0,0,0.6);"
                                x-text="item.name">
                            </h3>
                            <div class="text-right shrink-0">
                                <div class="font-black text-white tabular-nums leading-none"
                                     style="font-size:18px; letter-spacing:-0.02em;"
                                     x-text="'Rs. ' + item.price">
                                </div>
                                <template x-if="item.originalPrice > item.price">
                                    <div class="text-[11px] text-white/50 line-through tabular-nums mt-0.5"
                                         x-text="'Rs. ' + item.originalPrice">
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="px-5 pt-5 pb-4">

                        {{-- Description --}}
                        <p class="text-[12px] text-gray-500 leading-relaxed font-medium"
                           x-text="item.description || 'No description available.'">
                        </p>

                        {{-- Divider --}}
                        <div class="my-4 h-px"
                             style="background:linear-gradient(90deg,#52c234,rgba(82,194,52,0.1),transparent);"></div>

                        {{-- Info pills --}}
                        <div class="flex items-center gap-2 flex-wrap">
                            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl"
                                 style="background:#f9fffe; border:1.5px solid #d1fae5;">
                                <i class="fas fa-box text-[9px]" style="color:#52c234;"></i>
                                <span class="text-[10px] font-black uppercase tracking-wider"
                                      style="color:#16a34a;"
                                      x-text="item.quantity + ' in stock'">
                                </span>
                            </div>
                            <template x-if="item.percentage > 0">
                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl"
                                     style="background:#f0fdf4; border:1.5px solid #d1fae5;">
                                    <i class="fas fa-tag text-[9px]" style="color:#52c234;"></i>
                                    <span class="text-[10px] font-black uppercase tracking-wider"
                                          style="color:#16a34a;"
                                          x-text="'Save ' + item.percentage + '%'">
                                    </span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- STICKY BOTTOM: QTY + ADD --}}
                <div class="shrink-0 px-5 py-4 bg-white" style="border-top:1px solid #f3f4f6;">

                    <template x-if="!item.isSoldOut">
                        <div class="flex items-center gap-3">

                            {{-- Qty controls --}}
                            <div class="flex items-center rounded-2xl overflow-hidden shrink-0"
                                 style="border:1.5px solid #ebebeb; background:#fafafa;">
                                <button @click="decrease()"
                                        class="w-10 h-10 flex items-center justify-center transition-all hover:bg-gray-100 text-gray-500 hover:text-gray-900 font-black">
                                    <i class="fas fa-minus text-[9px]"></i>
                                </button>
                                <span class="text-[13px] font-black text-gray-900 px-3 min-w-[36px] text-center tabular-nums"
                                      x-text="qty">
                                </span>
                                <button @click="increase()"
                                        class="w-10 h-10 flex items-center justify-center transition-all hover:bg-gray-100 text-gray-500 hover:text-gray-900 font-black">
                                    <i class="fas fa-plus text-[9px]"></i>
                                </button>
                            </div>

                            {{-- Add button --}}
                            <button @click="$wire.addToBasket(item.id, qty); close();"
                                    class="flex-1 h-10 rounded-2xl text-[11px] font-black uppercase tracking-widest text-white transition-all duration-200 flex items-center justify-center gap-2"
                                    style="background:#111;"
                                    onmouseover="this.style.background='#52c234'; this.style.boxShadow='0 4px 20px rgba(82,194,52,0.3)'"
                                    onmouseout="this.style.background='#111'; this.style.boxShadow='none'">
                                <i class="fas fa-plus text-[9px]"></i>
                                Add
                                <span x-show="qty > 1" x-text="'× ' + qty" class="opacity-70"></span>
                                <span class="opacity-40 font-medium">·</span>
                                <span x-text="'Rs. ' + (parseInt(item.price.replace(/,/g, '')) * qty).toLocaleString()"></span>
                            </button>
                        </div>
                    </template>

                    <template x-if="item.isSoldOut">
                        <div class="w-full h-10 rounded-2xl text-[11px] font-black uppercase tracking-widest text-gray-400 flex items-center justify-center"
                             style="background:#f5f5f5;">
                            Sold Out
                        </div>
                    </template>
                </div>

            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════
        4. MAIN CONTENT: DEALS + BASKET
    ═══════════════════════════════════════ --}}
    <div class="max-w-7xl mx-auto bg-white">
        <div class="flex flex-col lg:flex-row items-start gap-4">

            {{-- LEFT: Deals grid --}}
            <div class="w-full lg:w-[70%] lg:pr-4 px-4 pt-4 pb-24 lg:h-[calc(100vh-121.5px)] lg:overflow-y-auto no-scrollbar border border-gray-100 rounded-sm shadow-sm bg-white">

                <div class="flex items-center justify-between mb-4 px-1">
                    <div class="flex items-center gap-2.5">
                        <h2 class="text-[13px] font-black uppercase tracking-widest second">
                            {{ $activeCategory === 'All Deals' ? 'All Deals' : $activeCategory }}
                        </h2>
                        <span class="bg-white second text-[11px] font-black uppercase tracking-wider px-2 py-0.5 rounded">
                            {{ $foodItems->count() > 99 ? '99+' : $foodItems->count() }}
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
                            $isSoldOut  = $item->quantity <= 0;
                            $isLowStock = !$isSoldOut && $item->quantity < 5;
                            $percentage = !$isSoldOut && $item->original_price > 0 && $item->discounted_price < $item->original_price
                                ? round((($item->original_price - $item->discounted_price) / $item->original_price) * 100)
                                : 0;
                            $imagePath = $item->image_path;
                            $hasImage  = $imagePath && Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath);
                            $imageUrl  = $hasImage
                                ? asset('storage/' . $imagePath)
                                : 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=400';
                        @endphp

                        <div wire:key="deal-{{ $item->id }}"
                             @click="$dispatch('open-item-modal', {
                                 id:            {{ $item->id }},
                                 name:          '{{ addslashes($item->item_name) }}',
                                 description:   '{{ addslashes($item->description ?? '') }}',
                                 price:         '{{ number_format($item->discounted_price) }}',
                                 originalPrice: '{{ number_format($item->original_price) }}',
                                 image:         '{{ $imageUrl }}',
                                 quantity:      {{ $item->quantity }},
                                 percentage:    {{ $percentage }},
                                 isLowStock:    {{ $isLowStock ? 'true' : 'false' }},
                                 isSoldOut:     {{ $isSoldOut ? 'true' : 'false' }}
                             })"
                            class="group bg-cardcolor rounded-sm border-0 shadow-none p-4 flex justify-between min-h-[150px]
                                   transition-all duration-300 ease-out
                                   {{ $isSoldOut ? 'opacity-60 cursor-not-allowed' : 'hover:shadow-lg hover:border-gray-200 hover:-translate-y-1.5 active:scale-[0.98] cursor-pointer' }}">

                            <div class="flex flex-col justify-between py-1 pr-2 flex-1 min-w-0">
                                <div>
                                    <div class="flex flex-wrap gap-1.5 mb-2">
                                        @if ($isSoldOut)
                                            <span class="bg-gray-100 text-gray-500 text-[11px] font-black uppercase tracking-wider px-2 py-0.5 rounded border border-gray-200">
                                                Sold Out
                                            </span>
                                        @elseif($percentage > 0)
                                            <span class="bg-[#c9a84c] second text-[11px] font-black uppercase tracking-wider px-2 py-0.5 rounded">
                                                {{ $percentage }}% OFF
                                            </span>
                                        @endif
                                        @if ($isLowStock)
                                            <span class="bg-red-50 text-red-600 text-[11px] font-black uppercase tracking-wider px-2 py-0.5 rounded border border-red-100">
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

                            {{-- Image + Add button --}}
                            <div class="flex flex-col items-center gap-2 shrink-0">
                                <div class="relative w-20 h-20 overflow-hidden rounded-xl bg-gray-50 border border-gray-100">
                                    <img src="{{ $imageUrl }}"
                                         class="w-full h-full object-cover transition-transform duration-500 {{ $isSoldOut ? '' : 'group-hover:scale-110' }}"
                                         alt="{{ $item->item_name }}">
                                </div>
                                @if (!$isSoldOut)
                                    <button @click.stop="$wire.addToBasket({{ $item->id }})"
                                            class="w-full flex items-center justify-center gap-1 bg-primary hover:bg-green-500
                                                   second text-[9px] font-black uppercase tracking-wider
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
        <button class="bg-black text-white px-6 py-3.5 rounded-full shadow-2xl flex items-center gap-3
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
    <div x-data="{
        show: false,
        message: '',
        type: 'success',
        timer: null,
        trigger(event) {
            this.message = event.detail.message;
            this.type = event.detail.type ?? 'success';
            if (this.timer) clearTimeout(this.timer);
            this.show = false;
            this.$nextTick(() => {
                this.show = true;
                this.timer = setTimeout(() => this.show = false, 3500);
            });
        }
    }" x-on:show-toast.window="trigger($event)" x-show="show"
        x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-500"
        x-transition:enter-start="opacity-0 translate-y-4 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-[cubic-bezier(0.4,0,1,1)] duration-300"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
        class="fixed bottom-24 lg:bottom-10 left-1/2 -translate-x-1/2 z-[100] pointer-events-none"
        style="display: none;">

        <div class="relative pointer-events-auto">
            <div :class="{
                'bg-[#52c234]/20': type === 'success',
                'bg-red-400/20': type === 'error',
                'bg-amber-400/20': type === 'warning',
                'bg-sky-400/20': type === 'info'
            }" class="absolute inset-0 rounded-2xl blur-xl scale-110 transition-colors duration-500"></div>

            <div class="relative flex items-center gap-3 bg-white/90 backdrop-blur-md border border-black/[0.06] rounded-2xl px-4 py-3 shadow-[0_8px_32px_-4px_rgba(0,0,0,0.12),0_2px_8px_-2px_rgba(0,0,0,0.06)] min-w-[220px] max-w-sm">
                <div :class="{
                    'bg-red-500': type === 'error',
                    'bg-amber-400': type === 'warning',
                    'bg-sky-500': type === 'info'
                }" :style="type === 'success' ? 'background-color: #52c234' : ''"
                    class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 shadow-sm transition-colors duration-300">
                    <i :class="{
                        'fa-check': type === 'success',
                        'fa-times': type === 'error',
                        'fa-exclamation': type === 'warning',
                        'fa-info': type === 'info'
                    }" class="fas text-white text-[9px]"></i>
                </div>
                <span class="text-[11px] font-bold uppercase tracking-[0.12em] text-gray-700 leading-snug"
                      x-text="message"></span>
                <button @click="show = false; clearTimeout(timer)"
                    class="ml-auto -mr-1 w-5 h-5 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-black/5 transition-all duration-150">
                    <i class="fas fa-times text-[8px]"></i>
                </button>
            </div>

            <div class="absolute bottom-0 left-4 right-4 h-[2px] rounded-full overflow-hidden">
                <div x-show="show"
                    :class="{ 'bg-red-400': type === 'error', 'bg-amber-300': type === 'warning', 'bg-sky-400': type === 'info' }"
                    :style="type === 'success' ? 'background-color: #52c234' : ''"
                    class="h-full w-full origin-left"
                    style="animation: shrink 3.5s linear forwards;"
                    x-init="$watch('show', val => {
                        if (val) { $el.style.animation = 'none'; $el.offsetHeight; $el.style.animation = 'shrink 3.5s linear forwards'; }
                    })">
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes shrink {
            from { transform: scaleX(1); }
            to   { transform: scaleX(0); }
        }
        @keyframes hero-zoom {
            from { transform: scale(1.08); }
            to   { transform: scale(1.0); }
        }
        .animate-hero-zoom { animation: hero-zoom 6s ease-out forwards; }
        @keyframes basket-pop {
            0%   { transform: scale(1); }
            40%  { transform: scale(1.4); }
            60%  { transform: scale(0.88); }
            80%  { transform: scale(1.08); }
            100% { transform: scale(1); }
        }
        .animate-pop { animation: basket-pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</div>