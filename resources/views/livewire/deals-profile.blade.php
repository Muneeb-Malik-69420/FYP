{{-- deals-profile.blade.php --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
    
    @forelse($foodItems as $item)
        <div class="bg-white rounded-2xl border border-gray-100 p-4 flex justify-between hover:shadow-md transition-shadow cursor-pointer h-[160px]">
            <div class="flex flex-col justify-between py-1 pr-2">
                <div>
                    <h3 class="font-bold text-[#1a1a1a] text-[15px] leading-tight mb-1">
                        {{ $item->item_name }}
                    </h3>
                    <p class="text-[12px] text-gray-500 line-clamp-2 leading-snug">
                        {{ $item->description }}
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[14px] font-bold text-gray-900">
                        Rs. {{ number_format($item->discounted_price) }}
                    </span>
                    @if($item->original_price > $item->discounted_price)
                        <span class="text-[11px] text-gray-400 line-through">
                            Rs. {{ number_format($item->original_price) }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="relative flex-shrink-0 w-28 h-28 self-center">
                {{-- Dynamic Image Logic --}}
                <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://via.placeholder.com/200?text=No+Image' }}" 
                     alt="{{ $item->item_name }}"
                     class="w-full h-full object-cover rounded-xl bg-gray-50">
                
                {{-- Add Button with data attributes for JavaScript --}}
                <button 
                    onclick="addToBasket({{ $item->id }})"
                    class="absolute -bottom-2 -right-2 bg-white w-8 h-8 rounded-full shadow-md border border-gray-100 flex items-center justify-center text-pink-600 hover:scale-110 transition-transform active:bg-pink-50"
                    title="Add to basket"
                >
                    <i class="fas fa-plus text-xs"></i>
                </button>
            </div>
        </div>
    @empty
        {{-- Show this if no items are found in the database --}}
        <div class="col-span-full py-10 text-center text-gray-400">
            <p>No food items available at the moment.</p>
        </div>
    @endforelse

</div>