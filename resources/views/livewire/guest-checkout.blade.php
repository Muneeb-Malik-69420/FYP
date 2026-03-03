<div wire:key="guest-checkout-page" 
     x-data="{ selectedMethod: @entangle('payment_method').live }"
     x-on:redirect-to-stripe.window="window.location.href = $event.detail.url"
     class="min-h-screen bg-[#f8fafc] py-12 px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    {{-- <div class="max-w-6xl mx-auto mb-8">
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Checkout</h1>
        <p class="text-gray-500 mt-2">
            Complete your order as a guest. 
            <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline">Already have an account? Log in</a>
        </p>
    </div> --}}

    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

        {{-- LEFT: FORM --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Shipping Info --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Shipping Information
                    </h2>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Full Name --}}
                    <div class="md:col-span-2">
                        <label class="text-xs font-black uppercase text-gray-400 mb-2">Full Name</label>
                        <input type="text" wire:model.blur="full_name" placeholder="John Doe" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                        @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 mb-2">Email</label>
                        <input type="email" wire:model.blur="email" placeholder="john@example.com" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 mb-2">Phone</label>
                        <input type="text" wire:model.blur="phone" placeholder="03XXXXXXXXX" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Address --}}
                    <div class="md:col-span-2">
                        <label class="text-xs font-black uppercase text-gray-400 mb-2">Delivery Address</label>
                        <textarea wire:model.blur="address" rows="3" placeholder="House #, Street, Area, City" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none"></textarea>
                        @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Payment Method --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Payment Method
                    </h2>
                </div>

                <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach(['cod'=>'Cash on Delivery','card'=>'Credit / Debit Card','easypaisa'=>'EasyPaisa','jazzcash'=>'JazzCash'] as $value=>$label)
                        <label class="relative flex items-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200 {{ $payment_method === $value ? 'border-green-500 bg-green-50/50' : 'border-gray-100 hover:border-gray-200 hover:bg-gray-50' }}">
                            <input type="radio" value="{{ $value }}" wire:model.live="payment_method" class="w-4 h-4 text-green-600 border-gray-300">
                            <span class="ml-3 font-bold text-gray-700">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>

                {{-- Dynamic Input for card/wallet --}}
                <div class="mt-6">
                    @if($payment_method==='card')
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 space-y-4">
                            <input type="text" placeholder="Card Number" wire:model.blur="card_number" class="w-full border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" placeholder="MM/YY" wire:model.blur="card_expiry" class="border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                                <input type="text" placeholder="CVC" wire:model.blur="card_cvc" class="border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                            </div>
                        </div>
                    @elseif(in_array($payment_method,['easypaisa','jazzcash']))
                        <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">{{ ucfirst($payment_method) }} Account Number</label>
                            <input type="text" placeholder="03XXXXXXXXX" wire:model.blur="wallet_number" class="w-full border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE: ORDER SUMMARY --}}
        <div class="lg:sticky lg:top-8">
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <h2 class="text-xl font-black text-gray-800 mb-6">Order Summary</h2>
                    <div class="space-y-4 mb-8 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($cart as $item)
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex-1">
                                    <p class="font-bold text-gray-800 leading-tight">{{ $item['name'] }}</p>
                                    <p class="text-gray-400 text-xs font-medium">Qty: {{ $item['quantity'] }}</p>
                                </div>
                                <p class="font-black text-gray-700">Rs. {{ number_format($item['price'] * $item['quantity']) }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 border-t border-dashed border-gray-200 pt-6">
                        <div class="flex justify-between text-gray-500 font-medium">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($this->total) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500 font-medium">
                            <span>Shipping</span>
                            <span class="text-green-600 font-bold">FREE</span>
                        </div>
                        <div class="flex justify-between items-center pt-4">
                            <span class="text-lg font-black text-gray-900">Total</span>
                            <span class="text-2xl font-black text-green-700">Rs. {{ number_format($this->total) }}</span>
                        </div>
                    </div>

                    <button wire:click="placeOrder" wire:loading.attr="disabled" class="w-full mt-8 bg-black text-white rounded-2xl py-4 font-black text-lg shadow-lg shadow-black/10 hover:bg-gray-800 transition-all active:scale-[0.98] disabled:opacity-70 group">
                        <span wire:loading.remove>Confirm Order</span>
                        <span wire:loading>Processing...</span>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</div>