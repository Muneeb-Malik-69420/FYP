<main class="pt-10 bg-gray-50 min-h-screen">
    {{-- Deals Section (Kept as is for now) --}}
    <section class="py-10 px-10">
        <div class="container mx-auto">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <span class="text-[#52c234] font-black uppercase tracking-[0.2em] text-[10px]">
                        Limited Availability in {{ $selectedCity }}
                    </span>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tighter mt-1">
                        Rescue these bites
                    </h2>
                </div>
                <a href="#" class="group text-sm font-bold text-gray-400 hover:text-[#52c234] transition-colors">
                    View all <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse($surplusItems as $item)
                    <div class="bg-white rounded-[2rem] p-4 shadow-sm border border-gray-100 group relative transition-all hover:shadow-md">
                         <h3 class="text-base font-black text-gray-800 truncate">{{ $item->item_name }}</h3>
                         <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest block">{{ $item->supplier->business_name }}</span>
                         <button class="w-full mt-3 bg-gray-900 text-white text-[10px] font-black uppercase py-2 rounded-xl group-hover:bg-[#52c234] transition-colors">
                            Rescue
                         </button>
                    </div>
                @empty
                    {{-- Empty state --}}
                @endforelse
            </div>
        </div>
    </section>

    {{-- Restaurants Section (Compact & Linked) --}}
    <section class="py-12 px-10 bg-white rounded-t-[3rem] shadow-[0_-15px_40px_-20px_rgba(0,0,0,0.05)]">
        <div class="container mx-auto">
            <div class="mb-10">
                <h3 class="text-2xl font-black text-gray-900 tracking-tighter">Explore Restaurants</h3>
                <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mt-1">Verified Partners in {{ $selectedCity }}</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($suppliers as $supplier)
                    {{-- THE LINK: Wraps the entire card --}}
                    <a href="#" class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 flex flex-col h-full relative">
                        
                        {{-- Smaller Image Header --}}
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ $supplier->getThumbnail() }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" 
                                 alt="{{ $supplier->business_name }}">
                            
                            {{-- Favorite Button (Stopped propagation so it doesn't trigger the link) --}}
                            <div x-data="{ fav: false }" class="absolute top-4 right-4 z-20">
                                <button @click.prevent="fav = !fav" 
                                        class="w-9 h-9 rounded-full backdrop-blur-md flex items-center justify-center transition-all shadow-sm"
                                        :class="fav ? 'bg-red-500 text-white' : 'bg-white/90 text-gray-400'">
                                    <i class="fas fa-heart text-xs" :class="fav ? 'fa-solid' : 'fa-regular'"></i>
                                </button>
                            </div>

                            <div class="absolute bottom-4 left-4">
                                <span class="bg-[#52c234] text-white text-[8px] font-black px-3 py-1 rounded-lg uppercase tracking-widest">
                                    {{ $supplier->business_type ?? 'Partner' }}
                                </span>
                            </div>
                        </div>

                        {{-- Compact Content --}}
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex justify-between items-start">
                                <h4 class="text-xl font-black text-gray-900 leading-tight group-hover:text-[#52c234] transition-colors">
                                    {{ $supplier->business_name }}
                                </h4>
                                
                                <div class="flex items-center gap-1 bg-orange-50 px-2 py-1 rounded-lg">
                                    <i class="fas fa-star text-orange-400 text-[8px]"></i>
                                    <span class="text-orange-700 font-black text-[10px]">4.9</span>
                                </div>
                            </div>

                            <div class="flex items-center mt-3 text-gray-400">
                                <i class="fas fa-map-marker-alt text-[9px] mr-2 text-[#52c234]"></i>
                                <p class="text-[10px] font-bold uppercase tracking-wider truncate">
                                    {{ $supplier->business_location }}
                                </p>
                            </div>

                            {{-- Removed the big footer section --}}
                            <div class="flex gap-2 mt-4">
                                <div class="bg-blue-50 text-blue-600 px-2 py-1 rounded-lg text-[8px] font-black uppercase tracking-wider">
                                    Free Delivery
                                </div>
                                <div class="bg-green-50 text-green-600 px-2 py-1 rounded-lg text-[8px] font-black uppercase tracking-wider">
                                    Eco-Pack
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-10 text-center text-gray-400 font-bold text-sm italic">
                        No restaurants found in {{ $selectedCity }}.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</main>