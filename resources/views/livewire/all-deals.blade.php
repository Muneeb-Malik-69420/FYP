<main class="pt-24 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-10 py-10">
        <div class="mb-10">
            <span class="text-[#52c234] font-black uppercase tracking-widest text-xs">Surplus Marketplace</span>
            <h2 class="text-4xl font-black text-gray-900 tracking-tighter mt-2">Active deals in {{ $selectedCity }}</h2>
        </div>

        @if($deals->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($deals as $item)
                    <div class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 group transition-all hover:shadow-xl">
                         <div class="relative h-48 rounded-[2rem] overflow-hidden mb-4 bg-gray-100">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-300">
                                    <i class="fas fa-utensils text-3xl"></i>
                                </div>
                            @endif
                         </div>
                         <h3 class="font-black text-gray-800 truncate px-2">{{ $item->item_name }}</h3>
                         <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between px-2">
                            <span class="text-[10px] font-bold text-gray-400 uppercase">{{ $item->supplier->business_name }}</span>
                            <button class="bg-[#52c234] text-white px-4 py-2 rounded-lg text-[10px] font-black hover:bg-[#0f711c]">GRAB IT</button>
                         </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-10">{{ $deals->links() }}</div>
        @else
            <div class="flex flex-col items-center justify-center py-20 bg-white rounded-[3rem] border border-dashed border-gray-200">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-box-open text-3xl text-gray-200"></i>
                </div>
                <h3 class="text-xl font-black text-gray-800">No deals available now</h3>
                <p class="text-gray-400 font-medium text-sm mt-1">Check back later or try switching to another city.</p>
            </div>
        @endif
    </div>
</main>