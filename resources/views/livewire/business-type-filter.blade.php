<div class="sticky top-[58px] z-40 bg-white backdrop-blur-md py-3  mb-0">
    <div class="flex items-center gap-6 overflow-x-auto scrollbar-hide justify-center">
        @php
            $types = [
                '' => 'All', 
                'Bakery' => 'Bakery', 
                'Restaurant' => 'Restaurant', 
                'Grocery' => 'Grocery', 
                'HomeChef' => 'Home Chef'
            ];
        @endphp

        @foreach($types as $value => $label)
            <button 
                wire:click="setType('{{ $value }}')" 
                class="flex-none pb-1 text-[10px] font-black uppercase tracking-[0.2em] border-b-2 transition-all 
                {{ $selectedType == $value ? 'border-[#52c234] text-gray-900' : 'border-transparent text-gray-800 hover:text-gray-600' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>
</div>