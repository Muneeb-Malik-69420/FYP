<main class="bg-white min-h-screen">
    <div class="w-full pl-4 pr-10 pb-10">

        {{-- Filter bar stays outside loading container to prevent flicker --}}
        <livewire:business-type-filter />

        <div class="relative mt-4">

            {{-- 1. SKELETON GRID (shown while loading) --}}
            <div wire:loading.grid class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach (range(1, 8) as $index)
                    <div class="bg-gray-50 border border-gray-200 flex flex-col h-72 animate-pulse rounded-sm">
                        {{-- Image placeholder --}}
                        <div class="h-44 w-full bg-gray-200"></div>
                        {{-- Content placeholder --}}
                        <div class="px-3 py-4 flex flex-col gap-3">
                            <div class="flex justify-between items-center">
                                <div class="h-4 w-3/4 bg-gray-200 rounded"></div>
                                <div class="h-3 w-8 bg-gray-200 rounded"></div>
                            </div>
                            <div class="h-3 w-1/2 bg-gray-200 rounded"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- 2. ACTUAL DATA GRID (hidden while loading) --}}
            <div wire:loading.remove>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($suppliers as $supplier)
                        <a wire:navigate href="{{ route('restaurants.show', $supplier->id) }}"
                            class="group bg-cardcolor rounded-sm overflow-hidden border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all duration-300 flex flex-col h-full">

                            <div class="relative h-44 w-full overflow-hidden bg-gray-200">
                                <img
                                    src="{{ $supplier->getThumbnail() }}"
                                    alt="{{ $supplier->business_name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                                <div class="absolute bottom-3 left-3">
                                    <span class="bg-black/60 backdrop-blur-sm text-white text-[7px] font-black px-2 py-1 uppercase tracking-[0.2em]">
                                        {{ $supplier->business_type }}
                                    </span>
                                </div>
                            </div>

                            <div class="px-3 py-4 flex flex-col flex-grow">
                                <div class="flex justify-between items-start gap-2">
                                    <h4 class="text-sm font-black text-gray-900 uppercase tracking-tighter group-hover:text-[#52c234] transition-colors leading-none truncate">
                                        {{ $supplier->business_name }}
                                    </h4>
                                    <div class="flex items-center gap-1 shrink-0 pt-0.5">
    <i class="fas fa-star text-orange-400 text-[7px]"></i>
    <span class="text-gray-900 font-black text-[9px]">
        {{ $supplier->rating }}
    </span>
</div>
                                </div>
                                <div class="mt-1 flex items-start text-gray-500">
                                    <i class="fas fa-map-marker-alt text-[7px] mr-1.5 mt-0.5 shrink-0" aria-hidden="true"></i>
                                    <p class="text-[8px] font-bold uppercase tracking-widest leading-tight">
                                        {{ $supplier->business_location }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full py-20 text-left text-gray-400 font-black uppercase text-[10px] tracking-widest">
                            No active partners found
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($suppliers->hasPages())
                    <style>
                        nav[aria-label="Pagination Navigation"] [aria-current="page"] span,
                        nav[role="navigation"] [aria-current="page"] span {
                            background-color: #000000 !important;
                            border-color: #000000 !important;
                            color: #ffffff !important;
                        }
                        nav[aria-label="Pagination Navigation"] span:not([aria-current]) > span:hover,
                        nav[role="navigation"] a:hover span,
                        nav[role="navigation"] button:hover {
                            border-color: #000000 !important;
                            color: #000000 !important;
                        }
                    </style>
                    <div class="mt-10 flex justify-center">
                        {{ $suppliers->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</main>