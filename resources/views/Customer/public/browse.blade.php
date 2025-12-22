@extends('layout.app')

@section('title', 'Browse Surplus Food | EcoBite')

@section('content')
<div class="min-h-screen bg-gray-50 pb-20">
    
    <div class="bg-forest-dark text-white pt-10 pb-16 px-6 relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Rescue Good Food</h1>
            <p class="text-forest-light font-medium text-lg opacity-90">Eat well, save money, and help the planet.</p>
            
            <div class="mt-8 bg-white rounded-full p-2 flex items-center shadow-lg max-w-2xl">
                <div class="pl-4 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
                <input type="text" placeholder="Search for bakeries, biryani, or dessert..." 
                    class="w-full p-3 rounded-full outline-none text-gray-700 placeholder-gray-400 font-medium">
                <button class="bg-forest-dark text-white rounded-full px-8 py-3 font-bold uppercase text-xs tracking-wider hover:bg-opacity-90 transition shadow-md">
                    Find Food
                </button>
            </div>
        </div>
        
        <i class="fas fa-leaf absolute -right-10 -bottom-20 text-white opacity-5 text-[200px]"></i>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-8 relative z-20">
        
        <div class="flex flex-wrap gap-3 mb-8 overflow-x-auto pb-2 no-scrollbar">
            <button class="bg-white border border-gray-200 text-forest-dark font-bold px-5 py-2 rounded-full shadow-sm hover:shadow-md transition active:scale-95 whitespace-nowrap">
                <i class="fas fa-sliders-h mr-2"></i> All Filters
            </button>
            <button class="bg-forest-dark text-white border border-forest-dark px-5 py-2 rounded-full shadow-md transition whitespace-nowrap">
                All Items
            </button>
            <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full shadow-sm hover:text-forest-dark hover:border-forest-dark transition whitespace-nowrap">
                <i class="fas fa-bread-slice mr-1"></i> Bakeries
            </button>
            <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full shadow-sm hover:text-forest-dark hover:border-forest-dark transition whitespace-nowrap">
                <i class="fas fa-utensils mr-1"></i> Meals
            </button>
            <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full shadow-sm hover:text-forest-dark hover:border-forest-dark transition whitespace-nowrap">
                <i class="fas fa-seedling mr-1"></i> Vegetarian
            </button>
            <button class="bg-white border border-gray-200 text-gray-600 px-5 py-2 rounded-full shadow-sm hover:text-forest-dark hover:border-forest-dark transition whitespace-nowrap">
                <i class="fas fa-clock mr-1"></i> Ending Soon
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden border border-gray-100 flex flex-col">
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1509365465985-25d11c17e812?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Croissants" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-md">
                        -50% OFF
                    </div>
                    <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded flex items-center shadow-sm">
                        <i class="fas fa-store text-forest-dark mr-1"></i> Bread & Beyond
                    </div>
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-gray-800 leading-tight">Assorted Pastry Box</h3>
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-gray-400 line-through">Rs. 800</span>
                            <span class="text-forest-dark font-extrabold text-lg">Rs. 400</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-500 text-xs mb-4 line-clamp-2">A surprise mix of today's fresh croissants, donuts, and danish pastries.</p>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between text-xs font-bold text-gray-500 mb-1">
                            <span><i class="fas fa-box-open mr-1"></i> 3 Left</span>
                            <span class="text-red-500"><i class="far fa-clock mr-1"></i> Ends in 2h</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2 mb-4">
                            <div class="bg-gradient-to-r from-forest-dark to-forest-light h-2 rounded-full" style="width: 70%"></div>
                        </div>
                        
                        <button class="w-full border border-forest-dark text-forest-dark hover:bg-forest-dark hover:text-white font-bold py-2 rounded-full text-sm transition-colors uppercase tracking-wide">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden border border-gray-100 flex flex-col">
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1589302168068-964664d93dc0?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Biryani" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded shadow-md">
                        -40% OFF
                    </div>
                    <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded flex items-center shadow-sm">
                        <i class="fas fa-store text-forest-dark mr-1"></i> Karachi Spice
                    </div>
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-gray-800 leading-tight">Chicken Biryani Bucket</h3>
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-gray-400 line-through">Rs. 1200</span>
                            <span class="text-forest-dark font-extrabold text-lg">Rs. 720</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-500 text-xs mb-4 line-clamp-2">Freshly cooked Family bucket leftover from dinner service. Perfectly spicy.</p>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between text-xs font-bold text-gray-500 mb-1">
                            <span><i class="fas fa-box-open mr-1"></i> 1 Left</span>
                            <span class="text-red-500"><i class="far fa-clock mr-1"></i> Ends in 45m</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2 mb-4">
                            <div class="bg-red-400 h-2 rounded-full" style="width: 90%"></div>
                        </div>
                        
                        <button class="w-full border border-forest-dark text-forest-dark hover:bg-forest-dark hover:text-white font-bold py-2 rounded-full text-sm transition-colors uppercase tracking-wide">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden border border-gray-100 flex flex-col">
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Cake" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-3 left-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded shadow-md">
                        <i class="fas fa-leaf mr-1"></i> VEG
                    </div>
                    <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded flex items-center shadow-sm">
                        <i class="fas fa-store text-forest-dark mr-1"></i> Sweet Tooth
                    </div>
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-gray-800 leading-tight">Chocolate Lava Cake</h3>
                        <div class="flex flex-col items-end">
                            <span class="text-xs text-gray-400 line-through">Rs. 450</span>
                            <span class="text-forest-dark font-extrabold text-lg">Rs. 300</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-500 text-xs mb-4 line-clamp-2">Premium belgian chocolate cake. Best consumed warm.</p>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between text-xs font-bold text-gray-500 mb-1">
                            <span><i class="fas fa-box-open mr-1"></i> 5 Left</span>
                            <span class="text-red-500"><i class="far fa-clock mr-1"></i> Ends in 3h</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2 mb-4">
                            <div class="bg-green-400 h-2 rounded-full" style="width: 40%"></div>
                        </div>
                        
                        <button class="w-full border border-forest-dark text-forest-dark hover:bg-forest-dark hover:text-white font-bold py-2 rounded-full text-sm transition-colors uppercase tracking-wide">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl border border-gray-200 flex flex-col opacity-75 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="Pizza" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                        <span class="bg-gray-800 text-white font-bold px-4 py-2 rounded-full uppercase tracking-wider text-sm">
                            Sold Out
                        </span>
                    </div>
                    <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-2 py-1 rounded flex items-center shadow-sm">
                        <i class="fas fa-store text-forest-dark mr-1"></i> Pizza Point
                    </div>
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-gray-600 leading-tight">Large Pepparoni</h3>
                        <div class="flex flex-col items-end">
                             <span class="text-forest-dark font-extrabold text-lg">Rs. 900</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-xs mb-4">You missed this one! Check back tomorrow.</p>
                    
                    <div class="mt-auto">
                         <button disabled class="w-full bg-gray-200 text-gray-400 font-bold py-2 rounded-full text-sm uppercase tracking-wide cursor-not-allowed">
                            Saved by someone else
                        </button>
                    </div>
                </div>
            </div>

        </div> 
        <div class="mt-12 flex justify-center">
            <button class="text-gray-500 font-semibold hover:text-forest-dark transition flex flex-col items-center gap-1 text-sm">
                <span>Load More Opportunities</span>
                <i class="fas fa-chevron-down animate-bounce"></i>
            </button>
        </div>

    </div>
</div>
@endsection