<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <h2 class="text-2xl font-extrabold text-gray-900">Setup Your Shop</h2>
        <p class="text-gray-500 mt-1">Fill in these details to unlock your Ecobite Dashboard.</p>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <label class="block text-sm font-semibold text-gray-700">Business Name</label>
            <input type="text" wire:model="business_name" placeholder="e.g. Rahat Bakery" 
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 transition">
            @error('business_name') <span class="text-red-500 text-xs mt-1 italic">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Business Type</label>
            <select wire:model="business_type" 
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 transition">
                <option value="">Choose a category...</option>
                <option value="Bakery">Bakery</option>
                <option value="Restaurant">Restaurant / Cafe</option>
                <option value="Grocery">Grocery Store</option>
                <option value="HomeChef">Home Chef</option>
            </select>
            @error('business_type') <span class="text-red-500 text-xs mt-1 italic">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700">Contact Number</label>
                <input type="text" wire:model="contact_phone" placeholder="03XXXXXXXXX" 
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                @error('contact_phone') <span class="text-red-500 text-xs mt-1 italic">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700">Full Address</label>
                <input type="text" wire:model="address" placeholder="Street, Area, City" 
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                @error('address') <span class="text-red-500 text-xs mt-1 italic">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="p-4 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200 text-center">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Proof of Business (License/CNIC)</label>
            <input type="file" wire:model="license_proof" class="hidden" id="fileUpload">
            <label for="fileUpload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                Select Image
            </label>
            
            <div wire:loading wire:target="license_proof" class="text-xs text-green-600 mt-2">Uploading photo...</div>
            @if ($license_proof)
                <div class="mt-2 text-xs text-green-600 font-bold">✓ Photo Selected</div>
            @endif
            @error('license_proof') <span class="text-red-500 text-xs mt-1 italic block">{{ $message }}</span> @enderror
        </div>

        <button type="submit" 
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all transform active:scale-95">
            Submit Profile for Approval
        </button>
    </form>
</div>
</div>
