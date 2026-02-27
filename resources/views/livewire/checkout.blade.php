{{-- Parent locked to viewport, perfectly synchronized with your ~64px Navbar height --}}
<div class="h-screen bg-[#F9FAFB] pt-[64px] flex flex-col overflow-hidden">

    {{-- Main Wrapper: Centers content and creates clean side gutters --}}
    <div class="max-w-7xl mx-auto w-full flex-grow flex flex-col overflow-hidden">

        {{-- True Grid: Split 8:4 for professional balance --}}
        <div class="flex-grow grid lg:grid-cols-12 gap-0 overflow-hidden">

            {{-- LEFT COLUMN: Independent Scrollable Form (Col-Span-8) --}}
            <div class="lg:col-span-8 h-full overflow-y-auto px-10 py-10 no-scrollbar">

                {{-- Breadcrumb Navigation --}}
                <div class="mb-8">
                    <a href="/explore"
                        class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#52c234] transition-colors group">
                        <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                        Back to Menu
                    </a>
                </div>

                {{-- Header Section --}}
                <div class="mb-10">
                    <h3 class="text-3xl font-black uppercase tracking-tighter text-gray-900 leading-none">
                        Confirm Delivery & <span class="text-[#52c234]">Payment</span>
                    </h3>
                </div>

                <div class="space-y-6 pb-24">
                    {{-- Delivery Information Card --}}
                    <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm">
                        <h3
                            class="text-[10px] font-black uppercase tracking-widest text-gray-900 mb-8 flex items-center gap-3">
                            <i class="fas fa-map-marker-alt text-[#52c234]"></i> Delivery Details
                        </h3>

                        <div class="space-y-5">
                            <div>
                                <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-1">Full
                                    Name</label>
                                <div
                                    class="w-full mt-1 bg-gray-50 border border-gray-100 rounded-xl p-4 text-sm font-black text-gray-800 uppercase shadow-inner">
                                    {{ $name }}
                                </div>
                            </div>

                            <div>
                                <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-1">Street
                                    Address</label>
                                <input type="text" wire:model.blur="address" placeholder="House/Street/Area"
                                    class="w-full mt-1 bg-gray-50 border @error('address') border-red-500 @else border-gray-100 @enderror rounded-xl p-4 text-sm font-medium focus:ring-2 focus:ring-[#52c234] outline-none transition-all">
                                @error('address')
                                    <span
                                        class="text-[10px] text-red-500 font-bold mt-1 block ml-1 italic">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="text-[9px] font-black uppercase tracking-widest text-gray-400 ml-1">Phone
                                    Number</label>
                                <input type="text" wire:model.blur="phone" placeholder="03XXXXXXXXX"
                                    class="w-full mt-1 bg-gray-50 border @error('phone') border-red-500 @else border-gray-100 @enderror rounded-xl p-4 text-sm font-medium focus:ring-2 focus:ring-[#52c234] outline-none transition-all">
                                @error('phone')
                                    <span
                                        class="text-[10px] text-red-500 font-bold mt-1 block ml-1 italic">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Payment Section Card --}}
                    <div class="bg-white border border-gray-100 rounded-[2rem] p-8 shadow-sm">
                        <h3
                            class="text-[10px] font-black uppercase tracking-widest text-gray-900 mb-8 flex items-center gap-3">
                            <i class="fas fa-credit-card text-[#52c234]"></i> Payment Method
                        </h3>

                        {{-- <label
                            class="relative flex items-center justify-between p-6 border-2 rounded-2xl cursor-pointer border-[#52c234] bg-[#52c234]/5 ring-4 ring-[#52c234]/5 transition-all">
                            <div class="flex flex-col">
                                <span class="text-[11px] font-black uppercase tracking-widest text-gray-900">Cash on
                                    Delivery</span>
                                <span class="text-[9px] text-gray-400 font-bold uppercase mt-1 italic">Pay at your
                                    doorstep</span>
                            </div>
                            <i class="fas fa-money-bill-wave text-2xl text-[#52c234]"></i>
                            <input type="radio" wire:model="paymentMethod" value="cod" class="hidden">
                        </label> --}}
                        {{-- Cash on Delivery --}}
                        <label
                            class="flex items-center justify-between p-5 border-2 rounded-2xl cursor-pointer transition-all {{ $paymentMethod === 'cod' ? 'border-[#52c234] bg-[#52c234]/5 ring-4 ring-[#52c234]/5' : 'border-gray-50 hover:border-gray-200' }}">
                            <div class="flex items-center gap-4">
                                <img width="40px" src="https://images.deliveryhero.io/image/foodpanda/payment_icons/payment_method/ic-payments-payment_on_delivery-xs.png" alt="" data-testid="payment-item-icon">
                                <span class="text-[11px] font-black uppercase tracking-widest text-gray-900">Cash on
                                    Delivery</span>
                            </div>
                            <input type="radio" wire:model="paymentMethod" value="cod" class="hidden">
                            <div
                                class="w-5 h-5 rounded-full border-2 {{ $paymentMethod === 'cod' ? 'border-[#52c234] bg-[#52c234]' : 'border-gray-300' }} flex items-center justify-center">
                                @if ($paymentMethod === 'cod')
                                    <i class="fas fa-check text-[10px] text-white"></i>
                                @endif
                            </div>
                        </label>

                        {{-- Card --}}
                        <label
                            class="flex items-center justify-between p-5 border-2 rounded-2xl cursor-pointer transition-all {{ $paymentMethod === 'card' ? 'border-[#52c234] bg-[#52c234]/5 ring-4 ring-[#52c234]/5' : 'border-gray-50 hover:border-gray-200' }}">
                            <div class="flex items-center gap-4">

                                <img width="40px"
                                    src="https://images.deliveryhero.io/image/foodpanda/payment_icons/payment_method/ic-payments-generic_creditcard-xs.png"
                                    alt="" data-testid="payment-item-icon">
                                <span class="text-[11px] font-black uppercase tracking-widest text-gray-900">Credit or
                                    Debit Card</span>
                                {{-- <img class="payment-method-item__inline-image"
                                    src="https://images.deliveryhero.io/image/foodpanda/payment_icons/payment_schema/ic-payments-Mastercard-xs.png"
                                    alt="Mastercard" aria-hidden="true"> --}}
                                {{-- <img class="payment-method-item__inline-image"
                                    src="https://images.deliveryhero.io/image/foodpanda/payment_icons/payment_schema/ic-payments-Visa-xs.png"
                                    alt="Visa" aria-hidden="true"> --}}
                            </div>
                            <input type="radio" wire:model="paymentMethod" value="card" class="hidden">
                            <div
                                class="w-5 h-5 rounded-full border-2 {{ $paymentMethod === 'card' ? 'border-[#52c234] bg-[#52c234]' : 'border-gray-300' }}">
                            </div>
                        </label>

                        {{-- JazzCash --}}
                        <label
                            class="flex items-center justify-between p-5 border-2 rounded-2xl cursor-pointer transition-all {{ $paymentMethod === 'jazzcash' ? 'border-[#52c234] bg-[#52c234]/5 ring-4 ring-[#52c234]/5' : 'border-gray-50 hover:border-gray-200' }}">
                            <div class="flex items-center gap-4">
                                <img width="40px"
                                    src="https://images.deliveryhero.io/image/foodpanda/payment_icons/payment_method/ic-payments-jazzcash_wallet-xs.png"
                                    alt="" data-testid="payment-item-icon">
                                <span
                                    class="text-[11px] font-black uppercase tracking-widest text-gray-900">JazzCash</span>
                            </div>
                            <input type="radio" wire:model="paymentMethod" value="jazzcash" class="hidden">
                            <div
                                class="w-5 h-5 rounded-full border-2 {{ $paymentMethod === 'jazzcash' ? 'border-[#52c234] bg-[#52c234]' : 'border-gray-300' }}">
                            </div>
                        </label>

                        {{-- EasyPaisa --}}
                        <label
                            class="flex items-center justify-between p-5 border-2 rounded-2xl cursor-pointer transition-all {{ $paymentMethod === 'easypaisa' ? 'border-[#52c234] bg-[#52c234]/5 ring-4 ring-[#52c234]/5' : 'border-gray-50 hover:border-gray-200' }}">
                            <div class="flex items-center gap-4">
                                <img width="40px"
                                    src="https://images.deliveryhero.io/image/foodpanda/payment_icons/payment_method/ic-payments-antfinancial_easypaisa-xs.png"
                                    alt="" data-testid="payment-item-icon">
                                <span
                                    class="text-[11px] font-black uppercase tracking-widest text-gray-900">EasyPaisa</span>
                            </div>
                            <input type="radio" wire:model="paymentMethod" value="easypaisa" class="hidden">
                            <div
                                class="w-5 h-5 rounded-full border-2 {{ $paymentMethod === 'easypaisa' ? 'border-[#52c234] bg-[#52c234]' : 'border-gray-300' }}">
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: Fixed Pillar Summary (Col-Span-4) --}}
            <div class="lg:col-span-4 h-full bg-white border-l border-gray-100 p-6 flex flex-col">
                <div class="bg-gray-900 rounded-[2.5rem] p-8 h-full flex flex-col shadow-2xl">
                    <div class="flex justify-between items-center mb-10">
                        <h3 class="text-[9px] font-black uppercase tracking-[0.4em] text-gray-500">Order Summary</h3>
                        <div class="w-10 h-[2px] bg-[#52c234] rounded-full"></div>
                    </div>

                    {{-- Independent Inner Scroll for long carts --}}
                    <div class="flex-grow space-y-6 overflow-y-auto pr-2 no-scrollbar">
                        @foreach ($cart as $item)
                            <div
                                class="flex justify-between items-center group transition-transform hover:translate-x-1">
                                <div class="flex items-center gap-4">
                                    <span
                                        class="w-8 h-8 flex items-center justify-center bg-white/10 rounded-xl text-[10px] font-black text-white italic border border-white/5">{{ $item['quantity'] }}x</span>
                                    <span
                                        class="font-black uppercase text-[11px] tracking-widest text-gray-200">{{ $item['name'] }}</span>
                                </div>
                                <span class="font-black text-white text-sm italic">Rs.
                                    {{ number_format($item['price'] * $item['quantity']) }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pinned Totals Section --}}
                    <div class="mt-10 pt-10 border-t border-white/10">
                        <div
                            class="flex justify-between text-[11px] font-bold uppercase tracking-widest text-gray-500 mb-6">
                            <span>Subtotal</span>
                            <span class="text-gray-200">Rs. {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between items-end mb-10">
                            <span class="text-[12px] font-black uppercase tracking-widest text-white italic">Total
                                Bill</span>
                            <span
                                class="text-5xl font-black text-[#52c234] tracking-tighter italic leading-none drop-shadow-xl">Rs.
                                {{ number_format($total) }}</span>
                        </div>

                        {{-- Action Button with Haptic-Feel Loading --}}
                        <button wire:click="placeOrder" wire:loading.attr="disabled"
                            class="w-full bg-[#52c234] hover:bg-white hover:text-black text-white py-6 rounded-2xl font-black uppercase text-[11px] tracking-[0.4em] transition-all transform active:scale-95 shadow-xl shadow-[#52c234]/20 flex justify-center items-center gap-3">

                            <span wire:loading.remove wire:target="placeOrder">Place Order Now</span>
                            <span wire:loading wire:target="placeOrder" class="flex items-center gap-2">
                                <i class="fas fa-spinner animate-spin text-lg"></i>
                                <span>Processing</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>
        /* 💎 Premium Scroll Hiding */
.no-scrollbar::-webkit-scrollbar {
    display: none; /* Chrome/Safari */
}
.no-scrollbar {
    -ms-overflow-style: none; /* IE/Edge */
    scrollbar-width: none; /* Firefox */
}
    </style>
</div>
