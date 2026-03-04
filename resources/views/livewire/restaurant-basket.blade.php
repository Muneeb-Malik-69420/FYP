{{-- Root wrapper --}}
<div class="h-full py-4 flex flex-col w-full animate-fadeIn">
    <div class="bg-white border border-gray-200 flex flex-col h-full rounded-sm overflow-hidden shadow-sm">

        {{-- ── Header ── --}}
        <div class="flex items-center justify-between px-5 py-3 border-b border-gray-100">
            <div class="flex items-center gap-2.5">
                <div wire:key="basket-icon-{{ $itemCount }}" class="relative animate-pop">
                    <i class="fas fa-shopping-cart text-sm text-[#52c234]"></i>
                    @if($itemCount > 0)
                        <span class="absolute -top-1.5 -right-2 bg-black text-white text-[8px] font-black
                                     w-4 h-4 rounded-full flex items-center justify-center leading-none">
                            {{ $itemCount > 9 ? '9+' : $itemCount }}
                        </span>
                    @endif
                </div>
                <h2 class="text-xs font-black uppercase tracking-widest text-gray-800">Your Basket</h2>
            </div>

            @if(!empty($cart))
                <button wire:click="clearBasket"
                        wire:confirm="Clear your entire basket?"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full border border-gray-200
                               text-[10px] font-black uppercase tracking-wider text-red-600
                               hover:text-red-500 hover:border-red-200 hover:bg-red-50
                               transition-all duration-200">
                    <i class="fas fa-trash-alt text-[8px]"></i>
                    Empty
                </button>
            @endif
        </div>

        {{-- ── Scrollable item list ── --}}
        <div class="relative flex-grow overflow-hidden">
            <div class="h-full overflow-y-auto custom-scrollbar px-4 py-2 space-y-2
                        [mask-image:linear-gradient(to_bottom,black_85%,transparent_100%)]">

                @forelse($cart as $id => $item)
                    <div wire:key="basket-item-{{ $id }}"
                         class="group flex items-center gap-3 p-2.5 rounded-xl bg-gray-50
                                 hover:bg-gray-100 border border-transparent hover:border-gray-200
                                 transition-all duration-200 animate-fadeIn">

                        {{-- Thumbnail with physical check --}}
                        <div class="w-11 h-11 rounded-lg bg-white overflow-hidden border border-gray-200 shrink-0 shadow-sm flex items-center justify-center">
                            @php
                                $hasImage = !empty($item['image']) && Illuminate\Support\Facades\Storage::disk('public')->exists($item['image']);
                            @endphp

                            @if($hasImage)
                                <img src="{{ asset('storage/' . $item['image']) }}"
                                     class="w-full h-full object-cover"
                                     alt="{{ $item['name'] }}"
                                     loading="lazy">
                            @else
                                <<img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=200"
                                     class="w-full h-full object-cover"
                                     alt="{{ $item['name'] }}"
                                     loading="lazy">
                            @endif
                        </div>

                        {{-- Details --}}
                        <div class="flex-grow min-w-0">
                            <div class="flex justify-between items-center gap-1">
                                <h4 class="text-xs font-black text-gray-800 uppercase tracking-wide truncate leading-tight">
                                    {{ $item['name'] }}
                                </h4>
                                <button wire:click="removeFromCart({{ $id }})"
                                        title="Remove item"
                                        class="shrink-0 text-red-600 hover:text-red-500 transition-all duration-150 ml-1 p-0.5">
                                    <i class="fas fa-trash-alt text-[10px]"></i>
                                </button>
                            </div>

                            <div class="flex items-center justify-between gap-2 mt-1.5">
                                <div class="flex items-center gap-1 shrink-0">
                                    <span class="text-[11px] font-semibold text-gray-800">
                                        Rs. {{ number_format($item['price'], 0) }}
                                    </span>
                                    @if(!empty($item['original_price']) && $item['original_price'] > $item['price'])
                                        <span class="text-[10px] line-through text-gray-400">
                                            Rs. {{ number_format($item['original_price'], 0) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="flex items-center bg-white border border-gray-200 rounded-full overflow-hidden shadow-sm shrink-0">
                                    <button wire:click="updateQuantity({{ $id }}, 'decrease')"
                                            class="w-6 h-6 flex items-center justify-center text-gray-700 hover:bg-gray-50 transition-all">
                                        <i class="fas fa-minus text-[7px]"></i>
                                    </button>
                                    <span wire:key="qty-{{ $id }}-{{ $item['quantity'] }}"
                                          class="text-xs font-black text-gray-800 px-1.5 min-w-[20px] text-center tabular-nums">
                                        {{ $item['quantity'] }}
                                    </span>
                                    <button wire:click="updateQuantity({{ $id }}, 'increase')"
                                            class="w-6 h-6 flex items-center justify-center text-gray-700 hover:bg-gray-50 transition-all">
                                        <i class="fas fa-plus text-[7px]"></i>
                                    </button>
                                </div>

                                <span class="text-sm font-black text-gray-800 tabular-nums shrink-0">
                                    Rs. {{ number_format($item['price'] * $item['quantity'], 0) }}
                                </span>
                            </div>
                        </div>
                    </div>

                @empty
                    {{-- ── Empty state ── --}}
                    <div class="flex flex-col items-center justify-center h-full py-12 px-6 text-center">
                        <div class="w-20 h-20 rounded-full bg-black flex items-center justify-center mb-5 text-[#52c234]">
                            <svg viewBox="0 0 24 24" fill="none" class="w-8 h-8 text text-[#52c234]"
                                 stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/>
                            </svg>
                        </div>
                        <h3 class="text-xs font-black uppercase tracking-widest text-gray-800">
                            Nothing here yet
                        </h3>
                        <p class="text-xs text-gray-800 mt-2 font-normal">Add items to get started</p>
                    </div>
                @endforelse

            </div>
        </div>

        {{-- ── Footer ── --}}
        @if(!empty($cart))
        <div class="px-5 py-3 border-t border-gray-100 space-y-2 mt-auto bg-white">
            <div class="flex justify-between items-center">
                <span class="text-xs font-semibold text-gray-800">Delivery</span>
                <span class="text-xs font-black uppercase tracking-wider text-[#52c234]">Free</span>
            </div>

            <div class="flex justify-between items-center">
                <div class="flex items-baseline gap-1.5">
                    <span class="text-xs font-black uppercase tracking-wider text-gray-800">Total</span>
                    <span class="text-xs font-medium text-gray-400">
                        · {{ $itemCount }} {{ Str::plural('item', $itemCount) }}
                    </span>
                </div>
                <span class="text-xl font-black text-gray-800 tabular-nums tracking-tight">
                    Rs. {{ number_format($total, 0) }}
                </span>
            </div>

            <button wire:click="processCheckout"
                    wire:loading.attr="disabled"
                    class="w-full bg-[#52c234] text-gray-800 py-3.5 text-xs font-black
                           uppercase tracking-widest rounded-xl transition-all duration-300
                           flex items-center justify-center gap-2.5 shadow-lg shadow-black/10
                           hover:bg-gray-800 hover:text-white active:scale-[0.985]
                           disabled:opacity-50 disabled:cursor-not-allowed">

                <span wire:loading.remove wire:target="processCheckout" class="flex items-center gap-2">
                    <i class="fas fa-lock text-[10px] opacity-60"></i>
                    Checkout
                </span>

                <span wire:loading wire:target="processCheckout" class="flex items-center gap-2">
                    <div class="w-3 h-3 border-2 border-white/20 border-t-white rounded-full animate-spin"></div>
                    Processing...
                </span>
            </button>
        </div>
        @endif
    </div>
</div>