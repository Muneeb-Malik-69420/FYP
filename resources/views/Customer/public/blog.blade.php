@extends('layout.app')

@section('title', 'Food Journal & Education | EcoBite')

@section('content')
<div class="min-h-screen bg-[#F0FDF4] pb-20 scroll-smooth">

    <div class="bg-[#007821] border-b border-green-800 py-16 px-6 text-center relative overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-[#4ade80] opacity-10 rounded-full blur-3xl pointer-events-none"></div>

        <p class="text-[#E6F4EA] font-bold tracking-widest uppercase text-xs mb-2 relative z-10">The EcoBite Journal</p>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 relative z-10">
            Eat Smarter, <span class="text-[#4ade80]">Waste Less.</span>
        </h1>
        <p class="text-green-100 max-w-2xl mx-auto text-lg relative z-10">
            Expert tips on food safety, sustainability, and creative recipes to help you make the most of every meal.
        </p>
    </div>

    <div class="border-b border-gray-200 bg-white sticky top-[64px] z-40 shadow-sm bg-opacity-95 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 overflow-x-auto no-scrollbar">
            <div class="flex space-x-8 text-sm font-bold text-gray-500">
                <a href="#latest" class="py-4 text-[#007821] border-b-2 border-[#007821] whitespace-nowrap">Latest</a>
                <a href="#safety" class="py-4 hover:text-[#007821] transition whitespace-nowrap border-b-2 border-transparent hover:border-[#007821]">Food Safety</a>
                <a href="#recipes" class="py-4 hover:text-[#007821] transition whitespace-nowrap border-b-2 border-transparent hover:border-[#007821]">Chef's Corner</a>
                <a href="#nutrition" class="py-4 hover:text-[#007821] transition whitespace-nowrap border-b-2 border-transparent hover:border-[#007821]">Nutrition</a>
                <a href="#sustainability" class="py-4 hover:text-[#007821] transition whitespace-nowrap border-b-2 border-transparent hover:border-[#007821]">Sustainability</a>
                <a href="#platform" class="py-4 hover:text-[#007821] transition whitespace-nowrap border-b-2 border-transparent hover:border-[#007821]">Updates</a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12 space-y-24">
        
        <div id="latest" class="scroll-mt-32">
            <div class="grid lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white rounded-3xl p-2 md:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                    <div class="rounded-2xl overflow-hidden h-64 md:h-80 relative">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80" alt="Food Storage" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute top-4 left-4 bg-white/95 text-[#007821] backdrop-blur text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">
                            Editor's Pick
                        </div>
                    </div>
                    <div class="flex flex-col justify-center p-4">
                        <div class="flex items-center text-xs text-gray-400 mb-3 space-x-2">
                            <span><i class="far fa-calendar mr-1"></i> Oct 24, 2025</span>
                            <span>&bull;</span>
                            <span><i class="far fa-clock mr-1"></i> 5 min read</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-3 group-hover:text-[#007821] transition-colors">
                            The Ultimate Guide to Extending Shelf Life
                        </h2>
                        <p class="text-gray-500 mb-6 leading-relaxed">
                            Learn the proper storage techniques for fruits, vegetables, and bakery items to keep them fresh for longer. Simple changes in your fridge organization can reduce household waste by 30%.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <a href="#" class="text-[#007821] font-bold hover:underline flex items-center">
                                Read Full Article <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                            <div class="flex space-x-4 text-gray-400 text-sm">
                                <button class="hover:text-red-500 transition"><i class="far fa-heart mr-1"></i> 124</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="flex items-center justify-between border-b border-gray-200 pb-2">
                        <h3 class="font-bold text-gray-800 uppercase text-sm tracking-wide">Trending Now</h3>
                        <i class="fas fa-fire text-orange-400"></i>
                    </div>

                    <a href="#" class="flex gap-4 group">
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1596238380424-6f87d7f7247a?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=60" class="w-full h-full object-cover group-hover:scale-110 transition">
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-orange-500 uppercase">Life Hack</span>
                            <h4 class="font-bold text-gray-700 leading-tight group-hover:text-[#007821]">5 creative ways to use overripe bananas</h4>
                        </div>
                    </a>

                    <a href="#" class="flex gap-4 group">
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=60" class="w-full h-full object-cover group-hover:scale-110 transition">
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-blue-500 uppercase">Industry</span>
                            <h4 class="font-bold text-gray-700 leading-tight group-hover:text-[#007821]">Why local restaurants are joining EcoBite</h4>
                        </div>
                    </a>

                    <a href="#" class="flex gap-4 group">
                        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&auto=format&fit=crop&w=200&q=60" class="w-full h-full object-cover group-hover:scale-110 transition">
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-[#007821] uppercase">Diet</span>
                            <h4 class="font-bold text-gray-700 leading-tight group-hover:text-[#007821]">Is a 'Flexitarian' diet better for the planet?</h4>
                        </div>
                    </a>

                    <div class="bg-[#E6F4EA] rounded-xl p-5 text-center mt-4 border border-green-100">
                        <p class="text-xs font-bold text-[#007821] mb-2">Get daily tips</p>
                        <button class="w-full bg-white border border-green-200 text-[#007821] font-bold text-xs py-2 rounded-lg hover:bg-[#007821] hover:text-white transition shadow-sm">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="safety" class="scroll-mt-32">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Food Safety Essentials</h2>
                    <p class="text-gray-500 text-sm mt-1">Protect your health while saving food.</p>
                </div>
                <a href="#" class="text-sm font-bold text-[#007821] hover:underline">View All</a>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-red-50 rounded-2xl p-6 border border-red-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-red-500 shadow-sm mb-4">
                        <i class="fas fa-thermometer-half text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">The Danger Zone</h3>
                    <p class="text-sm text-gray-600 mb-4">Why keeping food between 5°C and 60°C allows bacteria to multiply rapidly.</p>
                    <a href="#" class="text-xs font-bold text-red-600 uppercase tracking-wide hover:underline">Read Guide</a>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-lg transition hover:border-[#007821]">
                    <div class="h-40 -mx-6 -mt-6 mb-4 overflow-hidden rounded-t-2xl">
                        <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Best Before vs. Use By</h3>
                    <p class="text-sm text-gray-600 mb-4">Don't throw it away yet! Understanding these dates can save you money.</p>
                    <a href="#" class="text-xs font-bold text-[#007821] uppercase tracking-wide hover:underline">Read Article</a>
                </div>

                <div class="bg-red-50 rounded-2xl p-6 border border-red-100 hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-red-500 shadow-sm mb-4">
                        <i class="fas fa-hand-sparkles text-xl"></i>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Safe Reheating 101</h3>
                    <p class="text-sm text-gray-600 mb-4">How to reheat your EcoBite meals safely to retain flavor and kill bacteria.</p>
                    <a href="#" class="text-xs font-bold text-red-600 uppercase tracking-wide hover:underline">Read Guide</a>
                </div>
            </div>

            <div class="mt-8 bg-gray-900 rounded-2xl p-8 text-white flex flex-col md:flex-row items-center gap-8 border-l-4 border-[#007821]">
                <div class="flex-1">
                    <span class="text-yellow-400 font-bold uppercase text-xs tracking-widest">Myth Buster</span>
                    <h3 class="text-2xl font-bold mt-2 mb-4">"Freezing food kills bacteria."</h3>
                    <div class="flex items-center gap-4">
                        <button class="px-6 py-2 rounded-full border border-red-500 text-red-400 font-bold hover:bg-red-500 hover:text-white transition">True</button>
                        <button class="px-6 py-2 rounded-full border border-[#007821] text-green-400 font-bold hover:bg-[#007821] hover:text-white transition">False</button>
                    </div>
                </div>
                <div class="flex-1 border-l border-gray-700 pl-0 md:pl-8">
                    <p class="text-gray-300 text-sm leading-relaxed">
                        <strong class="text-white">The Answer is False.</strong> Freezing renders bacteria inactive but does not kill them. Once thawed, bacteria can become active again and multiply. Always cook thawed food thoroughly.
                    </p>
                </div>
            </div>
        </div>

        <div id="recipes" class="scroll-mt-32">
            <div class="text-center mb-10">
                <span class="text-[#007821] font-bold uppercase text-xs tracking-widest">Leftover Magic</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Recipes for Rescue</h2>
                <p class="text-gray-500 mt-2">Turn yesterday's surplus into today's masterpiece.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1511690656952-34342d5c2895?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded flex items-center">
                            <i class="fas fa-clock mr-1"></i> 15m
                        </div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-1">Stale Bread Croutons</h4>
                        <p class="text-xs text-gray-500">Perfect for salads & soups.</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded flex items-center">
                            <i class="fas fa-clock mr-1"></i> 45m
                        </div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-1">Veggie Peel Stock</h4>
                        <p class="text-xs text-gray-500">Don't bin the skins!</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group">
                    <div class="h-48 overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute bottom-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded flex items-center">
                            <i class="fas fa-clock mr-1"></i> 20m
                        </div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-bold text-gray-800 mb-1">Fried Rice Revival</h4>
                        <p class="text-xs text-gray-500">Use that day-old rice.</p>
                    </div>
                </div>

                <div class="bg-[#E6F4EA] rounded-xl border-2 border-dashed border-[#007821] flex flex-col items-center justify-center p-6 text-center cursor-pointer hover:bg-green-100 transition">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#007821] shadow-sm mb-3">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h4 class="font-bold text-[#007821]">Submit Yours</h4>
                    <p class="text-xs text-gray-500 mt-1">Share your rescue recipe</p>
                </div>
            </div>
        </div>

        <div id="nutrition" class="scroll-mt-32">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Nutrition Corner</h2>
                <a href="#" class="text-sm font-bold text-[#007821] hover:underline">View All</a>
            </div>

            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 grid md:grid-cols-2 mb-8">
                <div class="p-8 md:p-12 flex flex-col justify-center order-2 md:order-1">
                    <span class="text-[#007821] font-bold tracking-widest uppercase text-xs mb-2">Healthy Living</span>
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">Understanding Dietary Labels</h3>
                    <p class="text-gray-500 mb-6">
                        Gluten-free, Keto, Vegan? We break down what these labels actually mean for your health and how to filter them on EcoBite to match your specific lifestyle needs.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-900">Dr. Sarah Smith</p>
                            <p class="text-[10px] text-gray-400 uppercase">Clinical Nutritionist</p>
                        </div>
                    </div>
                </div>
                <div class="h-64 md:h-auto relative order-1 md:order-2">
                     <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=60" class="w-full h-full object-cover">
                </div>
            </div>

            <h3 class="font-bold text-gray-700 mb-4">In Season This Month</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-[#E6F4EA] p-4 rounded-xl text-center border border-green-100">
                    <span class="text-2xl">🥕</span>
                    <p class="font-bold text-gray-700 mt-2 text-sm">Carrots</p>
                </div>
                <div class="bg-[#E6F4EA] p-4 rounded-xl text-center border border-green-100">
                    <span class="text-2xl">🥬</span>
                    <p class="font-bold text-gray-700 mt-2 text-sm">Spinach</p>
                </div>
                <div class="bg-[#E6F4EA] p-4 rounded-xl text-center border border-green-100">
                    <span class="text-2xl">🍊</span>
                    <p class="font-bold text-gray-700 mt-2 text-sm">Oranges</p>
                </div>
                <div class="bg-[#E6F4EA] p-4 rounded-xl text-center border border-green-100">
                    <span class="text-2xl">🥦</span>
                    <p class="font-bold text-gray-700 mt-2 text-sm">Broccoli</p>
                </div>
            </div>
        </div>

        <div id="sustainability" class="scroll-mt-32">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Sustainability Impact</h2>
                <a href="#" class="text-sm font-bold text-[#007821] hover:underline">View All</a>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="bg-[#007821] text-white p-6 rounded-2xl text-center shadow-lg">
                    <h4 class="text-3xl font-extrabold mb-1">12k+</h4>
                    <p class="text-xs text-green-200 uppercase tracking-wide">Meals Saved</p>
                </div>
                <div class="bg-[#007821] text-white p-6 rounded-2xl text-center shadow-lg">
                    <h4 class="text-3xl font-extrabold mb-1">5T</h4>
                    <p class="text-xs text-green-200 uppercase tracking-wide">CO2 Reduced</p>
                </div>
                <div class="bg-[#007821] text-white p-6 rounded-2xl text-center shadow-lg">
                    <h4 class="text-3xl font-extrabold mb-1">$80k</h4>
                    <p class="text-xs text-green-200 uppercase tracking-wide">Money Saved</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="group cursor-pointer">
                    <div class="rounded-2xl overflow-hidden mb-4 relative">
                        <img src="https://images.unsplash.com/photo-1530587191325-3db32d826c18?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-2 group-hover:text-[#007821]">Composting: The Basics</h3>
                    <p class="text-sm text-gray-500">Turn your kitchen scraps into gold for your garden. It's easier than you think.</p>
                </div>

                <div class="group cursor-pointer">
                    <div class="rounded-2xl overflow-hidden mb-4 relative">
                        <img src="https://images.unsplash.com/photo-1611288870280-4a395560b085?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=60" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-2 group-hover:text-[#007821]">Zero Waste Grocery Shopping</h3>
                    <p class="text-sm text-gray-500">How to shop smart, avoid plastic packaging, and only buy what you need.</p>
                </div>
            </div>
        </div>

        <div id="platform" class="scroll-mt-32">
            <div class="bg-gray-900 rounded-3xl p-8 md:p-12 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#007821] rounded-full blur-3xl opacity-20 -mr-16 -mt-16 pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="bg-[#007821] text-white text-xs font-bold px-3 py-1 rounded-full uppercase">New</span>
                        <h2 class="text-2xl font-bold">Platform Updates</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="border border-gray-700 rounded-xl p-6 bg-gray-800/50 hover:bg-gray-800 transition">
                            <i class="fas fa-star text-yellow-400 text-2xl mb-4"></i>
                            <h3 class="font-bold text-lg mb-2">Supplier Ratings Are Here</h3>
                            <p class="text-gray-400 text-sm">You asked, we listened. You can now rate your pickup experience and food quality directly in the app to help the community.</p>
                        </div>

                        <div class="border border-gray-700 rounded-xl p-6 bg-gray-800/50 hover:bg-gray-800 transition">
                            <i class="fas fa-wallet text-green-400 text-2xl mb-4"></i>
                            <h3 class="font-bold text-lg mb-2">New Payment Methods</h3>
                            <p class="text-gray-400 text-sm">We have added JazzCash and EasyPaisa integration for smoother, faster checkouts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <div class="max-w-4xl mx-auto px-6 mt-12 mb-8">
        <div class="bg-[#007821] rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden shadow-2xl">
             <i class="fas fa-envelope-open-text absolute -left-10 -bottom-10 text-9xl opacity-10 rotate-12"></i>
             <h2 class="text-3xl font-bold mb-4 relative z-10">Don't Miss an Update</h2>
             <p class="text-green-100 mb-8 relative z-10">Get the latest food rescue tips and platform news sent to your inbox.</p>
             
             <form class="max-w-md mx-auto relative z-10 flex gap-2">
                 <input type="email" placeholder="Enter your email" class="w-full px-5 py-3 rounded-full text-gray-800 outline-none focus:ring-2 focus:ring-[#E6F4EA]">
                 <button class="bg-[#E6F4EA] hover:bg-white text-[#007821] font-bold px-6 py-3 rounded-full transition-colors shadow-lg">
                     Subscribe
                 </button>
             </form>
        </div>
    </div>

</div>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>
@endsection