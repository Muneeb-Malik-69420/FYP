<div class="h-full py-4 lg:pl-8 lg:border-l lg:border-gray-200 flex flex-col">
    <div class="bg-white border border-gray-200 flex flex-col h-full rounded-xl shadow-sm overflow-hidden">

        {{-- ── Header ── --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="flex items-center gap-2.5">
                <div wire:key="basket-icon-{{ $itemCount }}" class="relative animate-pop">
                    <i class="fas fa-shopping-basket text-[13px] text-[#027d51]"></i>
                    @if($itemCount > 0)
                        <span class="absolute -top-1.5 -right-2 bg-[#52c234] text-white text-[7px] font-black
                                     w-3.5 h-3.5 rounded-full flex items-center justify-center leading-none">
                            {{ $itemCount > 9 ? '9+' : $itemCount }}
                        </span>
                    @endif
                </div>
                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-900">Your Basket</h2>
            </div>

            {{-- Clear all — only shown when cart has items --}}
            @if(!empty($cart))
                <button wire:click="clearBasket"
                        wire:confirm="Clear your entire basket?"
                        class="text-[8px] font-black uppercase tracking-widest text-gray-300
                               hover:text-red-400 transition-colors duration-200">
                    Clear All
                </button>
            @endif
        </div>

        {{-- ── Scrollable item list ── --}}
        <div class="flex-grow overflow-y-auto custom-scrollbar px-5 py-4 space-y-3">
            @forelse($cart as $id => $item)
                <div wire:key="basket-item-{{ $id }}"
                     class="group flex items-center gap-3 p-2.5 rounded-xl bg-gray-50/80
                            hover:bg-gray-100/80 transition-colors duration-200 animate-fadeIn">

                    {{-- Thumbnail --}}
                    <div class="w-11 h-11 rounded-lg bg-gray-100 overflow-hidden border border-gray-200/60 shrink-0">
                        @if(!empty($item['image']))
                            <img src="{{ asset('storage/' . $item['image']) }}"
                                 class="w-full h-full object-cover"
                                 alt="{{ $item['name'] }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[#027d51]/5">
                                <i class="fas fa-leaf text-[#027d51]/30 text-sm"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Details --}}
                    <div class="flex-grow min-w-0">

                        {{-- Name + remove --}}
                        <div class="flex justify-between items-start gap-1">
                            <h4 class="text-[9px] font-black text-gray-800 uppercase tracking-wide truncate leading-tight">
                                {{ $item['name'] }}
                            </h4>
                            <button wire:click="removeFromCart({{ $id }})"
                                    class="shrink-0 opacity-0 group-hover:opacity-100 text-gray-300
                                           hover:text-red-400 transition-all duration-200 ml-1">
                                <i class="fas fa-times text-[9px]"></i>
                            </button>
                        </div>

                        {{-- Unit price --}}
                        <p class="text-[8px] text-gray-400 mt-0.5">
                            Rs. {{ number_format($item['price'], 0) }} each
                            @if(!empty($item['original_price']) && $item['original_price'] > $item['price'])
                                <span class="line-through text-gray-300 ml-1">Rs. {{ number_format($item['original_price'], 0) }}</span>
                            @endif
                        </p>

                        {{-- Qty controls + line total --}}
                        <div class="flex justify-between items-center mt-2">
                            <div class="flex items-center bg-white border border-gray-200 rounded-full shadow-sm overflow-hidden">
                                <button wire:click="updateQuantity({{ $id }}, 'decrease')"
                                        class="w-6 h-6 flex items-center justify-center text-gray-400
                                               hover:text-black hover:bg-gray-50 transition-all">
                                    <i class="fas fa-minus text-[7px]"></i>
                                </button>

                                <span wire:key="qty-{{ $id }}-{{ $item['quantity'] }}"
                                      class="text-[9px] font-black text-gray-900 px-2 min-w-[22px] text-center tabular-nums">
                                    {{ $item['quantity'] }}
                                </span>

                                <button wire:click="updateQuantity({{ $id }}, 'increase')"
                                        class="w-6 h-6 flex items-center justify-center text-[#027d51]
                                               hover:bg-[#027d51]/5 transition-all">
                                    <i class="fas fa-plus text-[7px]"></i>
                                </button>
                            </div>

                            <span class="text-[10px] font-black text-gray-900 tabular-nums">
                                Rs. {{ number_format($item['price'] * $item['quantity'], 0) }}
                            </span>
                        </div>
                    </div>
                </div>

            @empty
                {{-- ── Empty state ── --}}
                <div class="flex flex-col items-center justify-center h-full py-12 px-6 text-center">
                    <div class="relative w-20 h-20 mb-6">
                        <div class="absolute inset-0 bg-[#52c234]/8 rounded-full animate-pulse"></div>
                        <div class="relative w-full h-full flex items-center justify-center">
                            <svg viewBox="0 0 80 80" fill="none" class="w-14 h-14 opacity-20">
                                <circle cx="40" cy="40" r="36" stroke="#027d51" stroke-width="2"/>
                                <path d="M25 30h4l5 18h12l4-12H30" stroke="#027d51" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="36" cy="52" r="2" fill="#027d51"/>
                                <circle cx="46" cy="52" r="2" fill="#027d51"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-[10px] font-black uppercase tracking-[0.35em] text-gray-800">
                        Nothing here yet
                    </h3>
                    <p class="text-[10px] text-gray-400 mt-2 leading-relaxed max-w-[160px]">
                        Browse the deals and add something fresh!
                    </p>
                </div>
            @endforelse
        </div>

        {{-- ── Footer ── --}}
        @if(!empty($cart))
        <div class="px-5 pb-5 pt-3 border-t border-gray-100 space-y-3 mt-auto">

            {{-- Savings row --}}
            @if($savings > 0)
                <div class="flex justify-between items-center bg-[#52c234]/8 rounded-lg px-3 py-2">
                    <div class="flex items-center gap-1.5">
                        <i class="fas fa-tag text-[#027d51] text-[9px]"></i>
                        <span class="text-[9px] font-black uppercase tracking-widest text-[#027d51]">You Save</span>
                    </div>
                    <span class="text-[10px] font-black text-[#027d51] tabular-nums">
                        Rs. {{ number_format($savings, 0) }}
                    </span>
                </div>
            @endif

            {{-- Total row --}}
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400">Total</span>
                    <p class="text-[8px] text-gray-300 mt-0.5">{{ $itemCount }} {{ Str::plural('item', $itemCount) }}</p>
                </div>
                <span class="text-xl font-black text-gray-900 tabular-nums tracking-tight">
                    Rs. {{ number_format($total, 0) }}
                </span>
            </div>

            {{-- Checkout button --}}
            <button wire:click="processCheckout"
                    wire:loading.attr="disabled"
                    class="w-full bg-[#111827] text-white py-3.5 text-[10px] font-black uppercase tracking-[0.25em]
                           rounded-lg transition-all duration-300 flex items-center justify-center gap-2.5
                           hover:bg-[#027d51] shadow-lg hover:shadow-green-900/20
                           disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-[#111827]">

                <span wire:loading.remove wire:target="processCheckout" class="flex items-center gap-2">
                    <i class="fas fa-lock text-[9px] opacity-60"></i>
                    Checkout
                </span>

                <span wire:loading wire:target="processCheckout" class="flex items-center gap-2">
                    <svg class="w-3 h-3 animate-spin" viewBox="0 0 24 24" fill="none">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                    </svg>
                    Preparing Order...
                </span>
            </button>
        </div>
        @endif

    </div>
</div>