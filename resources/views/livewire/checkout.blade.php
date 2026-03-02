<div
    wire:key="guest-checkout-page"
    x-data="{
        selectedMethod: @entangle('paymentMethod').live,
        loadingLocation: false,

        async locateMe() {
            if (!navigator.geolocation) return alert('Geolocation not supported');

            this.loadingLocation = true;

            navigator.geolocation.getCurrentPosition(async (pos) => {
                try {
                    const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${pos.coords.latitude}&lon=${pos.coords.longitude}`);
                    const data = await res.json();

                    const addr = data.address;
                    const street = addr.road || '';
                    const house = addr.house_number || '';
                    const area = addr.suburb || addr.neighbourhood || '';
                    const city = addr.city || addr.town || '';

                    const fullAddress = `${house} ${street}, ${area}, ${city}`.replace(/^ , /, '').trim();
                    @this.set('address', fullAddress);

                } catch (e) {
                    alert('Could not detect address.');
                } finally {
                    this.loadingLocation = false;
                }
            }, () => {
                this.loadingLocation = false;
                alert('Location access denied.');
            });
        }
    }"
    class="h-screen bg-[#F9FAFB] flex flex-col overflow-hidden"
>

    <div class="max-w-7xl mx-auto w-full flex-grow flex flex-col overflow-hidden">

        <div class="flex-grow grid lg:grid-cols-12 overflow-hidden">

            {{-- LEFT SIDE --}}
            <div class="lg:col-span-8 h-full overflow-y-auto px-10 py-10">

                <div class="mb-8">
                    <h2 class="text-3xl font-semibold text-gray-900">
                        Confirm Delivery & 
                        <span class="text-[#52c234]">Payment</span>
                    </h2>
                </div>

                <div class="space-y-8 pb-24">

                    {{-- DELIVERY CARD --}}
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">

                        <h3 class="text-sm font-semibold mb-6 text-gray-800">
                            Delivery Details
                        </h3>

                        <div class="space-y-6">

                            {{-- Name --}}
                            <div>
                                <label class="text-xs uppercase text-gray-500">Full Name</label>
                                <input type="text"
                                       wire:model.blur="name"
                                       class="w-full mt-2 bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm focus:ring-2 focus:ring-[#52c234] outline-none">
                            </div>

                            {{-- Address --}}
                            <div>
                                <label class="text-xs uppercase text-gray-500">Street Address</label>
                                <div class="relative mt-2">
                                    <input type="text"
                                           wire:model.live="address"
                                           placeholder="House / Street / Area"
                                           class="w-full bg-gray-50 border @error('address') border-red-500 @else border-gray-200 @enderror rounded-xl p-4 pr-12 text-sm focus:ring-2 focus:ring-[#52c234] outline-none">

                                    <button type="button"
                                            @click="locateMe()"
                                            class="absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 flex items-center justify-center rounded-lg text-gray-400 hover:text-[#52c234]">
                                        <i class="fas fa-location-arrow"
                                           :class="loadingLocation ? 'animate-spin text-[#52c234]' : ''"></i>
                                    </button>
                                </div>
                                @error('address')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label class="text-xs uppercase text-gray-500">Phone Number</label>
                                <input type="text"
                                       wire:model.blur="phone"
                                       placeholder="03XXXXXXXXX"
                                       class="w-full mt-2 bg-gray-50 border @error('phone') border-red-500 @else border-gray-200 @enderror rounded-xl p-4 text-sm focus:ring-2 focus:ring-[#52c234] outline-none">
                                @error('phone')
                                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- PAYMENT CARD --}}
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">

                        <h3 class="text-sm font-semibold mb-6 text-gray-800">
                            Payment Method
                        </h3>

                        @foreach ([
                            'cod' => 'Cash on Delivery',
                            'card' => 'Credit / Debit Card',
                            'jazzcash' => 'JazzCash',
                            'easypaisa' => 'EasyPaisa'
                        ] as $value => $label)

                            <div @click="selectedMethod = '{{ $value }}'"
                                 class="flex items-center justify-between p-4 mb-4 border-2 rounded-2xl cursor-pointer transition"
                                 :class="selectedMethod === '{{ $value }}'
                                    ? 'border-[#52c234] bg-green-50'
                                    : 'border-gray-200 hover:border-gray-300'">

                                <span class="text-sm font-medium text-gray-800">
                                    {{ $label }}
                                </span>

                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center"
                                     :class="selectedMethod === '{{ $value }}'
                                        ? 'border-[#52c234] bg-[#52c234]'
                                        : 'border-gray-300'">
                                    <i x-show="selectedMethod === '{{ $value }}'"
                                       class="fas fa-check text-xs text-white"></i>
                                </div>
                            </div>

                        @endforeach

                        {{-- Card Fields --}}
                        <div x-show="selectedMethod === 'card'" x-transition class="mt-6 space-y-4">
                            <input type="text" placeholder="Card Number"
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" placeholder="MM/YY"
                                       class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm">
                                <input type="text" placeholder="CVC"
                                       class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm">
                            </div>
                        </div>

                        {{-- JazzCash / EasyPaisa --}}
                        <div x-show="selectedMethod === 'jazzcash' || selectedMethod === 'easypaisa'"
                             x-transition
                             class="mt-6">
                            <input type="text"
                                   placeholder="Mobile Wallet Number"
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm">
                        </div>

                    </div>

                </div>
            </div>

            {{-- RIGHT SIDE SUMMARY --}}
            <div class="lg:col-span-4 bg-[#F0FDF4] border-l border-green-100 p-8 flex flex-col">

                <div class="bg-white rounded-3xl p-8 flex flex-col shadow-md border border-green-100 h-full">

                    <h3 class="text-xs font-semibold uppercase text-green-600 mb-6">
                        Order Summary
                    </h3>

                    <div class="space-y-4 flex-grow">
                        @foreach ($cart as $item)
                            <div class="flex justify-between">
                                <span class="text-sm">
                                    {{ $item['quantity'] }}x {{ $item['name'] }}
                                </span>
                                <span class="text-sm font-semibold">
                                    Rs. {{ number_format($item['price'] * $item['quantity']) }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 pt-6 border-t border-green-100">

                        <div class="flex justify-between text-sm text-gray-500 mb-3">
                            <span>Subtotal</span>
                            <span>Rs. {{ number_format($total) }}</span>
                        </div>

                        <div class="flex justify-between mb-6">
                            <span class="font-semibold">Total</span>
                            <span class="text-2xl font-bold text-[#52c234]">
                                Rs. {{ number_format($total) }}
                            </span>
                        </div>

                        <button wire:click="placeOrder"
                                wire:loading.attr="disabled"
                                class="w-full bg-[#52c234] hover:bg-[#3fa71c] text-white py-4 rounded-2xl font-semibold uppercase text-sm transition active:scale-95 flex justify-center items-center gap-2">

                            <span wire:loading.remove wire:target="placeOrder">
                                Place Order
                            </span>

                            <span wire:loading wire:target="placeOrder">
                                <i class="fas fa-spinner animate-spin"></i>
                                Processing
                            </span>

                        </button>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>