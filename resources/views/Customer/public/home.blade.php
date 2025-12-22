
@extends('layout.app')

@section('title', 'EcoBite | Rescue Food, Save Money')

@section('content')
<div class="min-h-screen bg-white">

    <div class="relative bg-[#007821] overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-[#4ade80] opacity-20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-yellow-400 opacity-10 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 pt-20 pb-24 md:pt-28 md:pb-32 relative z-10 flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2 text-center md:text-left">
                <span class="inline-block py-1 px-3 rounded-full bg-green-900/30 border border-green-400 text-green-200 text-xs font-bold uppercase tracking-widest mb-6">
                    Join the Food Revolution
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                    Rescue Food. <br>Save Money. <br><span class="text-[#4ade80]">Reduce Waste.</span>
                </h1>
                <p class="text-lg text-green-100 mb-8 max-w-lg mx-auto md:mx-0">
                    Buy fresh surplus food from your favorite local restaurants at up to <span class="text-white font-bold">70% off</span>. Help the planet with every bite.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="{{ route('Browse') }}" class="px-8 py-4 bg-white text-[#007821] font-bold rounded-full hover:bg-gray-100 transition shadow-lg transform hover:scale-105 text-center">
                        Browse Surplus Food
                    </a>
                    <a href="#how-it-works" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white/10 transition text-center">
                        How It Works
                    </a>
                </div>
                
                <div class="mt-10 flex items-center justify-center md:justify-start gap-8 text-white/80 text-sm font-medium">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-users text-[#4ade80]"></i> 5k+ Users
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-store text-[#4ade80]"></i> 120+ Partners
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white/10 transform rotate-2 hover:rotate-0 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Delicious Surplus Food" class="w-full h-auto object-cover">
                    <div class="absolute bottom-6 left-6 bg-white/95 backdrop-blur px-5 py-3 rounded-xl shadow-lg">
                        <p class="text-xs text-gray-500 uppercase font-bold">Total Saved</p>
                        <p class="text-2xl font-bold text-[#007821]">15,400 Meals 🍲</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 bg-[#F0FDF4]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800">Why EcoBite?</h2>
                <p class="text-gray-500 mt-2">More than just a food delivery app.</p>
            </div>
            
            <div class="grid md:grid-cols-4 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition text-center group border border-green-100">
                    <div class="w-16 h-16 mx-auto bg-[#E6F4EA] text-[#007821] rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Fresh & Safe</h3>
                    <p class="text-sm text-gray-500">Food is surplus, not scraps. High quality meals prepared daily.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition text-center group border border-green-100">
                    <div class="w-16 h-16 mx-auto bg-[#E6F4EA] text-[#007821] rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Huge Discounts</h3>
                    <p class="text-sm text-gray-500">Enjoy premium meals at 50-70% off the regular menu price.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition text-center group border border-green-100">
                    <div class="w-16 h-16 mx-auto bg-[#E6F4EA] text-[#007821] rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Eco-Friendly</h3>
                    <p class="text-sm text-gray-500">Every meal saved reduces CO2 emissions and landfill waste.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition text-center group border border-green-100">
                    <div class="w-16 h-16 mx-auto bg-[#E6F4EA] text-[#007821] rounded-full flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition">
                        <i class="fas fa-store"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Trusted Partners</h3>
                    <p class="text-sm text-gray-500">We verify every restaurant to ensure strict hygiene standards.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Today's Hot Deals ⚡</h2>
                <p class="text-gray-500 mt-2">Grab them before they are gone!</p>
            </div>
            <a href="{{ url('/browse') }}" class="hidden md:inline-flex items-center font-bold text-[#007821] hover:underline">
                View Full Menu <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">50% OFF</span>
                    <span class="absolute bottom-3 left-3 bg-white/90 text-gray-800 text-xs font-bold px-2 py-1 rounded flex items-center"><i class="fas fa-clock mr-1 text-orange-500"></i> Ends in 2h</span>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-lg text-gray-800">Assorted Pastry Box</h3>
                    <p class="text-sm text-gray-500 mb-3">Golden Bakery • 0.5km away</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-gray-400 line-through text-sm">Rs. 800</span>
                            <span class="text-[#007821] font-bold text-xl ml-2">Rs. 400</span>
                        </div>
                        <button class="w-8 h-8 rounded-full bg-[#E6F4EA] text-[#007821] flex items-center justify-center hover:bg-[#007821] hover:text-white transition"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1604382354936-07c5d9983bd3?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">60% OFF</span>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-lg text-gray-800">Chicken Pizza (Large)</h3>
                    <p class="text-sm text-gray-500 mb-3">Cheezious • 1.2km away</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-gray-400 line-through text-sm">Rs. 1500</span>
                            <span class="text-[#007821] font-bold text-xl ml-2">Rs. 600</span>
                        </div>
                        <button class="w-8 h-8 rounded-full bg-[#E6F4EA] text-[#007821] flex items-center justify-center hover:bg-[#007821] hover:text-white transition"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition group">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">70% OFF</span>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-lg text-gray-800">Fresh Salad Bowl</h3>
                    <p class="text-sm text-gray-500 mb-3">Green Cafe • 0.8km away</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-gray-400 line-through text-sm">Rs. 600</span>
                            <span class="text-[#007821] font-bold text-xl ml-2">Rs. 180</span>
                        </div>
                        <button class="w-8 h-8 rounded-full bg-[#E6F4EA] text-[#007821] flex items-center justify-center hover:bg-[#007821] hover:text-white transition"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-8 text-center md:hidden">
            <a href="{{ url('/browse') }}" class="btn-secondary px-8 py-3 rounded-full text-sm font-bold border border-gray-300">View Full Menu</a>
        </div>
    </div>

    <div id="how-it-works" class="py-20 bg-[#007821] text-white text-center">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-16">How It Works</h2>
            
            <div class="grid md:grid-cols-3 gap-12 relative">
                <div class="hidden md:block absolute top-12 left-20 right-20 h-1 bg-white/20 -z-0"></div>

                <div class="relative z-10">
                    <div class="w-24 h-24 bg-[#E6F4EA] rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-xl border-4 border-[#009e2b] text-[#007821]">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-2">Browse Nearby</h3>
                    <p class="text-green-100 text-sm px-6">Find restaurants and bakeries near you with surplus food available.</p>
                </div>

                <div class="relative z-10">
                    <div class="w-24 h-24 bg-[#E6F4EA] rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-xl border-4 border-[#009e2b] text-[#007821]">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-2">Order & Pay</h3>
                    <p class="text-green-100 text-sm px-6">Reserve your bag and pay a fraction of the price directly in the app.</p>
                </div>

                <div class="relative z-10">
                    <div class="w-24 h-24 bg-[#E6F4EA] rounded-full flex items-center justify-center text-3xl font-bold mx-auto mb-6 shadow-xl border-4 border-[#009e2b] text-[#007821]">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-2">Pickup & Enjoy</h3>
                    <p class="text-green-100 text-sm px-6">Show your receipt at the store, pick up your meal, and enjoy the savings!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">What are you craving?</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="group relative rounded-xl overflow-hidden h-40">
                <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition flex items-center justify-center">
                    <h3 class="text-white font-bold text-xl tracking-wide">Bakery</h3>
                </div>
            </a>
            <a href="#" class="group relative rounded-xl overflow-hidden h-40">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition flex items-center justify-center">
                    <h3 class="text-white font-bold text-xl tracking-wide">Meals</h3>
                </div>
            </a>
            <a href="#" class="group relative rounded-xl overflow-hidden h-40">
                <img src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition flex items-center justify-center">
                    <h3 class="text-white font-bold text-xl tracking-wide">Dessert</h3>
                </div>
            </a>
            <a href="#" class="group relative rounded-xl overflow-hidden h-40">
                <img src="https://images.unsplash.com/photo-1543339308-43e59d6b73a6?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition flex items-center justify-center">
                    <h3 class="text-white font-bold text-xl tracking-wide">Beverages</h3>
                </div>
            </a>
        </div>
    </div>

    <div class="py-16 bg-[#E6F4EA] text-center px-6">
        <div class="max-w-3xl mx-auto">
            <i class="fas fa-heart text-4xl text-[#007821] mb-4"></i>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Our Mission</h2>
            <p class="text-lg text-gray-600 leading-relaxed">
                “We partner with local restaurants to rescue good surplus food and make it affordable — reducing food waste in Pakistan, one meal at a time.”
            </p>
        </div>
    </div>

    <div class="py-20 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-extrabold text-[#007821] mb-2">15k+</div>
                <div class="text-sm text-gray-500 uppercase tracking-widest">Meals Saved</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-[#007821] mb-2">2.5 Tons</div>
                <div class="text-sm text-gray-500 uppercase tracking-widest">Food Waste Reduced</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-[#007821] mb-2">5000kg</div>
                <div class="text-sm text-gray-500 uppercase tracking-widest">CO2 Prevented</div>
            </div>
            <div>
                <div class="text-4xl font-extrabold text-[#007821] mb-2">150+</div>
                <div class="text-sm text-gray-500 uppercase tracking-widest">Restaurant Partners</div>
            </div>
        </div>
    </div>

    <div class="py-20 bg-[#F0FDF4]">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Community Love 💚</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100">
                    <div class="flex text-yellow-400 text-xs mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-4">"Absolutely amazing. I got a huge box of donuts for 300 rupees. Best app ever!"</p>
                    <p class="font-bold text-sm text-gray-900">- Sarah K.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100">
                    <div class="flex text-yellow-400 text-xs mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-4">"As a student, this saves me so much money on dinner. Highly recommend."</p>
                    <p class="font-bold text-sm text-gray-900">- Ali R.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100">
                    <div class="flex text-yellow-400 text-xs mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-gray-600 italic mb-4">"Great initiative. The food was fresh and pickup was seamless."</p>
                    <p class="font-bold text-sm text-gray-900">- Fatima Z.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-20 max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-10">
            <h2 class="text-3xl font-bold text-gray-800">Tips & News 📰</h2>
            <a href="{{ url('/blog') }}" class="font-bold text-[#007821] hover:underline text-sm">Read Journal</a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <a href="#" class="group">
                <div class="rounded-xl overflow-hidden h-48 mb-4">
                    <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-105 transition">
                </div>
                <h3 class="font-bold text-lg text-gray-800 group-hover:text-[#007821]">Extending Shelf Life Guide</h3>
                <p class="text-sm text-gray-500 mt-1">Simple fridge hacks to make veggies last 2x longer.</p>
            </a>
            <a href="#" class="group">
                <div class="rounded-xl overflow-hidden h-48 mb-4">
                    <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-105 transition">
                </div>
                <h3 class="font-bold text-lg text-gray-800 group-hover:text-[#007821]">Understanding Food Labels</h3>
                <p class="text-sm text-gray-500 mt-1">What "Best Before" actually means vs "Use By".</p>
            </a>
            <a href="#" class="group">
                <div class="rounded-xl overflow-hidden h-48 mb-4">
                    <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover group-hover:scale-105 transition">
                </div>
                <h3 class="font-bold text-lg text-gray-800 group-hover:text-[#007821]">Zero Waste Kitchen</h3>
                <p class="text-sm text-gray-500 mt-1">How to compost at home without the smell.</p>
            </a>
        </div>
    </div>

    <div class="bg-[#007821] py-20 text-center px-6">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">Ready to rescue food and save money?</h2>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ url('/joinus') }}" class="px-10 py-4 bg-white text-[#007821] font-bold rounded-full hover:bg-gray-100 transition shadow-lg text-lg">
                Join Us Now
            </a>
            <a href="{{ url('/browse') }}" class="px-10 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white/10 transition text-lg">
                Browse Deals
            </a>
        </div>
    </div>

    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 mb-12">
            <div>
                <div class="flex items-center gap-2 text-2xl font-bold mb-4">
                    <i class="fas fa-rocket text-[#4ade80]"></i> EcoBite
                </div>
                <p class="text-gray-400 text-sm">Fighting food waste through technology and community.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white">About Us</a></li>
                    <li><a href="#" class="hover:text-white">Partner with us</a></li>
                    <li><a href="#" class="hover:text-white">Careers</a></li>
                    <li><a href="#" class="hover:text-white">Blog</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Support</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-white">Help Center</a></li>
                    <li><a href="#" class="hover:text-white">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white">Terms of Service</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">Newsletter</h4>
                <form class="flex">
                    <input type="email" placeholder="Email" class="bg-gray-800 text-white px-4 py-2 rounded-l-lg outline-none w-full border border-gray-700 focus:border-[#007821]">
                    <button class="bg-[#007821] px-4 py-2 rounded-r-lg font-bold hover:bg-green-700 transition">Go</button>
                </form>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 border-t border-gray-800 pt-8 text-center text-sm text-gray-500">
            &copy; 2025 EcoBite. All rights reserved.
        </div>
    </footer>

</div>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>
@endsection