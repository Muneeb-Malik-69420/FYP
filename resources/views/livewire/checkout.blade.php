<div
    wire:key="guest-checkout-page"
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

                    const fullAddress = parts.join(', ');
                    @this.set('address', fullAddress);

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
    class="min-h-screen bg-[#F9FAFB] flex flex-col"
>
@error('order')
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-2xl text-sm text-red-700">
        <i class="fas fa-circle-exclamation mr-2"></i>{{ $message }}
    </div>
@enderror
    <form wire:submit.prevent="placeOrder" class="max-w-7xl mx-auto w-full flex-grow flex flex-col">
        <div class="flex-grow grid lg:grid-cols-12 gap-0">

            {{-- LEFT SIDE: Input Fields --}}
            <div class="lg:col-span-8 px-6 py-10 lg:px-10">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">
                        Confirm Delivery &
                        <span class="text-[#52c234]">Payment</span>
                    </h2>
                    <p class="text-gray-500 mt-2 text-sm">Please provide your details below to complete the order.</p>
                </div>

                <div class="space-y-8 pb-10">
                    {{-- DELIVERY CARD --}}
                    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 bg-green-100 text-[#52c234] rounded-full flex items-center justify-center text-xs">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h3 class="font-bold text-gray-800">Delivery Details</h3>
                        </div>

                        <div class="space-y-6">
                            {{-- Name --}}
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Full Name</label>
                                <input type="text"
                                       wire:model.blur="name"
                                       placeholder="John Doe"
                                       class="w-full mt-2 bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-xl p-4 text-sm focus:ring-2 focus:ring-[#52c234] focus:bg-white transition-all outline-none">
                                @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            {{-- Address --}}
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Street Address</label>
                                <div class="relative mt-2">
                                    <input type="text"
                                           wire:model.blur="address"
                                           placeholder="House / Street / Area"
                                           class="w-full bg-gray-50 border @error('address') border-red-500 @else border-gray-200 @enderror rounded-xl p-4 pr-12 text-sm focus:ring-2 focus:ring-[#52c234] focus:bg-white transition-all outline-none">

                                    <button type="button"
                                            @click="locateMe()"
                                            :disabled="loadingLocation"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-[#52c234] hover:bg-green-50 transition-colors disabled:cursor-not-allowed disabled:opacity-50">
                                        <i class="fas fa-location-arrow"
                                           :class="loadingLocation ? 'animate-spin text-[#52c234]' : ''"></i>
                                    </button>
                                </div>
                                @error('address') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label class="text-xs font-bold uppercase tracking-wider text-gray-400">Phone Number</label>
                                <input type="tel"
                                       wire:model.blur="phone"
                                       placeholder="03XXXXXXXXX"
                                       class="w-full mt-2 bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror rounded-xl p-4 text-sm focus:ring-2 focus:ring-[#52c234] focus:bg-white transition-all outline-none">
                                @error('phone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- PAYMENT CARD --}}
                    <div class="bg-white rounded-3xl p-6 lg:p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 bg-green-100 text-[#52c234] rounded-full flex items-center justify-center text-xs">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <h3 class="font-bold text-gray-800">Payment Method</h3>
                        </div>

                        <div class="grid gap-4">
                            @foreach ([
                                'cod' => ['label' => 'Cash on Delivery', 'icon' => 'fa-money-bill-wave', 'desc' => 'Pay when your order arrives.'],
                                'card' => ['label' => 'Credit / Debit Card', 'icon' => 'fa-credit-card', 'desc' => 'Secure payment via Stripe.'],
                            ] as $value => $data)

                                <label class="relative flex items-center justify-between p-4 border-2 rounded-2xl cursor-pointer transition-all"
                                     :class="selectedMethod === '{{ $value }}' ? 'border-[#52c234] bg-green-50' : 'border-gray-100 hover:border-gray-200'">

                                    <input type="radio" name="payment" value="{{ $value }}" x-model="selectedMethod" class="hidden">

                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" :class="selectedMethod === '{{ $value }}' ? 'bg-[#52c234] text-white' : 'bg-gray-100 text-gray-400'">
                                            <i class="fas {{ $data['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">{{ $data['label'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $data['desc'] }}</p>
                                        </div>
                                    </div>

                                    <div class="w-6 h-6 rounded-full border-2 flex items-center justify-center transition-colors"
                                         :class="selectedMethod === '{{ $value }}' ? 'border-[#52c234] bg-[#52c234]' : 'border-gray-200'">
                                        <i x-show="selectedMethod === '{{ $value }}'" class="fas fa-check text-[10px] text-white"></i>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div x-show="selectedMethod === 'card'" x-transition class="mt-4 p-4 bg-blue-50 border border-blue-100 rounded-2xl flex gap-3">
                            <i class="fas fa-shield-check text-blue-500 mt-0.5"></i>
                            <p class="text-xs text-blue-700 leading-relaxed">
                                You will be redirected to a 256-bit encrypted Stripe portal to safely enter your card details.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE: Summary --}}
            <div class="lg:col-span-4 bg-[#F0FDF4] lg:border-l border-green-100 p-6 lg:p-8">
                <div class="lg:sticky lg:top-8 bg-white rounded-3xl p-6 lg:p-8 shadow-xl border border-green-100 flex flex-col">

                    <h3 class="text-xs font-bold uppercase tracking-widest text-green-600 mb-6 flex items-center justify-between">
                        Order Summary
                        <span class="bg-green-100 px-2 py-1 rounded text-[10px]">{{ count($cart) }} Items</span>
                    </h3>

                    <div class="space-y-4 max-h-[40vh] overflow-y-auto pr-2 custom-scrollbar">
                        @forelse ($cart as $item)
                            <div class="flex justify-between items-start gap-4">
                                <div class="flex-grow">
                                    <p class="text-sm font-medium text-gray-800 line-clamp-1">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-400">{{ $item['quantity'] }} x Rs {{ number_format($item['price']) }}</p>
                                </div>
                                <span class="text-sm font-bold text-gray-900">
                                    Rs {{ number_format($item['price'] * $item['quantity']) }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-4 text-gray-400 text-sm italic">
                                Your cart is empty
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8 pt-6 border-t border-dashed border-gray-200">
                        <div class="flex justify-between text-sm text-gray-500 mb-3">
                            <span>Subtotal</span>
                            <span>Rs {{ number_format($total) }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-500 mb-4">
                            <span>Delivery Fee</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>

                        <div class="flex justify-between items-end mb-8">
                            <span class="font-bold text-gray-800">Grand Total</span>
                            <div class="text-right">
                                <span class="block text-2xl font-black text-gray-900 leading-none">
                                    Rs {{ number_format($total) }}
                                </span>
                            </div>
                        </div>

                        <button type="submit"
                                wire:loading.attr="disabled"
                                class="w-full bg-[#52c234] hover:bg-[#45a82b] disabled:opacity-50 disabled:cursor-not-allowed text-white py-4 rounded-2xl font-bold uppercase text-sm transition-all transform active:scale-[0.98] shadow-lg shadow-green-200 flex justify-center items-center gap-3">

                            {{-- Idle state: shown when NOT loading --}}
                            <div wire:loading.remove wire:target="placeOrder" class="flex items-center gap-2">
                                <i :class="selectedMethod === 'card' ? 'fas fa-lock' : 'fas fa-shopping-bag'"></i>
                                <span x-text="selectedMethod === 'card' ? 'Proceed to Pay' : 'Place Order Now'"></span>
                            </div>

                            {{-- Loading state: shown when Livewire is processing --}}
                            <div wire:loading wire:target="placeOrder" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Processing...</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
    </style>
</div>