<main class="pt-10 bg-gray-50 min-h-screen">
    <section class="py-10 px-10">
        <div class="container mx-auto">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <span class="text-[#52c234] font-black uppercase tracking-[0.2em] text-[10px]">Limited Availability in {{ $selectedCity }}</span>
                    <h2 class="text-4xl font-black text-gray-900 tracking-tighter mt-1">Rescue these bites <br> before they're gone</h2>
                </div>
                <a href="{{ route('deals.index') }}" class="group text-sm font-bold text-gray-400 hover:text-[#52c234] transition-colors">
                    View all deals <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($surplusItems as $item)
                    <div class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 group relative overflow-hidden transition-all hover:shadow-xl hover:-translate-y-1">
                        <div class="px-2">
                             <h3 class="text-lg font-black text-gray-800 leading-tight truncate mr-2">{{ $item->item_name }}</h3>
                             <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider truncate max-w-[100px]">{{ $item->supplier->business_name }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-[2rem] border border-dashed border-gray-200">
                        <p class="text-gray-400 font-bold">No surplus deals in {{ $selectedCity }} right now. Check back later!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-16 px-10 bg-white rounded-t-[4rem] shadow-[0_-20px_50px_-20px_rgba(0,0,0,0.05)]">
        <div class="container mx-auto">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Explore All Restaurants</h3>
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mt-1">Verified Eco-Partners in {{ $selectedCity }}</p>
                </div>
                <a href="{{ route('restaurants.index') }}" class="group text-sm font-bold text-gray-400 hover:text-[#52c234] transition-colors">
                    View all restaurants <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($suppliers as $supplier)
                    <div class="group cursor-pointer">
                        <h4 class="text-2xl font-black tracking-tight">{{ $supplier->business_name }}</h4>
                        <p class="text-xs font-bold uppercase tracking-widest opacity-80 mt-1">
                            <i class="fas fa-map-marker-alt mr-1 text-[#52c234]"></i> {{ $supplier->business_location }}
                        </p>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <i class="fas fa-store-slash text-4xl text-gray-200 mb-4"></i>
                        <p class="text-gray-400 font-bold">We couldn't find any verified restaurants in {{ $selectedCity }}.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</main>