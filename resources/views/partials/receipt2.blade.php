<div class="h-[calc(100vh-61px)] bg-white flex flex-col justify-center font-sans animate-fadeIn overflow-hidden">

    <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-stretch">

            {{-- ══════════════════════════════════
                 LEFT: STATUS + DELIVERY + CTA
            ══════════════════════════════════ --}}
            <div class="bg-cardcolor rounded-sm flex flex-col h-full">

                {{-- Header --}}
                <div class="px-6 py-4 border-b border-gray-200 flex items-center gap-4">
                    <div class="relative w-10 h-10 shrink-0">
                        <div class="absolute inset-0 bg-black/5 rounded-full animate-ping-slow"></div>
                        <div class="relative w-full h-full bg-primary rounded-full flex items-center justify-center shadow-lg shadow-black/20">
                            <svg class="w-5 h-5 text-white animate-check-draw" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-primary mb-0.5">Success</p>
                        <p class="text-base font-black text-gray-900 uppercase tracking-tight">Order Confirmed!</p>
                    </div>
                </div>

                <div class="px-6 py-4 space-y-4 flex-1 flex flex-col justify-between">
                    <div class="space-y-4">

                        {{-- Subtext --}}
                        <p class="text-gray-400 text-xs font-medium tracking-wide">
                            @if($order->payment_method === 'cod')
                                Your order has been placed. Pay when your delivery arrives.
                            @else
                                Payment received. Your order is being prepared.
                            @endif
                        </p>

                        {{-- Delivery info --}}
                        <div class="bg-white rounded-sm px-4 py-3 border border-gray-200 space-y-1.5">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Delivery To</p>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-user text-gray-300 text-xs w-4 shrink-0" aria-hidden="true"></i>
                                <span class="text-xs font-bold text-gray-700">{{ $customerName }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone text-gray-300 text-xs w-4 shrink-0" aria-hidden="true"></i>
                                <span class="text-xs font-bold text-gray-700">{{ $order->phone ?? '—' }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-map-marker-alt text-gray-300 text-xs w-4 shrink-0" aria-hidden="true"></i>
                                <span class="text-xs font-bold text-gray-700">{{ $order->delivery_address }}</span>
                            </div>
                            @if($order->notes)
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-note-sticky text-gray-300 text-xs w-4 shrink-0" aria-hidden="true"></i>
                                    <span class="text-xs italic text-gray-400">{{ $order->notes }}</span>
                                </div>
                            @endif
                        </div>

                        {{-- Order meta --}}
                        <div class="bg-white rounded-sm px-4 py-3 border border-gray-200 space-y-1.5">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Order Details</p>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Order</span>
                                <span class="text-[11px] font-black uppercase tracking-widest text-gray-900">#{{ $order->id }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Status</span>
                                <span class="inline-flex items-center gap-1.5 bg-primary text-white text-[10px] font-black uppercase tracking-widest px-2.5 py-1 rounded-sm">
                                    {{-- <i class="fas fa-circle text-[6px] text-primary"></i> --}}
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Payment</span>
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-900 flex items-center gap-1.5">
                                    <i class="fas {{ $order->payment_method === 'card' ? 'fa-credit-card' : 'fa-money-bill-wave' }} text-gray-400 text-xs" aria-hidden="true"></i>
                                    {{ $order->payment_method === 'card' ? 'Card' : 'Cash on Delivery' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CTA footer --}}
                <div class="px-6 pb-4 border-t border-gray-200 pt-4 flex flex-col gap-2">
                    <button wire:click="goHome"
                            class="w-full bg-primary hover:opacity-90 text-white py-3.5 rounded-sm
                                   font-black uppercase text-[11px] tracking-widest transition-all duration-300
                                   active:scale-[0.98] shadow-lg shadow-black/10 flex items-center justify-center gap-2">
                        <i class="fas fa-home text-xs" aria-hidden="true"></i>
                        <span>Back to Home</span>
                    </button>
                    <div class="flex items-center justify-center gap-2">
                        <i class="fas fa-leaf text-primary text-xs" aria-hidden="true"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Helping reduce food waste</span>
                    </div>
                </div>
            </div>

            {{-- ══════════════════════════════════
                 RIGHT: RECEIPT (items + totals)
            ══════════════════════════════════ --}}
            <div class="w-full">
                <div class="bg-cardcolor rounded-sm flex flex-col h-full">

                    {{-- Receipt header --}}
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-primary mb-0.5">Receipt</p>
                            <p class="text-base font-black text-gray-900 uppercase tracking-tight">Order #{{ $order->id }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Placed on</p>
                            <p class="text-xs font-bold text-gray-700 mt-0.5">
                                {{ $order->created_at->format('d M Y, h:i A') }}
                            </p>
                        </div>
                    </div>

                   <div class="px-6 py-4 space-y-4 flex-1 flex flex-col justify-end">

                        {{-- Line items --}}
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Items Ordered</p>
                            <div class="space-y-2 max-h-[30vh] overflow-y-auto pr-1 custom-scrollbar">
                                @foreach($order->items as $item)
                                    <div class="flex items-center justify-between gap-4">
                                        <div class="flex items-center gap-2.5 min-w-0">
                                            <span class="shrink-0 w-5 h-5 bg-primary text-white text-[9px] font-black rounded-sm flex items-center justify-center">
                                                {{ $item->quantity }}
                                            </span>
                                            <span class="text-xs font-bold text-gray-800 truncate">{{ $item->name }}</span>
                                        </div>
                                        <span class="text-xs font-extrabold text-gray-900 shrink-0 tabular-nums">
                                            Rs. {{ number_format($item->subtotal) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Tear line --}}
                        <div class="relative -mx-6">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-cardcolor border border-gray-200 -ml-2 rounded-full shrink-0"></div>
                                <div class="flex-1 border-t border-dashed border-gray-200 mx-1"></div>
                                <div class="w-4 h-4 bg-cardcolor border border-gray-200 -mr-2 rounded-full shrink-0"></div>
                            </div>
                        </div>

                        {{-- Totals --}}
                        <div class="space-y-1.5">
                            <div class="flex justify-between text-[10px] font-black uppercase tracking-widest text-gray-400">
                                <span>Subtotal</span>
                                <span class="tabular-nums">Rs. {{ number_format($order->total_amount) }}</span>
                            </div>
                            <div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
                                <span class="text-gray-400">Delivery Fee</span>
                                <span class="text-primary">Free</span>
                            </div>
                            <div class="flex justify-between items-end pt-3 border-t border-gray-200">
                                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Total Paid</span>
                                <span class="text-2xl font-black text-gray-900 tabular-nums leading-none">
                                    Rs. {{ number_format($order->total_amount) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Footer note --}}
                    <div class="px-6 pb-4 border-t border-gray-200 pt-4">
                        <p class="text-[10px] text-gray-400 text-center font-medium tracking-wide">
                            @if($order->payment_method === 'cod')
                                Please have the exact amount ready when your order arrives.
                            @else
                                A confirmation has been sent to your email.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0);   }
        }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }

        @keyframes ping-slow {
            0%, 100% { transform: scale(1);   opacity: 0.4; }
            50%       { transform: scale(1.6); opacity: 0;   }
        }
        .animate-ping-slow { animation: ping-slow 2s ease-out infinite; }

        @keyframes check-draw {
            from { stroke-dashoffset: 30; opacity: 0; }
            to   { stroke-dashoffset: 0;  opacity: 1; }
        }
        .animate-check-draw {
            stroke-dasharray: 30;
            stroke-dashoffset: 30;
            animation: check-draw 0.4s ease-out 0.2s forwards;
            opacity: 0;
        }

        .custom-scrollbar::-webkit-scrollbar       { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #111; }
    </style>
</div>