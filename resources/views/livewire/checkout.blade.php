<div class="max-w-3xl mx-auto py-20 px-6">
    <div class="mb-12">
        <h1 class="text-4xl font-black uppercase tracking-tighter italic text-gray-900">Finalize Order</h1>
        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mt-2">EcoBite Secure Checkout</p>
    </div>
    
    <div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-2xl mb-8">
        <div class="space-y-6">
            @foreach($cart as $item)
                <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                    <div>
                        <span class="text-[11px] font-black text-gray-900 uppercase tracking-widest">{{ $item['name'] }}</span>
                        <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $item['quantity'] }} x Rs. {{ number_format($item['price']) }}</p>
                    </div>
                    <span class="text-[13px] font-black text-gray-900">Rs. {{ number_format($item['price'] * $item['quantity']) }}</span>
                </div>
            @endforeach
        </div>

        <div class="mt-12 pt-8 border-t-2 border-dashed border-gray-50 flex justify-between items-end">
            <div>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Grand Total</span>
                <p class="text-3xl font-black text-[#0F7A4F] tracking-tighter mt-1">Rs. {{ number_format($total) }}</p>
            </div>
            <button class="bg-black text-white px-10 py-4 text-[10px] font-black uppercase tracking-[0.2em] rounded-xl hover:bg-[#52c234] transition-all shadow-lg">
                Pay & Place Order
            </button>
        </div>
    </div>

    <a href="/explore" class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-black transition-colors flex items-center gap-2">
        <i class="fas fa-arrow-left"></i> Back to Menu
    </a>
</div>