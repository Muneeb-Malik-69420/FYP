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
    class="min-h-screen bg-[#F9FAFB]"
>
    <form wire:submit.prevent="placeOrder" class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">

        {{-- Global order error --}}
        @error('order')
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-sm text-red-700 flex items-center gap-3">
                <i class="fas fa-circle-exclamation shrink-0"></i>
                <span>{{ $message }}</span>
            </div>
        @enderror

        <div class="grid lg:grid-cols-12 gap-8 items-start">

            {{-- ═══════════════════════════════
                 LEFT: FORM
            ═══════════════════════════════ --}}
            <div class="lg:col-span-8 space-y-6">

                <div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">
                        Confirm Delivery &
                        <span class="text-[#52c234]">Payment</span>
                    </h2>
                    <p class="text-gray-500 mt-2 text-sm">
                        @auth
                            Review your details and confirm your order.
                        @else
                            Please provide your details below to complete the order.
                        @endauth
                    </p>
                </div>

                {{-- ── DELIVERY DETAILS CARD ── --}}
                <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-green-100 text-[#52c234] rounded-full flex items-center justify-center text-xs">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Delivery Details</h3>
                        @auth
                            <span class="ml-auto text-[10px] font-black uppercase tracking-widest text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">
                                From your profile
                            </span>
                        @endauth
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Name --}}
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Full Name</label>
                            <input type="text"
                                   wire:model.blur="name"
                                   placeholder="John Doe"
                                   @auth readonly @endauth
                                   class="w-full mt-2 border rounded-xl p-4 text-sm transition-all outline-none
                                          @error('name') border-red-400 bg-red-50 @else border-gray-200 bg-gray-50 @enderror
                                          @auth text-gray-500 cursor-default focus:ring-0 @else focus:ring-2 focus:ring-[#52c234] focus:bg-white @endauth">
                            @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Email</label>
                            @auth
                                <input type="email"
                                       value="{{ auth()->user()->email }}"
                                       readonly
                                       class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm text-gray-500 cursor-default outline-none">
                            @else
                                <input type="email"
                                       wire:model.blur="email"
                                       placeholder="john@example.com"
                                       class="w-full mt-2 border rounded-xl p-4 text-sm transition-all outline-none
                                              @error('email') border-red-400 bg-red-50 @else border-gray-200 bg-gray-50 @enderror
                                              focus:ring-2 focus:ring-[#52c234] focus:bg-white">
                                @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            @endauth
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Phone Number</label>
                            <input type="tel"
                                   wire:model.blur="phone"
                                   placeholder="03XXXXXXXXX"
                                   class="w-full mt-2 border rounded-xl p-4 text-sm transition-all outline-none
                                          @error('phone') border-red-400 bg-red-50 @else border-gray-200 bg-gray-50 @enderror
                                          focus:ring-2 focus:ring-[#52c234] focus:bg-white">
                            @error('phone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Address + geolocation --}}
                        <div>
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Delivery Address</label>
                            <div class="relative mt-2">
                                <input type="text"
                                       wire:model.blur="address"
                                       placeholder="House / Street / Area"
                                       class="w-full border rounded-xl p-4 pr-12 text-sm transition-all outline-none
                                              @error('address') border-red-400 bg-red-50 @else border-gray-200 bg-gray-50 @enderror
                                              focus:ring-2 focus:ring-[#52c234] focus:bg-white">
                                <button type="button"
                                        @click="locateMe()"
                                        :disabled="loadingLocation"
                                        title="Detect my location"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center
                                               rounded-lg text-gray-400 hover:text-[#52c234] hover:bg-green-50
                                               transition-colors disabled:cursor-not-allowed disabled:opacity-50">
                                    <i class="fas fa-location-arrow"
                                       :class="loadingLocation ? 'animate-spin text-[#52c234]' : ''"></i>
                                </button>
                            </div>
                            @error('address') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Notes --}}
                        <div class="md:col-span-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                Order Notes
                                <span class="font-normal normal-case text-gray-300 ml-1">(optional)</span>
                            </label>
                            <textarea wire:model.blur="notes"
                                      rows="2"
                                      placeholder="Any special instructions..."
                                      class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm
                                             focus:ring-2 focus:ring-[#52c234] focus:bg-white transition-all outline-none resize-none"></textarea>
                            @error('notes') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                {{-- ── PAYMENT METHOD CARD ── --}}
                <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-green-100 text-[#52c234] rounded-full flex items-center justify-center text-xs">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Payment Method</h3>
                    </div>

                    <div class="grid gap-4">
                        @foreach([
                            'cod'  => ['label' => 'Cash on Delivery',    'icon' => 'fa-money-bill-wave', 'desc' => 'Pay when your order arrives.'],
                            'card' => ['label' => 'Credit / Debit Card', 'icon' => 'fa-credit-card',     'desc' => 'Secure payment via Stripe.'],
                        ] as $value => $data)
                            <label class="relative flex items-center justify-between p-4 border-2 rounded-2xl cursor-pointer transition-all duration-200"
                                   :class="selectedMethod === '{{ $value }}'
                                       ? 'border-[#52c234] bg-green-50'
                                       : 'border-gray-100 hover:border-gray-200 bg-white'">

                                <input type="radio" name="payment" value="{{ $value }}" x-model="selectedMethod" class="hidden">

                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-colors"
                                         :class="selectedMethod === '{{ $value }}' ? 'bg-[#52c234] text-white' : 'bg-gray-100 text-gray-400'">
                                        <i class="fas {{ $data['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800">{{ $data['label'] }}</p>
                                        <p class="text-xs text-gray-500">{{ $data['desc'] }}</p>
                                    </div>
                                </div>

                                <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-all shrink-0"
                                     :class="selectedMethod === '{{ $value }}' ? 'border-[#52c234] bg-[#52c234]' : 'border-gray-200'">
                                    <i x-show="selectedMethod === '{{ $value }}'" class="fas fa-check text-[10px] text-white"></i>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <div x-show="selectedMethod === 'card'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="mt-4 p-4 bg-blue-50 border border-blue-100 rounded-2xl flex items-start gap-3">
                        <i class="fas fa-shield-halved text-blue-500 mt-0.5 shrink-0"></i>
                        <p class="text-xs text-blue-700 leading-relaxed">
                            You will be redirected to a 256-bit encrypted Stripe portal to safely enter your card details.
                        </p>
                    </div>
                </div>

                {{-- Guest login prompt --}}
                @guest
                    <p class="text-sm text-gray-400 text-center pb-4">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-[#52c234] font-bold hover:underline">Log in</a>
                        for a faster checkout.
                    </p>
                @endguest
            </div>

            {{-- ═══════════════════════════════
                 RIGHT: ORDER SUMMARY
            ═══════════════════════════════ --}}
            <div class="lg:col-span-4 lg:sticky lg:top-8">
                <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-xl border border-gray-100">

                    <h3 class="text-xs font-bold uppercase tracking-widest text-[#52c234] flex items-center justify-between">
                        Order Summary
                        <span class="bg-green-100 text-[#437836] px-2.5 py-1 rounded-full text-[10px]">
                            {{ count($cart) }} {{ Str::plural('item', count($cart)) }}
                        </span>
                    </h3>

                    <div class="mt-6 space-y-4 max-h-[40vh] overflow-y-auto pr-1 custom-scrollbar">
                        @forelse($cart as $item)
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-grow min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $item['quantity'] }} × Rs. {{ number_format($item['price']) }}
                                    </p>
                                </div>
                                <span class="text-sm font-bold text-gray-900 shrink-0 tabular-nums">
                                    Rs. {{ number_format($item['price'] * $item['quantity']) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-center text-gray-400 text-sm italic py-4">Your cart is empty</p>
                        @endforelse
                    </div>

                    <div class="mt-8 pt-6 border-t border-dashed border-gray-200 space-y-3">
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Subtotal</span>
                            <span class="tabular-nums">Rs. {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Delivery Fee</span>
                            <span class="text-[#52c234] font-bold">Free</span>
                        </div>
                        <div class="flex justify-between items-end pt-2">
                            <span class="font-bold text-gray-800">Grand Total</span>
                            <span class="text-2xl font-black text-gray-900 tabular-nums leading-none">
                                Rs. {{ number_format($total) }}
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                            wire:loading.attr="disabled"
                            class="mt-8 w-full bg-[#52c234] hover:bg-[#45a82b] disabled:opacity-50 disabled:cursor-not-allowed
                                   text-white py-4 rounded-2xl font-bold uppercase text-sm tracking-wide
                                   transition-all active:scale-[0.98] shadow-lg shadow-green-200
                                   flex items-center justify-center gap-2">

                        <div wire:loading.remove wire:target="placeOrder" class="flex items-center gap-2">
                            <i :class="selectedMethod === 'card' ? 'fas fa-lock' : 'fas fa-shopping-bag'"></i>
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
        .custom-scrollbar::-webkit-scrollbar       { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #52c234; }
    </style>
</div>