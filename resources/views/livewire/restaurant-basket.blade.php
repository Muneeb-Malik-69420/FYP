<div class="h-full py-4 lg:pl-8 lg:border-l lg:border-gray-200 flex flex-col">
    <div class="bg-white border border-gray-200 p-6 flex flex-col h-full rounded-xl shadow-sm">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-50">
            <div class="flex items-center gap-3">
                <div wire:key="basket-icon-{{ count($cart) }}" class="relative animate-pop">
                    <i class="fas fa-shopping-basket text-[14px] text-[#437836]"></i>
                </div>
                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-900">
                    Your Basket
                </h2>
            </div>

            <span class="text-[10px] font-bold text-[#437836] bg-[#52c234]/10 px-2 py-0.5 rounded-full">
                {{ collect($cart)->sum('quantity') }} Items
            </span>
        </div>

        {{-- Scrollable List --}}
        <div class="flex-grow overflow-y-auto no-scrollbar space-y-4">
            @forelse($cart as $id => $item)
                <div wire:key="basket-item-{{ $id }}" class="flex items-center gap-3 animate-fadeIn">

                    {{-- Thumbnail --}}
                    <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden border border-gray-50">
                        <img src="{{ $item['image'] ? asset('storage/' . $item['image']) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=100' }}"
                             class="w-full h-full object-cover">
                    </div>

                    <div class="flex-grow min-w-0">
                        <div class="flex justify-between items-start">
                            <h4 class="text-[10px] font-black text-gray-800 uppercase truncate pr-2">
                                {{ $item['name'] }}
                            </h4>

                            <button wire:click="removeFromCart({{ $id }})"
                                    class="text-gray-400 hover:text-red-500 transition-colors">
                                <i class="fas fa-trash text-[9px]"></i>
                            </button>
                        </div>

                        <div class="flex justify-between items-center mt-2">

                            {{-- Quantity --}}
                            <div class="flex items-center bg-white border border-gray-200 rounded-full px-1 py-0.5 shadow-sm">
                                <button wire:click="updateQuantity({{ $id }}, 'decrease')"
                                        class="w-5 h-5 flex items-center justify-center text-gray-400 hover:text-black transition-colors">
                                    <i class="fas fa-minus text-[7px]"></i>
                                </button>

                                <span class="text-[9px] font-black text-gray-900 px-2 min-w-[15px] text-center">
                                    {{ $item['quantity'] }}
                                </span>

                                <button wire:click="updateQuantity({{ $id }}, 'increase')"
                                        class="w-5 h-5 flex items-center justify-center text-[#52c234] hover:scale-110 transition-transform">
                                    <i class="fas fa-plus text-[7px]"></i>
                                </button>
                            </div>

                            <span class="text-[10px] font-black text-gray-900">
                                Rs. {{ number_format($item['price'] * $item['quantity']) }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-16 px-6 text-center h-full">
                    <div class="w-20 h-20 bg-[#52c234]/5 rounded-full flex items-center justify-center">
                        <i class="fas fa-utensils text-3xl text-gray-200"></i>
                    </div>

                    <h3 class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-900 mt-6">
                        Basket is Empty
                    </h3>

                    <p class="text-[11px] text-gray-400 italic mt-2">
                        Browse fresh deals to fill it up!
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Footer --}}
        <div class="mt-6 pt-4 border-t border-gray-100 space-y-3">

            <div class="flex justify-between items-center">
                <span class="text-[11px] font-black uppercase tracking-tighter text-gray-900">
                    Total
                </span>
                <span class="text-lg font-black text-[#437836]">
                    Rs. {{ number_format($total) }}
                </span>
            </div>

            <button wire:click="processCheckout"
                    wire:loading.attr="disabled"
                    {{ empty($cart) ? 'disabled' : '' }}
                    class="w-full bg-black text-white py-4 text-[10px] font-black uppercase tracking-[0.2em]
                           hover:bg-[#437836] transition-all rounded-lg shadow-lg flex items-center justify-center gap-3
                           disabled:opacity-60 disabled:cursor-not-allowed">

                <span wire:loading.remove wire:target="processCheckout">
                    Checkout
                </span>

                <div wire:loading wire:target="processCheckout" class="flex items-center gap-2">
                    <div class="w-3 h-3 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    <span>Preparing Order...</span>
                </div>
            </button>

        </div>
    </div>
</div>