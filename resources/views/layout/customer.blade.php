@extends('layouts.customer')

@section('content')
<div class="space-y-12">
    <section>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-extrabold text-gray-900 tracking-tight">Active Restaurants</h2>
            <a href="#" class="text-emerald-600 text-sm font-bold hover:underline">View All</a>
        </div>
        
        <div class="flex gap-6 overflow-x-auto pb-4 scrollbar-hide">
            @foreach($suppliers as $supplier)
                <div class="flex-shrink-0 group cursor-pointer">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-emerald-500/20 p-1 group-hover:border-emerald-500 transition-all">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($supplier->business_name) }}&background=ecfdf5&color=059669" 
                             class="w-full h-full rounded-xl object-cover">
                    </div>
                    <p class="text-[11px] font-black text-center mt-2 text-gray-500 uppercase tracking-widest">{{ $supplier->business_name }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section>
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter">FRESH SURPLUS ⚡</h2>
                <p class="text-gray-400 text-sm">Delicious food listed in the last hour</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($items as $item)
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden group">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-orange-500 text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg">
                                {{ number_format((($item->original_price - $item->discounted_price) / $item->original_price) * 100) }}% OFF
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $item->item_name }}</h3>
                        </div>
                        <p class="text-gray-400 text-xs font-medium mb-4 flex items-center gap-1">
                            <i class="fa-solid fa-store"></i> {{ $item->supplier->business_name }}
                        </p>
                        
                        <div class="flex items-end justify-between">
                            <div>
                                <p class="text-gray-300 text-xs line-through font-bold">{{ $item->original_price }} PKR</p>
                                <p class="text-2xl font-black text-emerald-600 tracking-tighter">{{ $item->discounted_price }} <span class="text-xs font-bold uppercase">PKR</span></p>
                            </div>
                            <button class="bg-gray-900 text-white p-3 rounded-2xl hover:bg-emerald-600 transition-colors shadow-lg">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 font-bold">No surplus items available right now. Check back soon!</p>
                </div>
            @endforelse
        </div>
    </section>
</div>
@endsection