<div class="min-h-screen bg-white flex flex-col items-center justify-start py-16 px-4 animate-fadeIn">

    {{-- ══════════════════════════════════
         SUCCESS MARK + HEADING
         ══════════════════════════════════ --}}
    <div class="flex flex-col items-center text-center mb-10">

        <div class="relative w-20 h-20 mb-6">
            <div class="absolute inset-0 bg-black/5 rounded-full animate-ping-slow"></div>
            <div class="relative w-full h-full bg-black rounded-full flex items-center justify-center shadow-xl shadow-black/20">
                <svg class="w-9 h-9 text-white animate-check-draw" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
        </div>

        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-[#52c234] mb-2">Success</p><h1 class="text-4xl font-black text-gray-900 tracking-tight uppercase">Order Confirmed!</h1>
        <p class="text-gray-500 mt-2 text-sm max-w-sm">
            @if($order->payment_method === 'cod')
                Your order has been placed. Pay when your delivery arrives.
            @else
                Payment received. Your order is being prepared.
            @endif
        </p>
    </div>

    {{-- ══════════════════════════════════
         RECEIPT CARD
         ══════════════════════════════════ --}}
    <div class="w-full max-w-xl">
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">

            {{-- Receipt header --}}
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.25em] text-[#52c234]">Receipt</p>
                    <p class="text-xl font-black text-gray-900 mt-0.5">Order #{{ $order->id }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Placed on</p>
                    <p class="text-sm font-bold text-gray-700 mt-0.5">
                        {{ $order->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>
            </div>

            <div class="px-8 py-6 space-y-6">

                {{-- Status + payment method --}}
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 bg-black text-white text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full">
                        <i class="fas fa-circle text-[6px] text-[#52c234]"></i>
                        {{ ucfirst($order->status) }}
                    </span>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <i class="fas {{ $order->payment_method === 'card' ? 'fa-credit-card' : 'fa-money-bill-wave' }} text-gray-400"></i>
                        <span class="font-medium">
                            {{ $order->payment_method === 'card' ? 'Card Payment' : 'Cash on Delivery' }}
                        </span>
                    </div>
                </div>

                {{-- Delivery info --}}
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 space-y-2.5">
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Delivery To</p>

                    <div class="flex items-start gap-3">
                        <i class="fas fa-user text-gray-300 text-xs mt-0.5 w-4 shrink-0"></i>
                        <span class="text-sm font-medium text-gray-700">{{ $customerName }}</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-phone text-gray-300 text-xs mt-0.5 w-4 shrink-0"></i>
                        <span class="text-sm font-medium text-gray-700">{{ $order->phone ?? '—' }}</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-gray-300 text-xs mt-0.5 w-4 shrink-0"></i>
                        <span class="text-sm font-medium text-gray-700">{{ $order->delivery_address }}</span>
                    </div>
                    @if($order->notes)
                        <div class="flex items-start gap-3">
                            <i class="fas fa-note-sticky text-gray-300 text-xs mt-0.5 w-4 shrink-0"></i>
                            <span class="text-sm italic text-gray-500">{{ $order->notes }}</span>
                        </div>
                    @endif
                </div>

                {{-- Line items --}}
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4">Items Ordered</p>
                    <div class="space-y-3">
                        @foreach($order->items as $item)
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <span class="shrink-0 w-7 h-7 bg-black text-white text-[10px] font-black rounded-full flex items-center justify-center">
                                        {{ $item->quantity }}
                                    </span>
                                    <span class="text-sm font-medium text-gray-800 truncate">{{ $item->name }}</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900 shrink-0 tabular-nums">
                                    Rs. {{ number_format($item->subtotal) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tear line --}}
                <div class="relative -mx-8">
                    <div class="flex items-center">
                        <div class="w-5 h-5 bg-white border border-gray-200 -ml-2.5 rounded-full shrink-0"></div>
                        <div class="flex-1 border-t border-dashed border-gray-200 mx-1"></div>
                        <div class="w-5 h-5 bg-white border border-gray-200 -mr-2.5 rounded-full shrink-0"></div>
                    </div>
                </div>

                {{-- Totals --}}
                <div class="space-y-2">
                    <div class="flex justify-between text-sm text-gray-400">
                        <span>Subtotal</span>
                        <span class="tabular-nums">Rs. {{ number_format($order->total_amount) }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-400">
                        <span>Delivery Fee</span>
                        <span class="text-[#52c234] font-bold">Free</span>
                    </div>
                    <div class="flex justify-between items-end pt-3 border-t border-gray-100">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Total Paid</span>
                        <span class="text-3xl font-black text-gray-900 tabular-nums leading-none">
                            Rs. {{ number_format($order->total_amount) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-8 pb-8 flex flex-col items-center gap-4 border-t border-gray-100 pt-6">
                <p class="text-xs text-gray-400 text-center">
                    @if($order->payment_method === 'cod')
                        Please have the exact amount ready when your order arrives.
                    @else
                        A confirmation has been sent to your email.
                    @endif
                </p>

                <button wire:click="goHome"
                        class="w-full bg-black hover:bg-[#52c234] text-white py-4 rounded-xl font-black
                               uppercase text-sm tracking-wide transition-all duration-300
                               active:scale-[0.98] shadow-lg flex items-center justify-center gap-2">
                    <i class="fas fa-home text-sm"></i>
                    <span>Back to Home</span>
                </button>
            </div>
        </div>

        {{-- Eco note --}}
        <div class="flex items-center justify-center gap-2 mt-6 text-[11px] text-gray-400">
            <i class="fas fa-leaf text-[#52c234]"></i>
            <span>You're helping reduce food waste. Thank you!</span>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.5s ease-out forwards; }

        @keyframes ping-slow {
            0%, 100% { transform: scale(1);   opacity: 0.4; }
            50%       { transform: scale(1.6); opacity: 0; }
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
    </style>
</div>