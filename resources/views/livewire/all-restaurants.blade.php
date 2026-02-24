<main class="pt-24 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-10 py-10">
        <div class="mb-10 flex justify-between items-end">
            <div>
                <span class="text-[#52c234] font-black uppercase tracking-widest text-xs">Our Eco-Partners</span>
                <h2 class="text-4xl font-black text-gray-900 tracking-tighter mt-2">Verified Restaurants in {{ $selectedCity }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($restaurants as $supplier)
                <div class="group cursor-pointer bg-white rounded-[3rem] p-3 shadow-sm hover:shadow-2xl transition-all border border-gray-100">
                    <div class="relative h-64 rounded-[2.5rem] overflow-hidden mb-5">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent"></div>
                        <div class="absolute bottom-6 left-8 text-white">
                            <h4 class="text-2xl font-black tracking-tight">{{ $supplier->business_name }}</h4>
                            <p class="text-[10px] font-bold uppercase tracking-widest opacity-80 mt-1">
                                <i class="fas fa-map-marker-alt mr-1 text-[#52c234]"></i> {{ $supplier->business_location }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 font-bold">No verified restaurants available in {{ $selectedCity }} yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</main>