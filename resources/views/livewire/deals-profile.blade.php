{{-- deals-profile.blade.php --}}
<div>
    {{-- Group items by category from the database to create navigation targets --}}
    @forelse($foodItems->groupBy('category') as $categoryName => $items)
        
        {{-- Section ID matches the slug in your Nav. scroll-mt-32 prevents the sticky header from covering the title. --}}
        <div id="{{ Str::slug($categoryName) }}" class="pt-3 mb-3 scroll-mt-32">
            
            {{-- Category Header with Brand Accent [#52c234] --}}
            <h2 class="text-[11px] font-black uppercase tracking-[0.4em] text-[#111827] mb-8 flex items-center gap-4">
                <span class="w-12 h-0.5 bg-[#52c234]"></span> {{ $categoryName }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
                @foreach($items as $item)
                    @php
                        // 1. Calculate discount percentage safely
                        $percentage = 0;
                        if($item->original_price > 0 && $item->discounted_price < $item->original_price) {
                            $percentage = round((($item->original_price - $item->discounted_price) / $item->original_price) * 100);
                        }

                        // 2. Define Category Fallbacks for missing images
                        $fallbacks = [
                            'Pizza'       => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=200&auto=format&fit=crop',
                            'Burger'      => 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?q=80&w=200&auto=format&fit=crop',
                            'Pasta'       => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?q=80&w=200&auto=format&fit=crop',
                            'Fast Food'   => 'https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=200&auto=format&fit=crop',
                            'Deals'       => 'https://images.unsplash.com/photo-1543353071-873f17a7a088?q=80&w=200&auto=format&fit=crop',
                        ];

                        // 3. Select final image source
                        $imageSrc = $item->image_path 
                            ? asset('storage/' . $item->image_path) 
                            : ($fallbacks[$item->category] ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=200&auto=format&fit=crop');
                    @endphp

                    <div class="bg-white rounded-2xl border border-gray-100 p-4 flex justify-between hover:shadow-md transition-shadow cursor-pointer h-[180px]">
                        <div class="flex flex-col justify-between py-1 pr-2">
                            <div>
                                {{-- Brand Green Badge [#52c234] --}}
                                @if($percentage > 0)
                                    <span class="bg-[#52c234]/10 text-[#52c234] text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded mb-2 inline-block border border-[#52c234]/20">
                                        {{ $percentage }}% OFF
                                    </span>
                                @endif

                                {{-- Title: #111827 | Weight: 700 --}}
                                <h3 class="text-[#111827] font-[700] text-[16px] leading-tight mb-1">
                                    {{ $item->item_name }}
                                </h3>
                                
                                {{-- Description: #4B5563 | Weight: 400 --}}
                                <p class="text-[#4B5563] font-[400] text-[12px] line-clamp-2 leading-snug italic">
                                    {{ $item->description }}
                                </p>
                            </div>

                            <div class="space-y-1">
                                {{-- Quantity: #2E7D32 | Weight: 600 --}}
                                <p class="text-[11px] font-[600] uppercase tracking-tight {{ $item->quantity < 5 ? 'text-red-600' : 'text-[#2E7D32]' }}">
                                    <i class="fas fa-layer-group mr-1"></i> {{ $item->quantity }} left
                                </p>
                                
                                <div class="flex items-center gap-2">
                                    {{-- Discounted Price: #111111 | Weight: 800 --}}
                                    <span class="text-[18px] font-[800] text-[#111111] tracking-tighter">
                                        Rs. {{ number_format($item->discounted_price) }}
                                    </span>
                                    
                                    {{-- Old Price: #9CA3AF | Weight: 500 --}}
                                    @if($item->original_price > $item->discounted_price)
                                        <span class="text-[11px] text-[#9CA3AF] font-[500] line-through">
                                            Rs. {{ number_format($item->original_price) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="relative flex-shrink-0 w-28 h-28 self-center">
                            <img src="{{ $imageSrc }}" 
                                 alt="{{ $item->item_name }}"
                                 class="w-full h-full object-cover rounded-xl bg-gray-50 border border-gray-100 shadow-sm">
                            
                            {{-- Add Button: Brand Green #52c234 --}}
                            <button 
                                onclick="addToBasket({{ $item->id }})"
                                class="absolute -bottom-2 -right-2 bg-white w-9 h-9 rounded-full shadow-lg border-2  flex items-center justify-center text-white hover:scale-110 transition-all active:scale-95"
                            >
                                <i class=" text-[#52c234] fas fa-plus text-xs"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="col-span-full py-16 text-center">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300">No Fresh Deals Available</p>
        </div>
    @endforelse
</div>