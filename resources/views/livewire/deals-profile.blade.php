{{-- deals-profile.blade.php --}}
<div>
    {{-- 1. Dynamic Category Header --}}
    <div class="mb-8">
        <h2 class="text-[11px] font-black uppercase tracking-[0.4em] text-[#111827] flex items-center gap-4">
            <span class="w-12 h-0.5 bg-[#52c234]"></span> 
            {{ $activeCategory }}
        </h2>
    </div>

    {{-- 2. Loading Skeleton --}}
    <div wire:loading class="w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6 animate-pulse">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-gray-100 rounded-2xl h-[180px] w-full border border-gray-200"></div>
            @endfor
        </div>
    </div>

    {{-- 3. The Main Grid --}}
    <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-6">
        @forelse($foodItems as $item)
            @php
                $percentage = ($item->original_price > 0 && $item->discounted_price < $item->original_price) 
                    ? round((($item->original_price - $item->discounted_price) / $item->original_price) * 100) 
                    : 0;

                $imageSrc = $item->image_path 
                    ? asset('storage/' . $item->image_path) 
                    : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=200&auto=format&fit=crop';
            @endphp

            {{-- 💎 CARD: Added '-translate-y' and 'shadow' transitions --}}
            <div class="group bg-white rounded-2xl border border-gray-100 p-4 flex justify-between cursor-pointer h-[180px] 
                        transition-all duration-300 ease-out hover:shadow-xl hover:-translate-y-1.5 active:scale-[0.98]">
                
                <div class="flex flex-col justify-between py-1 pr-2">
                    <div>
                        @if($percentage > 0)
                            <span class="bg-[#52c234]/10 text-[#52c234] text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded mb-2 inline-block border border-[#52c234]/20">
                                {{ $percentage }}% OFF
                            </span>
                        @endif

                        <h3 class="text-[#111827] font-[700] text-[16px] leading-tight mb-1 group-hover:text-[#52c234] transition-colors">
                            {{ $item->item_name }}
                        </h3>
                        
                        <p class="text-[#4B5563] font-[400] text-[12px] line-clamp-2 leading-snug italic">
                            {{ $item->description }}
                        </p>
                    </div>

                    <div class="space-y-1">
                        <p class="text-[11px] font-[600] uppercase tracking-tight {{ $item->quantity < 5 ? 'text-red-600' : 'text-[#2E7D32]' }}">
                            <i class="fas fa-layer-group mr-1"></i> {{ $item->quantity }} left
                        </p>
                        
                        <div class="flex items-center gap-2">
                            <span class="text-[18px] font-[800] text-[#111111] tracking-tighter">
                                Rs. {{ number_format($item->discounted_price) }}
                            </span>
                            
                            @if($item->original_price > $item->discounted_price)
                                <span class="text-[11px] text-[#9CA3AF] font-[500] line-through">
                                    Rs. {{ number_format($item->original_price) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- 💎 IMAGE: Added overflow-hidden and zoom effect --}}
                <div class="relative flex-shrink-0 w-28 h-28 self-center overflow-hidden rounded-xl bg-gray-50 border border-gray-100 shadow-sm">
                    <img src="{{ $imageSrc }}" alt="{{ $item->item_name }}"
                         class="w-full h-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110">
                    
                    {{-- 💎 PLUS BUTTON: Minimalist white/green --}}
                    <button onclick="addToBasket({{ $item->id }})"
                        class="absolute bottom-1 right-1 bg-white w-8 h-8 rounded-full shadow-lg flex items-center justify-center text-[#52c234] hover:bg-[#52c234] hover:text-white transition-all active:scale-95 z-10">
                        <i class="fas fa-plus text-[10px]"></i>
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full py-24 text-center">
                <div class="mb-4 opacity-20">
                    <i class="fas fa-search text-5xl text-gray-400"></i>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-300">No matching deals found</p>
            </div>
        @endforelse
    </div>
</div>