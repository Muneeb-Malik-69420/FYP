<div x-data="{ open: false }"
     x-on:keydown.escape.window="open = false"
     class="relative">

    {{-- Bell button --}}
    {{-- <button @click="open = !open"
            class="relative w-9 h-9 flex items-center justify-center rounded-full text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition text-sm">
        <i class="far fa-bell"></i>
        @if($unreadCount > 0)
            <span class="absolute -top-0.5 -right-0.5 text-white text-[8px] font-black h-4 w-4 rounded-full flex items-center justify-center leading-none"
                  style="background:#52c234;">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button> --}}

    {{-- Backdrop --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         @click="open = false"
         class="fixed inset-0 z-[90]">
    </div>

    {{-- Dropdown panel --}}
    <div x-show="open"
         x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-400"
         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
         x-cloak
         class="absolute right-0 mt-3 w-[340px] z-[100] overflow-hidden rounded-2xl bg-white"
         style="border:1px solid #e8f5e3; box-shadow:0 24px 60px rgba(82,194,52,0.1), 0 4px 16px rgba(0,0,0,0.06);">

        {{-- Green top accent --}}
        <div class="h-[3px] w-full"
             style="background: linear-gradient(90deg, #52c234, #86efac, #52c234);"></div>

        {{-- Header --}}
        <div class="px-5 pt-5 pb-4 flex items-start justify-between"
             style="border-bottom: 1px solid #f0fdf4;">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-4 h-4 bg-black rounded-full flex items-center justify-center">
                        <i class="fas fa-leaf text-[6px]" style="color:#52c234;"></i>
                    </div>
                    <span class="text-[9px] font-black uppercase tracking-[0.35em] text-gray-400">EcoBite</span>
                </div>
                <h3 class="font-black uppercase leading-none text-gray-900"
                    style="font-size:18px; letter-spacing:-0.02em;">
                    Notifications
                    @if($unreadCount > 0)
                        <span style="color:#52c234;"> · {{ $unreadCount }}</span>
                    @endif
                </h3>
            </div>

            @if($unreadCount > 0)
                <button wire:click="markAllRead"
                        class="text-[9px] font-black uppercase tracking-widest px-3 py-1.5 rounded-lg transition-all mt-1"
                        style="color:#16a34a; border:1px solid #d1fae5; background:#f0fdf4;"
                        onmouseover="this.style.background='#dcfce7'"
                        onmouseout="this.style.background='#f0fdf4'">
                    Mark all read
                </button>
            @endif
        </div>

        {{-- Notification list --}}
        <div class="overflow-y-auto" style="max-height:380px; scrollbar-width:none;">
            @forelse($notifications as $n)
                <div wire:key="notif-{{ $n->id }}"
                     wire:click="markRead({{ $n->id }})"
                     @if($n->link) onclick="window.location='{{ $n->link }}'" @endif
                     class="group flex items-start gap-3.5 px-5 py-4 cursor-pointer transition-all duration-200"
                     style="border-bottom: 1px solid #f9fafb;
                            background: {{ $n->isUnread() ? '#f9fffe' : '#fff' }};"
                     onmouseover="this.style.background='#f0fdf4'"
                     onmouseout="this.style.background='{{ $n->isUnread() ? '#f9fffe' : '#fff' }}'">

                    {{-- Icon --}}
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 mt-0.5"
                         style="{{ $n->isUnread()
                             ? 'background:#f0fdf4; border:1.5px solid #86efac;'
                             : 'background:#f9fafb; border:1.5px solid #e5e7eb;' }}">
                        <i class="{{ $n->icon ?? 'fas fa-bell' }} text-[10px]"
                           style="color:{{ $n->isUnread() ? '#52c234' : '#9ca3af' }};"></i>
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-[11px] font-black uppercase tracking-wide leading-tight"
                               style="color:{{ $n->isUnread() ? '#111827' : '#6b7280' }};">
                                {{ $n->title }}
                            </p>
                            @if($n->isUnread())
                                <div class="w-1.5 h-1.5 rounded-full shrink-0 mt-1"
                                     style="background:#52c234; box-shadow:0 0 6px rgba(82,194,52,0.5);"></div>
                            @endif
                        </div>
                        <p class="text-[10px] mt-1 leading-relaxed text-gray-400">
                            {{ $n->body }}
                        </p>
                        <p class="text-[9px] mt-1.5 font-medium" style="color:#86efac;">
                            {{ $n->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-14 px-6 text-center">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-4"
                         style="background:#f0fdf4; border:1.5px dashed #86efac;">
                        <i class="far fa-bell text-xl" style="color:#86efac;"></i>
                    </div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-gray-700">All caught up</p>
                    <p class="text-[10px] mt-1.5 text-gray-400">No notifications yet</p>
                </div>
            @endforelse
        </div>

        {{-- Footer --}}
        <div class="px-5 py-3.5 flex items-center justify-between"
             style="border-top: 1px solid #f0fdf4; background:#fafffe;">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-black rounded-full flex items-center justify-center">
                    <i class="fas fa-leaf text-[6px]" style="color:#52c234;"></i>
                </div>
                <span class="text-[9px] font-black uppercase tracking-[0.25em] text-gray-300">EcoBite</span>
            </div>
            <div class="flex items-center gap-1.5">
                <div class="w-1.5 h-1.5 rounded-full animate-pulse"
                     style="background:#52c234; box-shadow:0 0 5px rgba(82,194,52,0.5);"></div>
                <span class="text-[9px] text-gray-300 font-medium">Live</span>
            </div>
        </div>

    </div>
</div>