<form wire:submit.prevent="submit" class="space-y-5 text-left">
    {{-- Item Name --}}
    <div>
        <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Food Item Name</label>
        <input wire:model="item_name" type="text" placeholder="e.g. Fresh Glazed Donuts" 
            class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:ring-gray-900 focus:border-gray-900 font-bold placeholder:text-gray-300">
        @error('item_name') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
    </div>

    {{-- Pricing Row --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Original Price</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-bold">Rs.</span>
                <input wire:model="original_price" type="number" class="w-full pl-10 rounded-2xl border-gray-100 bg-gray-50 font-bold">
            </div>
            @error('original_price') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Discounted Price</label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-emerald-600 text-xs font-bold">Rs.</span>
                <input wire:model="discounted_price" type="number" class="w-full pl-10 rounded-2xl border-gray-100 bg-gray-50 font-bold text-emerald-600">
            </div>
            @error('discounted_price') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Quantity & Expiry --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Quantity</label>
            <input wire:model="quantity" type="number" placeholder="1" class="w-full rounded-2xl border-gray-100 bg-gray-50 font-bold">
            @error('quantity') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-[10px] font-black uppercase text-gray-400 mb-1 tracking-widest">Expiry Date</label>
            <input wire:model="expiry_date" type="datetime-local" 
                class="w-full rounded-2xl border-gray-100 bg-gray-50 font-bold">
            @error('expiry_date') <span class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Submit Button --}}
    <div class="pt-2">
        <button type="submit" wire:loading.attr="disabled" 
            class="w-full py-4 bg-gray-900 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-gray-800 transition-all shadow-lg shadow-gray-200 flex items-center justify-center gap-2">
            <span wire:loading.remove>Confirm & Post</span>
            <span wire:loading class="flex items-center gap-2">
                <svg class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Processing...
            </span>
        </button>
    </div>
</form>