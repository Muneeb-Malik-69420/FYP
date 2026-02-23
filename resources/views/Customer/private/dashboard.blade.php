@extends('layout.customer')

@section('content')
<main class="pt-24 bg-gray-50 min-h-screen">
    
    <section class="py-10 px-10">
        <div class="container mx-auto">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <span class="text-[#52c234] font-black uppercase tracking-[0.2em] text-[10px]">Limited Availability</span>
                    <h2 class="text-4xl font-black text-gray-900 tracking-tighter mt-1">Rescue these bites <br> before they're gone</h2>
                </div>
                <a href="#" class="group text-sm font-bold text-gray-400 hover:text-[#52c234] transition-colors">
                    View all deals <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach([1, 2, 3, 4] as $item)
                <div class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 group relative overflow-hidden transition-all hover:shadow-xl hover:-translate-y-1">
                    <div class="absolute top-6 left-6 z-20 bg-red-500 text-white font-black text-xs px-4 py-1.5 rounded-full shadow-lg">
                        -60% OFF
                    </div>
                    
                    <div class="relative h-48 w-full rounded-[2rem] overflow-hidden mb-4">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute bottom-3 left-3 bg-black/60 backdrop-blur-md text-white text-[10px] font-black px-3 py-1 rounded-full uppercase">
                            <i class="far fa-clock mr-1 text-orange-400"></i> Expiring in 45m
                        </div>
                    </div>

                    <div class="px-2">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-black text-gray-800 leading-tight">Fresh Harvest Salad</h3>
                            <span class="text-gray-400 line-through text-xs mt-1">Rs. 850</span>
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[#0f711c] font-black text-xl">Rs. 340</span>
                            <span class="text-[10px] bg-green-50 text-[#0f711c] font-bold px-2 py-0.5 rounded uppercase">Save 2kg CO2</span>
                        </div>
                        
                        <div class="mt-4 flex items-center justify-between border-t border-gray-50 pt-4">
                            <div class="flex items-center gap-2">
                                <img src="https://ui-avatars.com/api/?name=Green+Kitchen&background=0f711c&color=fff" class="w-6 h-6 rounded-lg">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Green Kitchen</span>
                            </div>
                            <button class="bg-[#52c234] text-white px-5 py-2 rounded-xl text-xs font-black shadow-md shadow-green-100 hover:bg-[#0f711c] transition-all active:scale-95">
                                Grab It
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 px-10 bg-white rounded-t-[4rem] shadow-[0_-20px_50px_-20px_rgba(0,0,0,0.05)]">
        <div class="container mx-auto">
            <div class="flex items-center justify-between mb-10">
                <h3 class="text-3xl font-black text-gray-900 tracking-tighter">Explore All Restaurants</h3>
                <div class="flex gap-3">
                    <span class="px-4 py-2 bg-gray-100 rounded-full text-xs font-bold text-gray-600">45 Stores Nearby</span>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach([1, 2, 3] as $restaurant)
                <div class="group cursor-pointer">
                    <div class="relative h-64 rounded-[3rem] overflow-hidden mb-5 shadow-sm group-hover:shadow-2xl transition-all duration-500">
                        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=800" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-8 text-white">
                            <h4 class="text-2xl font-black tracking-tight">Artisanal Bakery</h4>
                            <p class="text-xs font-bold uppercase tracking-widest opacity-80 mt-1">Bakery • Breakfast • Eco-Certified</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-4">
                        <div class="flex items-center gap-6 text-sm font-bold text-gray-400">
                            <span class="flex items-center gap-1.5"><i class="fas fa-star text-yellow-400"></i> 4.9</span>
                            <span>25-35 min</span>
                            <span class="text-[#52c234]">Free Delivery</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
