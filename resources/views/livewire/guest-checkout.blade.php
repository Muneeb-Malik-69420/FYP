<div class="min-h-screen bg-[#f8fafc] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        
        {{-- Header Section --}}
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Checkout</h1>
            <p class="text-gray-500 mt-2">Complete your order as a guest. <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline">Already have an account? Log in</a></p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            {{-- LEFT SIDE: FORM --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Contact & Shipping Card --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Shipping Information
                        </h2>
                    </div>

                    <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- FULL NAME --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Full Name</label>
                            <input type="text" wire:model.blur="full_name" placeholder="John Doe"
                                class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 transition-all outline-none">
                            @error('full_name') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Email Address</label>
                            <input type="email" wire:model.blur="email" placeholder="john@example.com"
                                class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 transition-all outline-none">
                            @error('email') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- PHONE --}}
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Phone Number</label>
                            <input type="text" wire:model.blur="phone" placeholder="03XX-XXXXXXX"
                                class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 transition-all outline-none">
                            @error('phone') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>

                        {{-- ADDRESS --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Delivery Address</label>
                            <textarea wire:model.blur="address" rows="3" placeholder="House #, Street, Area, City"
                                class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 transition-all outline-none"></textarea>
                            @error('address') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Payment Methods Card --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-8 py-4 border-b border-gray-100">
                        <h2 class="font-bold text-gray-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Payment Method
                        </h2>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach([
                                'cod' => 'Cash on Delivery',
                                'card' => 'Credit / Debit Card',
                                'easypaisa' => 'Easypaisa',
                                'jazzcash' => 'JazzCash'
                            ] as $value => $label)
                                <label class="relative flex items-center p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200 group {{ $payment_method === $value ? 'border-green-500 bg-green-50/50' : 'border-gray-100 hover:border-gray-200 hover:bg-gray-50' }}">
                                    <input type="radio" value="{{ $value }}" wire:model.live="payment_method" class="w-4 h-4 text-green-600 focus:ring-green-500 border-gray-300">
                                    <span class="ml-3 font-bold text-gray-700">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>

                        {{-- Dynamic Inputs based on Method --}}
                        <div class="mt-6">
                            @if($payment_method === 'card')
                                <div class="p-6 bg-gray-50 rounded-2xl space-y-4 border border-gray-100 animate-in fade-in duration-300">
                                    <input type="text" placeholder="Card Number" wire:model.blur="card_number" class="w-full border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" placeholder="MM/YY" wire:model.blur="card_expiry" class="border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                                        <input type="text" placeholder="CVC" wire:model.blur="card_cvc" class="border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                                    </div>
                                </div>
                            @elseif(in_array($payment_method, ['easypaisa','jazzcash']))
                                <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100 animate-in fade-in duration-300">
                                    <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">{{ $payment_method }} Account Number</label>
                                    <input type="text" placeholder="03XXXXXXXXX" wire:model.blur="wallet_number" class="w-full border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 outline-none">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE: SUMMARY (Sticky) --}}
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

                        <button wire:click="placeOrder" wire:loading.attr="disabled"
                            class="w-full mt-8 bg-black text-white rounded-2xl py-4 font-black text-lg shadow-lg shadow-black/10 hover:bg-gray-800 transition-all active:scale-[0.98] disabled:opacity-70 group">
                            
                            <span wire:loading.remove class="flex items-center justify-center gap-2">
                                Confirm Order
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </span>

                            <span wire:loading class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Securing Order...
                            </span>
                        </button>
                        
                        <p class="text-center text-[10px] text-gray-400 mt-4 uppercase tracking-widest font-bold">
                            <span class="flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                SSL Secure 256-bit Encryption
                            </span>
                        </p>
                    </div>
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

