<div class="w-full">
    <div class="flex w-full items-center rounded-xl bg-white border border-gray-200 focus-within:border-black focus-within:ring-1 focus-within:ring-black/10 transition-all duration-200">

        {{-- City selector --}}
        <div x-data="{ open: false }"
             wire:ignore.self
             class="relative border-r border-gray-100 bg-gray-50 min-w-[150px] rounded-l-xl">

            <button @click="open = !open" type="button" class="flex items-center gap-2 px-4 py-3 w-full group">
                <i class="fas fa-map-marker-alt text-gray-400 text-[10px]"></i>
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-700 truncate">
                    {{ $city }}
                </span>
                <i class="fas fa-chevron-down text-[8px] text-gray-400 ml-auto transition-transform duration-200"
                   :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open"
                 @click.away="open = false"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 x-cloak
                 class="absolute top-full left-0 mt-2 w-56 bg-white shadow-xl rounded-2xl border border-gray-100 z-[110] p-2">

                <p class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] px-2 py-2 border-b border-gray-50 mb-1">
                    Available Cities
                </p>

                <div class="max-h-60 overflow-y-auto">
                    @forelse($activeCities as $c)
                        <button
                            type="button"
                            wire:key="city-select-{{ $c->id }}"
                            wire:click="selectCity('{{ $c->name }}')"
                            @click="open = false"
                            class="w-full text-left px-3 py-2.5 text-[11px] font-bold rounded-lg transition-colors flex items-center justify-between cursor-pointer
                                   {{ strtolower($city) == strtolower($c->name)
                                        ? 'bg-black text-white'
                                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <span>{{ strtoupper($c->name) }}</span>
                            @if(strtolower($city) == strtolower($c->name))
                                <i class="fas fa-check text-[9px]"></i>
                            @endif
                        </button>
                    @empty
                        <div class="px-3 py-4 text-center">
                            <p class="text-[10px] text-gray-400 font-medium italic">No active cities.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Search input --}}
        <div class="relative flex-1">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-[11px] text-gray-400"></i>
            <input
                type="text"
                wire:model.live.debounce.400ms="searchQuery"
                placeholder="Search in {{ $city }}..."
                class="w-full bg-transparent pl-11 pr-4 py-3 text-xs text-gray-800 border-none focus:ring-0 placeholder-gray-400 font-medium outline-none">
        </div>
    </div>
</div>