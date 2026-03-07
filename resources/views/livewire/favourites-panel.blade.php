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
         style="background:rgba(0,0,0,0.25); backdrop-filter:blur(4px);"
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
         style="background:#fff; box-shadow:-20px 0 60px rgba(0,0,0,0.08);">

        {{-- TOP GREEN BAR --}}
        <div class="h-[3px] shrink-0"
             style="background:linear-gradient(90deg,#52c234,#86efac,#52c234);"></div>

        {{-- HEADER --}}
        <div class="shrink-0 px-6 pt-6 pb-5" style="border-bottom:1px solid #f3f4f6;">

            <div class="flex items-start justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-1.5">
                        <div class="w-1.5 h-1.5 rounded-full" style="background:#52c234;"></div>
                        <span class="text-[9px] font-black uppercase tracking-[0.3em] text-gray-400">
                            EcoBite
                        </span>
                    </div>
                    <h2 class="font-black text-gray-900 uppercase leading-none"
                        style="font-size:22px; letter-spacing:-0.02em;">
                        Your <span style="color:#52c234;">Favourites</span>
                    </h2>
                    <p class="text-[10px] text-gray-400 mt-1.5 font-medium">
                        {{ $favourites->count() }} saved {{ $favourites->count() === 1 ? 'place' : 'places' }}
                    </p>
                </div>

                <button wire:click="$set('open', false)"
                        class="w-8 h-8 flex items-center justify-center rounded-xl text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-all mt-1"
                        style="border:1px solid #f0f0f0;">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </div>

            {{-- Green gradient divider --}}
            <div class="mt-5 h-px"
                 style="background:linear-gradient(90deg,#52c234,rgba(82,194,52,0.1),transparent);"></div>
        </div>

        {{-- LIST --}}
        <div class="flex-1 overflow-y-auto py-4 px-4 space-y-2"
             style="-ms-overflow-style:none; scrollbar-width:none;">

            @forelse($favourites as $index => $fav)
                @php $s = $fav->supplier; @endphp

                <div class="group relative flex items-center gap-3 px-3 py-3 rounded-2xl bg-white transition-all duration-200"
                     style="border:1.5px solid #f3f3f3; animation:slideUp 0.3s ease forwards; animation-delay:{{ $index * 0.06 }}s; opacity:0;"
                     onmouseover="this.style.borderColor='#d1fae5'; this.style.background='#f9fffe'; this.style.boxShadow='0 4px 16px rgba(82,194,52,0.06)'"
                     onmouseout="this.style.borderColor='#f3f3f3'; this.style.background='#fff'; this.style.boxShadow='none'">

                    {{-- Thumbnail --}}
                    <div class="relative shrink-0">
                        <div class="w-14 h-14 rounded-xl overflow-hidden"
                             style="border:1.5px solid #f0f0f0;">
                            <img src="{{ $s->cover_photo ? asset('storage/'.$s->cover_photo) : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=200' }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                 alt="{{ $s->business_name }}">
                        </div>
                        {{-- Online dot --}}
                        <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 rounded-full border-2 border-white"
                             style="background:#52c234;"></div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-black text-[11px] uppercase tracking-wide text-gray-900 truncate leading-tight">
                            {{ $s->business_name }}
                        </p>
                        <p class="text-[10px] text-gray-400 truncate mt-1 flex items-center gap-1">
                            <i class="fas fa-map-marker-alt text-[8px]" style="color:#52c234;"></i>
                            {{ $s->business_location }}
                        </p>
                        <div class="flex items-center gap-2 mt-1.5">
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
                    <div class="flex flex-col items-center gap-1.5 shrink-0">
                        {{-- Visit --}}
                        <a href="{{ route('restaurants.show', $s->id) }}"
                           wire:click="$set('open', false)"
                           class="w-8 h-8 rounded-xl flex items-center justify-center text-white transition-all duration-200"
                           style="background:#52c234;"
                           onmouseover="this.style.background='#3aa820'; this.style.transform='scale(1.08)'"
                           onmouseout="this.style.background='#52c234'; this.style.transform='scale(1)'">
                            <i class="fas fa-arrow-right text-[9px]"></i>
                        </a>
                        {{-- Remove --}}
                        <button wire:click="removeFavourite({{ $s->id }})"
                                class="w-8 h-8 rounded-xl flex items-center justify-center transition-all duration-200 text-gray-300"
                                style="border:1.5px solid #f3f3f3;"
                                onmouseover="this.style.color='#ef4444'; this.style.background='#fff1f2'; this.style.borderColor='#fecaca'"
                                onmouseout="this.style.color='#d1d5db'; this.style.background='transparent'; this.style.borderColor='#f3f3f3'"
                                title="Remove from favourites">
                            <i class="fas fa-heart text-[9px]"></i>
                        </button>
                    </div>

                    {{-- Bottom hover accent --}}
                    <div class="absolute bottom-0 left-4 right-4 h-px opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full"
                         style="background:linear-gradient(90deg,transparent,#52c234,transparent);"></div>
                </div>

                @if(!$loop->last)
                    <div class="mx-2 h-px" style="background:#f9f9f9;"></div>
                @endif

            @empty
                {{-- EMPTY STATE --}}
                <div class="flex flex-col items-center justify-center h-64 gap-5 text-center px-6">
                    <div class="relative">
                        <div class="w-20 h-20 rounded-3xl flex items-center justify-center"
                             style="background:linear-gradient(135deg,#f0fdf4,#dcfce7); border:2px dashed #86efac;">
                            <i class="far fa-heart text-3xl" style="color:#86efac;"></i>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-7 h-7 rounded-xl flex items-center justify-center bg-white"
                             style="border:1.5px solid #d1fae5; box-shadow:0 2px 8px rgba(82,194,52,0.1);">
                            <i class="fas fa-plus text-[9px]" style="color:#52c234;"></i>
                        </div>
                    </div>
                    <div>
                        <p class="font-black text-[12px] uppercase tracking-widest text-gray-700">
                            Nothing saved yet
                        </p>
                        <p class="text-[10px] text-gray-400 mt-2 leading-relaxed">
                            Tap ❤️ on any restaurant<br>to save it here
                        </p>
                    </div>
                </div>
            @endforelse

        </div>

        {{-- BRAND FOOTER --}}
        <div class="shrink-0 px-5 py-3.5 flex items-center justify-between"
             style="border-top:1px solid #f3f4f6;">
            <div class="flex items-center gap-2">
                <div class="w-5 h-5 bg-black rounded-full flex items-center justify-center">
                    <i class="fas fa-leaf text-[7px]" style="color:#52c234;"></i>
                </div>
                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-300">EcoBite</span>
            </div>
            <div class="flex items-center gap-1.5">
                <div class="w-1.5 h-1.5 rounded-full animate-pulse"
                     style="background:#52c234; box-shadow:0 0 5px rgba(82,194,52,0.5);"></div>
                <span class="text-[9px] text-gray-300 font-medium">Live</span>
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