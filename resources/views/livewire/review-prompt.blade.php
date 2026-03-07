<div>
    @if($show && $order)
    <div class="fixed inset-0 z-[200] flex items-center justify-center"
         style="background:rgba(0,0,0,0.4); backdrop-filter:blur(6px);">

        <div class="relative w-[320px] rounded-3xl overflow-hidden bg-white"
             style="box-shadow:0 24px 60px rgba(0,0,0,0.15);">

            {{-- Top accent --}}
            <div class="h-[3px]"
                 style="background:linear-gradient(90deg,#52c234,#86efac,#52c234);"></div>

            @if(!$done)
            {{-- Rating screen --}}
            <div class="px-6 py-7 text-center">

                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-4 bg-black">
                    <i class="fas fa-star text-sm" style="color:#52c234;"></i>
                </div>

                <h3 class="font-black text-[15px] uppercase tracking-wider text-gray-900 leading-tight">
                    How was your order?
                </h3>
                <p class="text-[10px] text-gray-400 mt-1.5 font-medium">
                    {{ $order->items->first()?->name ?? 'Your recent order' }}
                </p>

                {{-- Stars --}}
                <div class="flex items-center justify-center gap-2 mt-6 mb-6">
                    @for($i = 1; $i <= 5; $i++)
                        <button wire:click="setRating({{ $i }})"
                                class="transition-all duration-150"
                                style="transform: scale({{ $rating >= $i ? '1.15' : '1' }})">
                            <i class="{{ $rating >= $i ? 'fas' : 'far' }} fa-star text-2xl transition-all"
                               style="color: {{ $rating >= $i ? '#f59e0b' : '#d1d5db' }};
                                      filter: {{ $rating >= $i ? 'drop-shadow(0 0 4px rgba(245,158,11,0.4))' : 'none' }}">
                            </i>
                        </button>
                    @endfor
                </div>

                {{-- Labels --}}
                <p class="text-[10px] font-black uppercase tracking-widest mb-6"
                   style="color: {{ $rating > 0 ? '#52c234' : '#d1d5db' }}; min-height:16px;">
                    @if($rating === 1) 😞 Poor
                    @elseif($rating === 2) 😐 Fair
                    @elseif($rating === 3) 🙂 Good
                    @elseif($rating === 4) 😊 Great
                    @elseif($rating === 5) 🤩 Excellent!
                    @endif
                </p>

                <div class="flex gap-2">
                    <button wire:click="dismiss"
                            class="flex-1 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-gray-400 hover:bg-gray-50 transition-all"
                            style="border:1.5px solid #f0f0f0;">
                        Skip
                    </button>
                    <button wire:click="submit"
                            @disabled($rating === 0)
                            class="flex-1 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest text-white transition-all disabled:opacity-30"
                            style="background:#111;"
                            onmouseover="if(!this.disabled) this.style.background='#52c234'"
                            onmouseout="if(!this.disabled) this.style.background='#111'">
                        Submit
                    </button>
                </div>
            </div>

            @else
            {{-- Thank you screen --}}
            <div class="px-6 py-8 text-center"
                 x-data x-init="setTimeout(() => $wire.dismiss(), 1500)">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                     style="background:#f0fdf4; border:2px solid #d1fae5;">
                    <i class="fas fa-check text-lg" style="color:#52c234;"></i>
                </div>
                <p class="font-black text-[13px] uppercase tracking-wider text-gray-900">Thank you!</p>
                <p class="text-[10px] text-gray-400 mt-1.5">Your review helps others find great food 🌿</p>
            </div>
            @endif

        </div>
    </div>
    @endif
</div>