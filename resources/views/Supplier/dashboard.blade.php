@extends('layout.supplier')

@section('content')
    {{-- Main Container with Alpine.js logic --}}
    <div x-data="{ openAddModal: false }" 
         @close-modal.window="openAddModal = false" 
         class="relative min-h-[500px]">
        
        @if($status == 'no_profile')
            {{-- STATE 1: Registration --}}
            <div class="max-w-2xl mx-auto py-10">
                @livewire('supplier-profile-form')
            </div>

        @else
            {{-- THE GHOST OVERLAY (Only shows if pending) --}}
            @if($status == 'pending')
                <div class="absolute inset-0 z-50 flex items-center justify-center backdrop-blur-md bg-white/40 rounded-xl transition-all duration-500">
                    <div class="bg-white p-8 rounded-2xl shadow-2xl border border-gray-100 text-center max-w-sm mx-4">
                        <div class="w-20 h-20 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                            <span class="text-3xl">⏳</span>
                        </div>
                        <h2 class="text-2xl font-extrabold text-gray-800">Review in Progress</h2>
                        <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                            We've received your details for <b>{{ $profile->business_name ?? 'your business' }}</b>. 
                            Our team is verifying your license.
                        </p>
                        <div class="mt-6 flex justify-center">
                            <span class="px-4 py-1.5 bg-orange-100 text-orange-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                Status: Pending Approval
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- MAIN CONTENT AREA --}}
            <div class="space-y-6 {{ $status == 'pending' ? 'select-none pointer-events-none' : '' }}">
                
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Business Overview</h1>
                    </div>

                    @if($status == 'approved')
                        <div class="flex items-center gap-3">
                            {{-- MODAL TRIGGER --}}
                            <button @click="openAddModal = true" class="flex items-center gap-2 bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition hover:bg-gray-800 shadow-sm">
                                <i class="fa-solid fa-plus"></i>
                                <span>List New Item</span>
                            </button>

                            <div class="bg-white px-4 py-2 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-2">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                                <span class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Live Updates</span>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Dashboard Stats Grid (Now a Livewire Component for dynamic updates) --}}
                @livewire('supplier-stats')

                {{-- Recent Activity Table (Can also be made a Livewire component later) --}}
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-8 text-center">
                    <p class="text-gray-400 font-medium">No recent activity to display.</p>
                </div>
            </div>

            {{-- THE MODAL COMPONENT --}}
            <div x-show="openAddModal" 
                 class="fixed inset-0 z-[100] overflow-y-auto" 
                 x-transition.opacity
                 x-cloak>
                
                {{-- Backdrop --}}
                <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" 
                     @click="openAddModal = false"></div>

                {{-- Modal Box --}}
                <div class="flex min-h-full items-center justify-center p-4">
                    <div class="relative w-full max-w-lg rounded-3xl bg-white p-8 shadow-2xl transition-all transform"
                         x-show="openAddModal"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-4">
                        
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-black text-gray-900">List New Surplus</h3>
                            <button @click="openAddModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                                <i class="fa-solid fa-xmark text-xl"></i>
                            </button>
                        </div>

                        {{-- LIVEWIRE FORM --}}
                        @livewire('add-food-item')

                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
{{-- Success Notifications using SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('item-added', event => {
        Swal.fire({
            title: 'Successfully Listed!',
            text: 'Your food item is now live and visible to customers.',
            icon: 'success',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#ffffff',
            iconColor: '#10b981',
            customClass: {
                popup: 'rounded-2xl shadow-xl border border-gray-100'
            }
        });
    });
</script>
@endpush