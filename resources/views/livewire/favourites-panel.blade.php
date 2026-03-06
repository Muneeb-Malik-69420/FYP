<div x-data x-on:open-favourites.window="$wire.openPanel()">

    {{-- BACKDROP --}}
    <div x-show="$wire.open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 z-[110]"
         style="background:rgba(0,0,0,0.3); backdrop-filter:blur(4px);"
         wire:click="$set('open', false)">
    </div>

    {{-- DRAWER --}}
    <div x-show="$wire.open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         x-cloak
         class="fixed right-0 top-0 h-full w-[340px] z-[120] flex flex-col"
         style="background:#ffffff; box-shadow:-12px 0 50px rgba(0,0,0,0.1);">

        {{-- TOP GREEN ACCENT --}}
        <div class="h-[3px] shrink-0"
             style="background:linear-gradient(90deg,#52c234,#86efac,#52c234);"></div>

        {{-- HEADER --}}
        <div class="shrink-0 px-5 py-5" style="border-bottom:1px solid #f3f4f6;">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                         style="background:#f0fdf4; border:1.5px solid #bbf7d0;">
                        <i class="fas fa-heart text-xs" style="color:#52c234;"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-gray-900 text-[13px] uppercase tracking-widest leading-none">
                            Favourites
                        </h2>
                        <p class="text-[10px] text-gray-400 mt-0.5">
                            {{ $favourites->count() }} saved {{ $favourites->count() === 1 ? 'place' : 'places' }}
                        </p>
                    </div>
                </div>
                <button wire:click="$set('open', false)"
                        class="w-8 h-8 rounded-xl flex items-center justify-center text-gray-400 hover:text-gray-700 hover:bg-gray-50 transition-all"
                        style="border:1px solid #f0f0f0;">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>
        </div>

        {{-- LIST --}}
        <div class="flex-1 overflow-y-auto py-3 px-3 space-y-1.5"
             style="-ms-overflow-style:none; scrollbar-width:none;">

            @forelse($favourites as $index => $fav)
                @php $s = $fav->supplier; @endphp

                <div class="group flex items-center gap-3 px-3 py-3 rounded-2xl transition-all duration-200"
                     style="border:1.5px solid transparent; animation:slideUp 0.3s ease forwards; animation-delay:{{ $index * 0.06 }}s; opacity:0;"
                     onmouseover="this.style.background='#f9fffe'; this.style.borderColor='#d1fae5'; this.style.boxShadow='0 2px 12px rgba(82,194,52,0.07)'"
                     onmouseout="this.style.background='transparent'; this.style.borderColor='transparent'; this.style.boxShadow='none'">

                    {{-- Thumbnail --}}
                    <div class="relative shrink-0">
                        <div class="w-[52px] h-[52px] rounded-xl overflow-hidden"
                             style="border:1.5px solid #f0f0f0;">
                            <img src="{{ $s->cover_photo ? asset('storage/'.$s->cover_photo) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=200' }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                 alt="{{ $s->business_name }}">
                        </div>
                        {{-- Online dot --}}
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-white"
                             style="background:#52c234;"></div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-black text-[11px] uppercase tracking-wide text-gray-900 truncate leading-tight">
                            {{ $s->business_name }}
                        </p>
                        <p class="text-[10px] text-gray-400 truncate mt-0.5 flex items-center gap-1">
                            <i class="fas fa-map-marker-alt text-[8px]" style="color:#52c234;"></i>
                            {{ $s->business_location }}
                        </p>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex items-center gap-0.5">
                                <i class="fas fa-star text-amber-400 text-[8px]"></i>
                                <span class="text-[10px] font-black text-gray-700">{{ $s->rating ?? '4.9' }}</span>
                            </div>
                            @if($s->business_type ?? false)
                                <span class="text-[8px] font-black uppercase tracking-wider px-1.5 py-0.5 rounded-md"
                                      style="background:#f0fdf4; color:#16a34a; border:1px solid #d1fae5;">
                                    {{ $s->business_type }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-1.5 shrink-0">
                        <a href="{{ route('restaurants.show', $s->id) }}"
                           wire:click="$set('open', false)"
                           class="w-8 h-8 rounded-xl flex items-center justify-center text-white transition-all duration-200"
                           style="background:#52c234;"
                           onmouseover="this.style.background='#3aa820'; this.style.transform='scale(1.08)'"
                           onmouseout="this.style.background='#52c234'; this.style.transform='scale(1)'">
                            <i class="fas fa-arrow-right text-[9px]"></i>
                        </a>
                        <button wire:click="removeFavourite({{ $s->id }})"
                                class="w-8 h-8 rounded-xl flex items-center justify-center transition-all duration-200 text-gray-300"
                                style="border:1.5px solid #f3f3f3;"
                                onmouseover="this.style.color='#ef4444'; this.style.background='#fff1f2'; this.style.borderColor='#fecaca'"
                                onmouseout="this.style.color='#d1d5db'; this.style.background='transparent'; this.style.borderColor='#f3f3f3'">
                            <i class="fas fa-heart text-[9px]"></i>
                        </button>
                    </div>
                </div>

                {{-- Subtle divider (not on last item) --}}
                @if(!$loop->last)
                    <div class="mx-3 h-px" style="background:#f9f9f9;"></div>
                @endif

            @empty
                <div class="flex flex-col items-center justify-center h-60 gap-4 text-center px-6">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center"
                         style="background:#f0fdf4; border:2px dashed #bbf7d0;">
                        <i class="far fa-heart text-2xl" style="color:#86efac;"></i>
                    </div>
                    <div>
                        <p class="font-black text-[11px] uppercase tracking-widest text-gray-600">
                            Nothing saved yet
                        </p>
                        <p class="text-[10px] text-gray-400 mt-1.5 leading-relaxed">
                            Tap ❤️ on any restaurant<br>to save it here
                        </p>
                    </div>
                </div>
            @endforelse

        </div>

        {{-- FOOTER --}}
        <div class="shrink-0 px-5 py-3.5" style="border-top:1px solid #f3f4f6;">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 bg-black rounded-full flex items-center justify-center">
                        <i class="fas fa-leaf text-[7px]" style="color:#52c234;"></i>
                    </div>
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-300">EcoBite</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <div class="w-1.5 h-1.5 rounded-full" style="background:#52c234; box-shadow:0 0 5px rgba(82,194,52,0.5);"></div>
                    <span class="text-[9px] font-medium text-gray-300">Live</span>
                </div>
            </div>
        </div>

    </div>

    <style>
        @keyframes slideUp {
            from { opacity:0; transform:translateY(10px); }
            to   { opacity:1; transform:translateY(0); }
        }
    </style>
</div>