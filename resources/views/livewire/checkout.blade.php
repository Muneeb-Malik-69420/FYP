<div
    wire:key="checkout-page"
    x-data="{
        selectedMethod: $wire.entangle('paymentMethod', true),
        loadingLocation: false,

        async locateMe() {
            if (!navigator.geolocation) return alert('Geolocation not supported');
            this.loadingLocation = true;

            navigator.geolocation.getCurrentPosition(async (pos) => {
                try {
                    const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${pos.coords.latitude}&lon=${pos.coords.longitude}`);
                    const data = await res.json();
                    const addr = data.address;
                    const parts = [
                        addr.house_number,
                        addr.road,
                        addr.suburb || addr.neighbourhood,
                        addr.city || addr.town || addr.village
                    ].filter(Boolean);
                    @this.set('address', parts.join(', '));
                } catch (e) {
                    alert('Could not detect address.');
                } finally {
                    this.loadingLocation = false;
                }
            }, () => {
                this.loadingLocation = false;
                alert('Location access denied.');
            }, { timeout: 10000 });
        }
    }"
    class="animate-fadeIn min-h-screen bg-white font-sans"
>
    <form wire:submit.prevent="placeOrder" class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">

        {{-- Global order error --}}
        @error('order')
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-sm text-xs text-red-700 flex items-center gap-3 font-black uppercase tracking-widest">
                <i class="fas fa-circle-exclamation shrink-0"></i>
                <span>{{ $message }}</span>
            </div>
        @enderror

        <div class="grid lg:grid-cols-12 gap-8 items-start">

            {{-- ═══════════════════════════════
                 LEFT: FORM
            ═══════════════════════════════ --}}
            <div class="lg:col-span-8 space-y-6">

                {{-- Page heading --}}
                <div>
                    {{-- <p class="text-[10px] font-black uppercase tracking-widest text-primary mb-1">Checkout</p> --}}
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight uppercase leading-[0.9]">
                        Confirm &amp; Pay
                    </h2>
                    <p class="text-gray-400 mt-3 text-xs font-medium tracking-wide">
                        @auth
                            Review your details and confirm your order.
                        @else
                            Please provide your details below to complete the order.
                        @endauth
                    </p>
                </div>

                {{-- ── DELIVERY DETAILS CARD ── --}}
                <div class="bg-cardcolor rounded-sm p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-7 h-7 bg-primary text-white rounded-sm flex items-center justify-center text-[10px]">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3 class="font-black text-gray-900 uppercase tracking-widest text-[11px]">Delivery Details</h3>
                        @auth
                            <span class="ml-auto text-[10px] font-black uppercase tracking-widest text-gray-400 bg-white px-2.5 py-1 rounded-sm border border-gray-200">
                                From your profile
                            </span>
                        @endauth
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Name --}}
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-800">Full Name</label>
                            <input type="text"
                                   wire:model.blur="name"
                                   placeholder="John Doe"
                                   @auth readonly @endauth
                                   class="w-full mt-2 border rounded-sm p-3.5 text-sm transition-all outline-none
                                          @error('name') border-red-400 bg-red-50 @else border-gray-200 bg-white @enderror
                                          @auth text-gray-400 cursor-default focus:ring-0 @else focus:ring-2 focus:ring-black focus:border-black @endauth">
                            @error('name') <span class="text-[10px] text-red-500 mt-1 block font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-800">Email</label>
                            @auth
                                <input type="email"
                                       value="{{ auth()->user()->email }}"
                                       readonly
                                       class="w-full mt-2 bg-white border border-gray-200 rounded-sm p-3.5 text-sm text-gray-400 cursor-default outline-none">
                            @else
                                <input type="email"
                                       wire:model.blur="email"
                                       placeholder="john@example.com"
                                       class="w-full mt-2 border rounded-sm p-3.5 text-sm transition-all outline-none
                                              @error('email') border-red-400 bg-red-50 @else border-gray-200 bg-white @enderror
                                              focus:ring-2 focus:ring-black focus:border-black">
                                @error('email') <span class="text-[10px] text-red-500 mt-1 block font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                            @endauth
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-800">Phone Number</label>
                            <input type="tel"
                                   wire:model.blur="phone"
                                   placeholder="03XXXXXXXXX"
                                   class="w-full mt-2 border rounded-sm p-3.5 text-sm transition-all outline-none
                                          @error('phone') border-red-400 bg-red-50 @else border-gray-200 bg-white @enderror
                                          focus:ring-2 focus:ring-black focus:border-black">
                            @error('phone') <span class="text-[10px] text-red-500 mt-1 block font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                        </div>

                        {{-- Address + geolocation --}}
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-800">Delivery Address</label>
                            <div class="relative mt-2">
                                <input type="text"
                                       wire:model.blur="address"
                                       placeholder="House / Street / Area"
                                       class="w-full border rounded-sm p-3.5 pr-12 text-sm transition-all outline-none
                                              @error('address') border-red-400 bg-red-50 @else border-gray-200 bg-white @enderror
                                              focus:ring-2 focus:ring-black focus:border-black">
                                <button type="button"
                                        @click="locateMe()"
                                        :disabled="loadingLocation"
                                        title="Detect my location"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center
                                               rounded-sm text-gray-800 hover:text-black hover:bg-gray-100
                                               transition-colors disabled:cursor-not-allowed disabled:opacity-50">
                                    <i class="fas fa-location-arrow text-xs"
                                       :class="loadingLocation ? 'animate-spin text-black' : ''"></i>
                                </button>
                            </div>
                            @error('address') <span class="text-[10px] text-red-500 mt-1 block font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="md:col-span-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-800">
                                Order Notes
                                <span class="font-normal normal-case text-gray-800 ml-1">(optional)</span>
                            </label>
                            <textarea wire:model.blur="notes"
                                      rows="2"
                                      placeholder="Any special instructions..."
                                      class="w-full mt-2 bg-white border border-gray-200 rounded-sm p-3.5 text-sm
                                             focus:ring-2 focus:ring-black focus:border-black transition-all outline-none resize-none"></textarea>
                            @error('notes') <span class="text-[10px] text-red-500 mt-1 block font-black uppercase tracking-widest">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- ── PAYMENT METHOD CARD ── --}}
                <div class="bg-cardcolor rounded-sm p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-7 h-7 bg-primary text-white rounded-sm flex items-center justify-center text-[10px]">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3 class="font-black text-gray-900 uppercase tracking-widest text-[11px]">Payment Method</h3>
                    </div>

                    <div class="grid gap-3">
                        @foreach([
                            'cod'  => ['label' => 'Cash on Delivery',    'icon' => 'fa-money-bill-wave', 'desc' => 'Pay when your order arrives.'],
                            'card' => ['label' => 'Credit / Debit Card', 'icon' => 'fa-credit-card',     'desc' => 'Secure payment via Stripe.'],
                        ] as $value => $data)
                            <label class="relative flex items-center justify-between p-4 border-2 rounded-sm cursor-pointer transition-all duration-200"
                                   :class="selectedMethod === '{{ $value }}'
                                       ? 'border-primary bg-white'
                                       : 'border-gray-100 hover:border-gray-300 bg-white'">

                                <input type="radio" name="payment" value="{{ $value }}" x-model="selectedMethod" class="hidden">

                                <div class="flex items-center gap-4">
                                    <div class="w-9 h-9 rounded-sm flex items-center justify-center transition-colors"
                                         :class="selectedMethod === '{{ $value }}' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-400'">
                                        <i class="fas {{ $data['icon'] }} text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-black uppercase tracking-widest text-gray-900">{{ $data['label'] }}</p>
                                        <p class="text-[10px] text-gray-400 mt-0.5">{{ $data['desc'] }}</p>
                                    </div>
                                </div>

                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all shrink-0"
                                     :class="selectedMethod === '{{ $value }}' ? 'border-primary bg-primary' : 'border-gray-200'">
                                    <i x-show="selectedMethod === '{{ $value }}'" class="fas fa-check text-[8px] text-white"></i>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <div x-show="selectedMethod === 'card'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="mt-4 p-4 bg-white border border-gray-200 rounded-sm flex items-start gap-3">
                        <i class="fas fa-shield-halved text-gray-400 mt-0.5 shrink-0 text-xs"></i>
                        <p class="text-[10px] text-gray-500 leading-relaxed tracking-wide">
                            You will be redirected to a 256-bit encrypted Stripe portal to safely enter your card details.
                        </p>
                    </div>
                </div>

                {{-- Guest login prompt --}}
                @guest
                    <p class="text-[11px] text-gray-400 text-center pb-4 tracking-wide">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-black font-black hover:underline uppercase tracking-widest">Log in</a>
                        for a faster checkout.
                    </p>
                @endguest
            </div>

            {{-- ═══════════════════════════════
                 RIGHT: ORDER SUMMARY
            ═══════════════════════════════ --}}
            <div class="lg:col-span-4 lg:sticky lg:top-8">
                <div class="bg-cardcolor rounded-sm p-6 lg:p-8">

                    <div class="flex items-center justify-between mb-6">
                        <h3 class="bg-black text-white px-2.5 py-1 rounded-sm text-[11px] font-black uppercase tracking-widest  ">Order Summary</h3>
                        <span class="bg-primary text-white px-2.5 py-1 rounded-sm text-[10px] font-black uppercase tracking-widest">
                            {{ count($cart) }} {{ Str::plural('item', count($cart)) }}
                        </span>
                    </div>

                    <div class="space-y-3 max-h-[40vh] overflow-y-auto pr-1 custom-scrollbar">
                        @forelse($cart as $item)
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-grow min-w-0">
                                    <p class="text-xs font-bold text-gray-800 truncate">{{ $item['name'] }}</p>
                                    <p class="text-[10px] text-gray-800 mt-0.5 tracking-wide">
                                        {{ $item['quantity'] }} × Rs. {{ number_format($item['price']) }}
                                    </p>
                                </div>
                                <span class="text-xs font-extrabold text-gray-900 shrink-0 tabular-nums">
                                    Rs. {{ number_format($item['price'] * $item['quantity']) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 text-[10px] font-black uppercase tracking-widest py-6">Your cart is empty</p>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-6 border-t  border-gray-800 space-y-2">
                        <div class="flex justify-between text-[10px] text-gray-800 font-black uppercase tracking-widest">
                            <span>Subtotal</span>
                            <span class="tabular-nums">Rs. {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between text-[10px] font-black uppercase tracking-widest">
                            <span class="text-gray-800">Delivery Fee</span>
                            <span class="text-primary">Free</span>
                        </div>
                        <div class="flex justify-between items-end pt-4 border-t border-gray-800">
                            <span class="text-[10px] font-black uppercase tracking-widest text-gray-800">Grand Total</span>
                            <span class="text-3xl font-black text-gray-900 tabular-nums leading-none">
                                Rs. {{ number_format($total) }}
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="mt-8 w-full bg-primary hover:bg-primary disabled:opacity-50 disabled:cursor-not-allowed
                                   text-white py-4 rounded-sm font-black uppercase text-[11px] tracking-widest
                                   transition-all duration-300 active:scale-[0.97] shadow-lg shadow-black/10
                                   flex items-center justify-center gap-2 second">

                        <div wire:loading.remove wire:target="placeOrder" class="flex items-center gap-2">
                            <i :class="selectedMethod === 'card' ? 'fas fa-lock' : 'fas fa-shopping-bag'" class="text-xs"></i>
                            <span x-text="selectedMethod === 'card' ? 'Proceed to Pay' : 'Place Order Now'"></span>
                        </div>

                        <div wire:loading wire:target="placeOrder" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                            </svg>
                            <span>Processing...</span>
                        </div>
                    </button>
                </div>
            </div>

        </div>
    </form>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0);   }
        }
        .animate-fadeIn {
            animation: fadeIn 0.4s ease-out forwards;
        }

        .custom-scrollbar::-webkit-scrollbar       { width: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #111; }
    </style>
</div>