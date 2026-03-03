{{-- deals-profile.blade.php --}}
<div>
    {{-- 1. Dynamic Category Header --}}
    <div class="mb-8">
        <h2 class="text-[11px] font-black uppercase tracking-[0.4em] text-[#111827] flex items-center gap-4">
            <span class="w-12 h-0.5 bg-[#52c234]"></span>
            {{ $activeCategory }}
        </h2>
    </div>

    {{-- 2. Loading Skeleton: Only during navigation/filtering, not basket actions --}}
    <div wire:loading wire:target="updateFilter, searchTerm, activeCategory" class="w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 animate-pulse">
            @for ($i = 0; $i < ($foodItems->count() ?: 4); $i++)
                <div class="bg-gray-100 rounded-2xl h-[180px] w-full border border-gray-200"></div>
            @endfor
        </div>
    </div>

    {{-- 3. Main Grid: Hidden only during filter/search loading --}}
    <div wire:loading.remove wire:target="updateFilter, searchTerm, activeCategory"
         class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">

        @forelse($foodItems as $item)
            @php
                $isSoldOut = $item->quantity <= 0;
                $isLowStock = !$isSoldOut && $item->quantity < 5;

                $percentage = (!$isSoldOut && $item->original_price > 0 && $item->discounted_price < $item->original_price)
                    ? round((($item->original_price - $item->discounted_price) / $item->original_price) * 100)
                    : 0;

                $imageSrc = $item->image_path
                    ? asset('storage/' . $item->image_path)
                    : asset('images/placeholder-food.jpg');
            @endphp

            <div
                wire:key="deal-{{ $item->id }}"
                class="group bg-white rounded-2xl border border-gray-100 p-4 flex justify-between
                       min-h-[180px] transition-all duration-300 ease-out
                       {{ $isSoldOut ? 'opacity-60 cursor-not-allowed' : 'cursor-pointer hover:shadow-xl hover:-translate-y-1.5 active:scale-[0.98]' }}"
            >

                {{-- Left: Text Content --}}
                <div class="flex flex-col justify-between py-1 pr-2 flex-1 min-w-0">
                    <div>
                        {{-- Badges Row --}}
                        <div class="flex flex-wrap gap-1.5 mb-2">
                            @if($isSoldOut)
                                <span class="bg-gray-100 text-gray-500 text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded inline-block border border-gray-200">
                                    Sold Out
                                </span>
                            @elseif($percentage > 0)
                                <span class="bg-[#52c234]/10 text-[#437836] text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded inline-block border border-[#52c234]/20">
                                    {{ $percentage }}% OFF
                                </span>
                            @endif

                            @if($isLowStock)
                                <span class="bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded inline-block border border-red-100">
                                    <i class="fas fa-fire-alt mr-0.5"></i> Only {{ $item->quantity }} left
                                </span>
                            @endif
                        </div>

                        {{-- Title --}}
                        <h3 class="text-[#111827] font-bold text-base leading-tight mb-1 truncate">
                            {{ $item->item_name }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-[#4B5563] font-normal text-xs line-clamp-2 leading-snug italic">
                            {{ $item->description }}
                        </p>
                    </div>

                    {{-- Price & Stock --}}
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

                {{-- Right: Image + Add Button --}}
                <div class="relative flex-shrink-0 w-28 h-28 self-center overflow-hidden rounded-xl bg-gray-50 border border-gray-100 shadow-sm">
                    <img
                        src="{{ $imageSrc }}"
                        alt="{{ $item->item_name }}"
                        loading="lazy"
                        class="w-full h-full object-cover transition-transform duration-500 ease-in-out {{ $isSoldOut ? '' : 'group-hover:scale-110' }}"
                        onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=200&auto=format&fit=crop'"
                    >

                    {{-- Sold Out Overlay --}}
                    @if($isSoldOut)
                        <div class="absolute inset-0 bg-white/70 flex items-center justify-center rounded-xl">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 rotate-[-20deg]">Sold Out</span>
                        </div>
                    @else
                        {{-- Add to Basket Button (min 44px touch target via padding trick) --}}
                        <button
                            wire:click="addToBasket({{ $item->id }})"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75"
                            aria-label="Add {{ $item->item_name }} to basket"
                            class="absolute bottom-1 right-1 bg-white min-w-[36px] min-h-[36px] w-9 h-9 rounded-full shadow-lg
                                   flex items-center justify-center text-[#437836]
                                   hover:bg-[#52c234] hover:text-white hover:scale-110
                                   active:scale-95 transition-all duration-150 z-10
                                   disabled:opacity-50 disabled:cursor-not-allowed focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#52c234]"
                        >
                            {{-- Plus icon --}}
                            <i class="fas fa-plus text-xs"
                               wire:loading.remove wire:target="addToBasket({{ $item->id }})"></i>

                            {{-- Spinner --}}
                            <div wire:loading wire:target="addToBasket({{ $item->id }})"
                                 class="w-3.5 h-3.5 border-2 border-[#52c234] border-t-transparent rounded-full animate-spin"></div>
                        </button>
                    @endif
                </div>

            </div>
        @empty
            {{-- Empty State --}}
            <div class="col-span-full py-24 flex flex-col items-center gap-4 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center shadow-inner">
                    <i class="fas fa-search text-xl text-gray-300"></i>
                </div>
                <div>
                    <p class="text-[11px] font-black uppercase tracking-[0.4em] text-gray-300">No matching deals found</p>
                    <p class="text-xs text-gray-300 mt-1 font-normal">Try a different category or search term</p>
                </div>
            </div>
        @endforelse

    </div>
</div>