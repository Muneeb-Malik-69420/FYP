<div x-data x-on:open-cart.window="$wire.openDrawer()">

    {{-- BACKDROP --}}
    <div x-show="$wire.open"
         x-transition.opacity
         x-cloak
         class="fixed inset-0 z-[110]"
         style="background:rgba(0,0,0,0.25); backdrop-filter:blur(4px);"
         wire:click="$set('open', false)">
    </div>

    {{-- DRAWER --}}
    <div x-show="$wire.open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         x-cloak
         class="fixed right-0 top-0 h-full w-[340px] z-[120] flex flex-col bg-white shadow-2xl">

        {{-- TOP GREEN BAR --}}
        {{-- <div class="h-[3px]" style="background:linear-gradient(90deg,#52c234,#86efac,#52c234);"></div> --}}

        {{-- HEADER --}}
        <div class="px-6 pt-6 pb-5 border-b border-gray-100">

            <div class="flex items-start justify-between">

                <div>
                    {{-- <div class="flex items-center gap-2 mb-1.5">
                        <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                        <span class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400">
                            EcoBite
                        </span>
                    </div> --}}

                    <h2 class="font-black text-gray-900 uppercase text-[22px] leading-none">
                        Your <span class="text-primary">Basket</span>
                    </h2>

                    <p class="text-[10px] text-gray-800 mt-1.5 font-medium">
                        {{ $itemCount }} {{ $itemCount === 1 ? 'item' : 'items' }}
                        @if($itemCount > 0)
                        · Rs. {{ number_format($total,0) }} total
                        @endif
                    </p>
                </div>

                <div class="flex gap-2">

                    @if(!empty($cart))
                    <button wire:click="clearBasket"
                            class="w-8 h-8 flex items-center justify-center rounded-xl border border-gray-200 text-gray-800 hover:text-red-500 hover:bg-red-50 transition">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    @endif

                    <button wire:click="$set('open', false)"
                            class="w-8 h-8 flex items-center justify-center rounded-xl border border-gray-200 text-gray-800 hover:bg-gray-100">
                        <i class="fas fa-times text-xs"></i>
                    </button>

                </div>

            </div>

        </div>


        {{-- ITEMS --}}
        <div class="flex-1 overflow-y-auto py-4 px-4 space-y-2">

            @forelse($cart as $id => $item)

            <div wire:key="drawer-item-{{ $id }}"
     class="group cart-enter flex items-center gap-3 p-3  border border-gray-100 bg-white
     transition-all duration-300 ease-out
     hover:border-green-200
     hover:bg-green-50/20
     hover:-translate-y-[2px]
     hover:shadow-[0_8px_25px_rgba(82,194,52,0.15)]"
     style="animation-delay: {{ $loop->index * 60 }}ms">

                {{-- SQUARE IMAGE --}}
                <div class="w-14 h-14 rounded-xl overflow-hidden border border-gray-200 shrink-0">

                    @php
                    $hasImage = !empty($item['image']) && Illuminate\Support\Facades\Storage::disk('public')->exists($item['image']);
                    @endphp

                    <img src="{{ $hasImage ? asset('storage/'.$item['image']) : 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=200' }}"
                         class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-110"
                         alt="{{ $item['name'] }}">

                </div>


                {{-- INFO --}}
                <div class="flex-1 min-w-0">

                    {{-- NAME --}}
                    <div class="flex justify-between items-start">

                        <p class="font-bold text-[11px] uppercase text-gray-900 truncate">
                            {{ $item['name'] }}
                        </p>

                        <button wire:click="removeFromCart({{ $id }})"
                                class="text-gray-300 hover:text-red-500 transition">
                            <i class="fas fa-times text-[10px]"></i>
                        </button>

                    </div>


                    {{-- PRICE + QTY + TOTAL --}}
                    <div class="flex items-center justify-between mt-2">

                        <div class="flex items-center gap-3">

                            {{-- PRICE --}}
                            <span class="text-[11px] font-bold text-gray-900">
                                Rs. {{ number_format($item['price'],0) }}
                            </span>

                            {{-- QUANTITY PILL --}}
                            <div class="flex items-center bg-gray-100 rounded-full">

                                <button wire:click="updateQuantity({{ $id }}, 'decrease')"
                                        class="w-7 h-7 flex items-center justify-center text-gray-500 hover:text-black">
                                    <i class="fas fa-minus text-[9px]"></i>
                                </button>

                                <span class="px-2 text-[11px] font-bold tabular-nums">
                                    {{ $item['quantity'] }}
                                </span>

                                <button wire:click="updateQuantity({{ $id }}, 'increase')"
                                        class="w-7 h-7 flex items-center justify-center text-gray-500 hover:text-black">
                                    <i class="fas fa-plus text-[9px]"></i>
                                </button>

                            </div>

                        </div>

                        {{-- LINE TOTAL --}}
                        <span class="text-[13px] font-black text-gray-900 tabular-nums">
                            Rs. {{ number_format($item['price'] * $item['quantity'],0) }}
                        </span>

                    </div>

                </div>

            </div>

            @empty

            {{-- EMPTY STATE --}}
            <div class="flex flex-col items-center justify-center h-64 gap-5 text-center px-6">

                <div class="w-16 h-16 rounded-2xl flex items-center justify-center bg-green-50 border-2 border-dashed border-green-200">
                    <i class="fas fa-shopping-cart text-xl text-green-400"></i>
                </div>

                <div>
                    <p class="font-black text-[11px] uppercase tracking-widest text-gray-700">
                        Nothing here yet
                    </p>

                    <p class="text-[10px] text-gray-400 mt-1.5">
                        Add items from any restaurant to get started
                    </p>
                </div>

            </div>

            @endforelse

        </div>


        {{-- FOOTER --}}
         @if(!empty($cart)) 
        <div class="px-5 py-4 border-t border-gray-100 space-y-3">

            {{-- @if($savings > 0)

            <div class="flex justify-between items-center px-3 py-2 rounded-xl bg-green-50 border border-green-200">

                <span class="text-[10px] font-bold text-green-600 uppercase">
                    You're Saving
                </span>

                <span class="text-[11px] font-bold text-green-600">
                    Rs. {{ number_format($savings,0) }}
                </span>

            </div>

            @endif --}} 


            <div class="flex justify-between text-sm">

                <span class="text-gray-800 uppercase text-[10px]">
                    Delivery
                </span>

                <span class="text-primary font-bold text-[10px] uppercase">
                    Free
                </span>

            </div>


            <div class="flex justify-between items-center">

                <span class="font-bold text-gray-900 text-sm">
                    Total
                </span>

                <span class="text-xl font-black text-gray-900">
                    Rs. {{ number_format($total,0) }}
                </span>

            </div>


            <button wire:click="processCheckout"
                    wire:loading.attr="disabled"
                    class="w-full py-4 rounded-2xl text-white font-bold text-[11px] uppercase tracking-widest bg-primary hover:bg-green-500 transition">

                <span wire:loading.remove wire:target="processCheckout">
                    Checkout
                </span>

                <span wire:loading wire:target="processCheckout">
                    Processing...
                </span>

            </button>

        </div>
        @endif


        {{-- BRAND FOOTER
        <div class="px-5 py-3 border-t border-gray-100 flex justify-between items-center">

            <div class="flex items-center gap-2">

                <div class="w-5 h-5 bg-black rounded-full flex items-center justify-center">
                    <i class="fas fa-leaf text-green-400 text-[7px]"></i>
                </div>

                <span class="text-[9px] font-bold text-gray-300 uppercase tracking-widest">
                    EcoBite
                </span>

            </div>

            <div class="flex items-center gap-1">

                <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>

                <span class="text-[9px] text-gray-300">
                    Live
                </span>

            </div> --}}

        </div>

    </div>

</div>